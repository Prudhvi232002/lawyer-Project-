<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\SuperAdmin\LawyerEducationsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\LawyerCertifications\CreateRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\SuperAdmin\LawyerEducationsImport;
use App\Models\Certification;
use App\Models\Lawyer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class LawyerCertificationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /********* Initialize Permission based Middlewares  ***********/
    public function __construct()
    {
        $this->middleware('permission:lawyer.add_certification');
        $this->middleware('permission:lawyer.add_certification', ['only' => ['store']]);
        $this->middleware('permission:lawyer.add_certification', ['only' => ['update']]);
        $this->middleware('permission:lawyer.add_certification', ['only' => ['destroy']]);
        $this->middleware('permission:lawyer.add_certification', ['only' => ['export']]);
        $this->middleware('permission:lawyer.add_certification', ['only' => ['import']]);
    }
    /********* Getter For Pagination, Searching And Sorting  ***********/
    public function getter($req = null, $export = null, $lawyer)
    {
        if ($req != null) {
            $lawyer_certifications =  $lawyer->lawyer_certifications();
            if ($req->trash && $req->trash == 'with') {
                $lawyer_certifications =  $lawyer_certifications->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $lawyer_certifications =  $lawyer_certifications->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $lawyer_certifications = $lawyer_certifications->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $lawyer_certifications = $lawyer_certifications->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $lawyer_certifications = $lawyer_certifications->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $lawyer_certifications = $lawyer_certifications->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $lawyer_certifications = $lawyer_certifications->get();
                return $lawyer_certifications;
            }
            $lawyer_certifications = $lawyer_certifications->get();
            return $lawyer_certifications;
        }
        $lawyer_certifications = $lawyer->lawyer_certifications()->withAll()->orderBy('id', 'desc')->get();
        return $lawyer_certifications;
    }


    /*********View All LawyerCertifications  ***********/
    public function index(Request $request, Lawyer $lawyer)
    {
        $lawyer_certifications = $this->getter($request, null, $lawyer);
        return view('super_admins.lawyers.lawyer_certifications.index', compact('lawyer_certifications', 'lawyer'));
    }

    /*********View Create Form of Certification  ***********/
    public function create(Lawyer $lawyer)
    {
        return view('super_admins.lawyers.lawyer_certifications.create', compact('lawyer'));
    }

    /*********Store Certification  ***********/
    public function store(CreateRequest $request, Lawyer $lawyer)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            $data = $request->all();
            $data['image'] = uploadFile($request, 'file', 'lawyer_certifications');
            $lawyer_certification = $lawyer->lawyer_certifications()->create($data);
            $lawyer_certification = $lawyer->lawyer_certifications()->withAll()->find($lawyer_certification->id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.lawyer_certifications.index', $lawyer->id)->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.lawyer_certifications.index', $lawyer->id)->with('message', 'Certificate Created Successfully')->with('message_type', 'success');
    }

    /*********View Certification  ***********/
    public function show(Lawyer $lawyer, Certification $lawyer_certification)
    {
        if ($lawyer->id != $lawyer_certification->lawyer_id) {
            return redirect()->back()->with('message', 'Certification Not Found')->with('message_type', 'error');
        }
        return view('super_admins.lawyers.lawyer_certifications.show', compact('lawyer_certification', 'lawyer'));
    }

    /*********View Edit Form of Certification  ***********/
    public function edit(Lawyer $lawyer, Certification $lawyer_certification)
    {
        if ($lawyer->id != $lawyer_certification->lawyer_id) {
            return redirect()->back()->with('message', 'Certification Not Found')->with('message_type', 'error');
        }
        return view('super_admins.lawyers.lawyer_certifications.edit', compact('lawyer_certification', 'lawyer'));
    }

    /*********Update Certification  ***********/
    public function update(CreateRequest $request, Lawyer $lawyer, Certification $lawyer_certification)
    {
        if ($lawyer->id != $lawyer_certification->lawyer_id) {
            return redirect()->back()->with('message', 'Certification Not Found')->with('message_type', 'error');
        }
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            $data = $request->all();
            if ($request->file) {
                $data['image'] = uploadFile($request, 'file', 'lawyer_certifications', $lawyer_certification->image);
            } else {
                $data['image'] = $lawyer_certification->image;
            }
            $lawyer_certification->update($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.lawyer_certifications.index', $lawyer->id)->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.lawyer_certifications.index', $lawyer->id)->with('message', 'Certification Updated Successfully')->with('message_type', 'success');
    }

    /********* Export  CSV And Excel  **********/
    public function export(Request $request)
    {
        $lawyer_certifications = $this->getter($request, "export");
        if (in_array($request->export, ['csv,xlsx'])) {
            $extension = $request->export;
        } else {
            $extension = 'xlsx';
        }
        $filename = "lawyer_certifications." . $extension;
        return Excel::download(new LawyerEducationsExport($lawyer_certifications), $filename);
    }
    /********* Import CSV And Excel  **********/
    public function import(ImportRequest $request)
    {
        $file = $request->file('file');
        Excel::import(new LawyerEducationsImport, $file);
        return redirect()->back()->with('message', 'Certification Categories imported Successfully')->with('message_type', 'success');
    }


    /*********Soft DELETE Certification ***********/
    public function destroy(Lawyer $lawyer, Certification $lawyer_certification)
    {
        if ($lawyer->id != $lawyer_certification->lawyer_id) {
            return redirect()->back()->with('message', 'Certification Not Found')->with('message_type', 'error');
        }
        $lawyer_certification->delete();
        return redirect()->back()->with('message', 'Certification Deleted Successfully')->with('message_type', 'success');
    }

    /*********Permanently DELETE Certification ***********/
    public function destroyPermanently(Request $request, Lawyer $lawyer, $lawyer_certification)
    {
        $lawyer_certification = Certification::withTrashed()->find($lawyer_certification);
        if ($lawyer_certification) {
            if ($lawyer_certification->trashed()) {
                if ($lawyer_certification->image && file_exists(public_path($lawyer_certification->image))) {
                    unlink(public_path($lawyer_certification->image));
                }
                $lawyer_certification->forceDelete();
                return redirect()->back()->with('message', 'Certification Deleted Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'Certification is Not in Trash')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'Certification Not Found')->with('message_type', 'error');
        }
    }
    /********* Restore Certification***********/
    public function restore(Request $request, Lawyer $lawyer, $lawyer_certification)
    {
        $lawyer_certification = Certification::withTrashed()->find($lawyer_certification);
        if ($lawyer_certification->trashed()) {
            $lawyer_certification->restore();
            return redirect()->back()->with('message', 'Certification Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'Certification Not Found')->with('message_type', 'error');
        }
    }
}
