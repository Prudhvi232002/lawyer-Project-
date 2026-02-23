<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\SuperAdmin\LawyerEducationsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\LawFirmCertifications\CreateRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\SuperAdmin\LawFirmEducationsImport;
use App\Models\Certification;
use App\Models\LawFirm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class LawFirmCertificationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /********* Initialize Permission based Middlewares  ***********/
    public function __construct()
    {
        $this->middleware('permission:law_firm.add_certification');
        $this->middleware('permission:law_firm.add_certification', ['only' => ['store']]);
        $this->middleware('permission:law_firm.add_certification', ['only' => ['update']]);
        $this->middleware('permission:law_firm.add_certification', ['only' => ['destroy']]);
        $this->middleware('permission:law_firm.add_certification', ['only' => ['export']]);
        $this->middleware('permission:law_firm.add_certification', ['only' => ['import']]);
    }
    /********* Getter For Pagination, Searching And Sorting  ***********/
    public function getter($req = null, $export = null, $law_firm)
    {
        if ($req != null) {
            $law_firm_certifications =  $law_firm->law_firm_certifications();
            if ($req->trash && $req->trash == 'with') {
                $law_firm_certifications =  $law_firm_certifications->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $law_firm_certifications =  $law_firm_certifications->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $law_firm_certifications = $law_firm_certifications->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $law_firm_certifications = $law_firm_certifications->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $law_firm_certifications = $law_firm_certifications->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $law_firm_certifications = $law_firm_certifications->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $law_firm_certifications = $law_firm_certifications->get();
                return $law_firm_certifications;
            }
            $law_firm_certifications = $law_firm_certifications->get();
            return $law_firm_certifications;
        }
        $law_firm_certifications = $law_firm->law_firm_certifications()->withAll()->orderBy('id', 'desc')->get();
        return $law_firm_certifications;
    }


    /*********View All LawFirmCertifications  ***********/
    public function index(Request $request, LawFirm $law_firm)
    {
        $law_firm_certifications = $this->getter($request, null, $law_firm);
        return view('super_admins.law_firms.law_firm_certifications.index', compact('law_firm_certifications', 'law_firm'));
    }

    /*********View Create Form of Certification  ***********/
    public function create(LawFirm $law_firm)
    {
        return view('super_admins.law_firms.law_firm_certifications.create', compact('law_firm'));
    }

    /*********Store Certification  ***********/
    public function store(CreateRequest $request, LawFirm $law_firm)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            $data = $request->all();
            $data['image'] = uploadFile($request, 'file', 'law_firm_certifications');
            $law_firm_certification = $law_firm->law_firm_certifications()->create($data);
            $law_firm_certification = $law_firm->law_firm_certifications()->withAll()->find($law_firm_certification->id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.law_firm_certifications.index', $law_firm->id)->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.law_firm_certifications.index', $law_firm->id)->with('message', 'Certificate Created Successfully')->with('message_type', 'success');
    }

    /*********View Certification  ***********/
    public function show(LawFirm $law_firm, Certification $law_firm_certification)
    {
        if ($law_firm->id != $law_firm_certification->law_firm_id) {
            return redirect()->back()->with('message', 'Certification Not Found')->with('message_type', 'error');
        }
        return view('super_admins.law_firms.law_firm_certifications.show', compact('law_firm_certification', 'law_firm'));
    }

    /*********View Edit Form of Certification  ***********/
    public function edit(LawFirm $law_firm, Certification $law_firm_certification)
    {
        if ($law_firm->id != $law_firm_certification->law_firm_id) {
            return redirect()->back()->with('message', 'Certification Not Found')->with('message_type', 'error');
        }
        return view('super_admins.law_firms.law_firm_certifications.edit', compact('law_firm_certification', 'law_firm'));
    }

    /*********Update Certification  ***********/
    public function update(CreateRequest $request, LawFirm $law_firm, Certification $law_firm_certification)
    {
        if ($law_firm->id != $law_firm_certification->law_firm_id) {
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
                $data['image'] = uploadFile($request, 'file', 'law_firm_certifications', $law_firm_certification->image);
            } else {
                $data['image'] = $law_firm_certification->image;
            }
            $law_firm_certification->update($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.law_firm_certifications.index', $law_firm->id)->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.law_firm_certifications.index', $law_firm->id)->with('message', 'Certification Updated Successfully')->with('message_type', 'success');
    }

    /********* Export  CSV And Excel  **********/
    public function export(Request $request)
    {
        $law_firm_certifications = $this->getter($request, "export");
        if (in_array($request->export, ['csv,xlsx'])) {
            $extension = $request->export;
        } else {
            $extension = 'xlsx';
        }
        $filename = "law_firm_certifications." . $extension;
        return Excel::download(new LawyerEducationsExport($law_firm_certifications), $filename);
    }
    /********* Import CSV And Excel  **********/
    public function import(ImportRequest $request)
    {
        $file = $request->file('file');
        Excel::import(new LawFirmEducationsImport, $file);
        return redirect()->back()->with('message', 'Certification Categories imported Successfully')->with('message_type', 'success');
    }


    /*********Soft DELETE Certification ***********/
    public function destroy(LawFirm $law_firm, Certification $law_firm_certification)
    {
        if ($law_firm->id != $law_firm_certification->law_firm_id) {
            return redirect()->back()->with('message', 'Certification Not Found')->with('message_type', 'error');
        }
        $law_firm_certification->delete();
        return redirect()->back()->with('message', 'Certification Deleted Successfully')->with('message_type', 'success');
    }

    /*********Permanently DELETE Certification ***********/
    public function destroyPermanently(Request $request, LawFirm $law_firm, $law_firm_certification)
    {
        $law_firm_certification = Certification::withTrashed()->find($law_firm_certification);
        if ($law_firm_certification) {
            if ($law_firm_certification->trashed()) {
                if ($law_firm_certification->image && file_exists(public_path($law_firm_certification->image))) {
                    unlink(public_path($law_firm_certification->image));
                }
                $law_firm_certification->forceDelete();
                return redirect()->back()->with('message', 'Certification Deleted Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'Certification is Not in Trash')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'Certification Not Found')->with('message_type', 'error');
        }
    }
    /********* Restore Certification***********/
    public function restore(Request $request, LawFirm $law_firm, $law_firm_certification)
    {
        $law_firm_certification = Certification::withTrashed()->find($law_firm_certification);
        if ($law_firm_certification->trashed()) {
            $law_firm_certification->restore();
            return redirect()->back()->with('message', 'Certification Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'Certification Not Found')->with('message_type', 'error');
        }
    }
}
