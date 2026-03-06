<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\SuperAdmin\LawyerEducationsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\LawyerEducations\CreateRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\SuperAdmin\LawyerEducationsImport;
use App\Models\LawyerEducation;
use App\Models\Lawyer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class LawyerEducationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /********* Initialize Permission based Middlewares  ***********/
    public function __construct()
    {
        $this->middleware('permission:lawyer.add_education');
        $this->middleware('permission:lawyer.add_education', ['only' => ['store']]);
        $this->middleware('permission:lawyer.add_education', ['only' => ['update']]);
        $this->middleware('permission:lawyer.add_education', ['only' => ['destroy']]);
        $this->middleware('permission:lawyer.add_education', ['only' => ['export']]);
        $this->middleware('permission:lawyer.add_education', ['only' => ['import']]);
    }
    /********* Getter For Pagination, Searching And Sorting  ***********/
    public function getter($req = null, $export = null, $lawyer)
    {
        if ($req != null) {
            $lawyer_educations =  $lawyer->lawyer_educations();
            if ($req->trash && $req->trash == 'with') {
                $lawyer_educations =  $lawyer_educations->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $lawyer_educations =  $lawyer_educations->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $lawyer_educations = $lawyer_educations->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $lawyer_educations = $lawyer_educations->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $lawyer_educations = $lawyer_educations->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $lawyer_educations = $lawyer_educations->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $lawyer_educations = $lawyer_educations->get();
                return $lawyer_educations;
            }
            $lawyer_educations = $lawyer_educations->get();
            return $lawyer_educations;
        }
        $lawyer_educations = $lawyer->lawyer_educations()->withAll()->orderBy('id', 'desc')->get();
        return $lawyer_educations;
    }


    /*********View All LawyerEducations  ***********/
    public function index(Request $request, Lawyer $lawyer)
    {
        $lawyer_educations = $this->getter($request, null, $lawyer);
        return view('super_admins.lawyers.lawyer_educations.index', compact('lawyer_educations', 'lawyer'));
    }

    /*********View Create Form of LawyerEducation  ***********/
    public function create(Lawyer $lawyer)
    {
        return view('super_admins.lawyers.lawyer_educations.create', compact('lawyer'));
    }

    /*********Store LawyerEducation  ***********/
    public function store(CreateRequest $request, Lawyer $lawyer)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            $data = $request->all();
            $data['image'] = uploadFile($request, 'file', 'lawyer_educations');
            $lawyer_education = $lawyer->lawyer_educations()->create($data);
            $lawyer_education = $lawyer->lawyer_educations()->withAll()->find($lawyer_education->id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.lawyer_educations.index', $lawyer->id)->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.lawyer_educations.index', $lawyer->id)->with('message', 'Education Created Successfully')->with('message_type', 'success');
    }

    /*********View LawyerEducation  ***********/
    public function show(Lawyer $lawyer, LawyerEducation $lawyer_education)
    {
        if ($lawyer->id != $lawyer_education->lawyer_id) {
            return redirect()->back()->with('message', 'LawyerEducation Not Found')->with('message_type', 'error');
        }
        return view('super_admins.lawyers.lawyer_educations.show', compact('lawyer_education', 'lawyer'));
    }

    /*********View Edit Form of LawyerEducation  ***********/
    public function edit(Lawyer $lawyer, LawyerEducation $lawyer_education)
    {
        if ($lawyer->id != $lawyer_education->lawyer_id) {
            return redirect()->back()->with('message', 'LawyerEducation Not Found')->with('message_type', 'error');
        }
        return view('super_admins.lawyers.lawyer_educations.edit', compact('lawyer_education', 'lawyer'));
    }

    /*********Update LawyerEducation  ***********/
    public function update(CreateRequest $request, Lawyer $lawyer, LawyerEducation $lawyer_education)
    {
        if ($lawyer->id != $lawyer_education->lawyer_id) {
            return redirect()->back()->with('message', 'LawyerEducation Not Found')->with('message_type', 'error');
        }
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            $data = $request->all();
            if ($request->file) {
                $data['image'] = uploadFile($request, 'file', 'lawyer_educations', $lawyer_education->image);
            } else {
                $data['image'] = $lawyer_education->image;
            }
            $lawyer_education->update($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.lawyer_educations.index', $lawyer->id)->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.lawyer_educations.index', $lawyer->id)->with('message', 'LawyerEducation Updated Successfully')->with('message_type', 'success');
    }

    /********* Export  CSV And Excel  **********/
    public function export(Request $request)
    {
        $lawyer_educations = $this->getter($request, "export");
        if (in_array($request->export, ['csv,xlsx'])) {
            $extension = $request->export;
        } else {
            $extension = 'xlsx';
        }
        $filename = "lawyer_educations." . $extension;
        return Excel::download(new LawyerEducationsExport($lawyer_educations), $filename);
    }
    /********* Import CSV And Excel  **********/
    public function import(ImportRequest $request)
    {
        $file = $request->file('file');
        Excel::import(new LawyerEducationsImport, $file);
        return redirect()->back()->with('message', 'LawyerEducation Categories imported Successfully')->with('message_type', 'success');
    }


    /*********Soft DELETE LawyerEducation ***********/
    public function destroy(Lawyer $lawyer, LawyerEducation $lawyer_education)
    {
        if ($lawyer->id != $lawyer_education->lawyer_id) {
            return redirect()->back()->with('message', 'LawyerEducation Not Found')->with('message_type', 'error');
        }
        $lawyer_education->delete();
        return redirect()->back()->with('message', 'LawyerEducation Deleted Successfully')->with('message_type', 'success');
    }

    /*********Permanently DELETE LawyerEducation ***********/
    public function destroyPermanently(Request $request, Lawyer $lawyer, $lawyer_education)
    {
        $lawyer_education = LawyerEducation::withTrashed()->find($lawyer_education);
        if ($lawyer_education) {
            if ($lawyer_education->trashed()) {
                if ($lawyer_education->image && file_exists(public_path($lawyer_education->image))) {
                    unlink(public_path($lawyer_education->image));
                }
                $lawyer_education->forceDelete();
                return redirect()->back()->with('message', 'LawyerEducation Deleted Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'LawyerEducation is Not in Trash')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'LawyerEducation Not Found')->with('message_type', 'error');
        }
    }
    /********* Restore LawyerEducation***********/
    public function restore(Request $request, Lawyer $lawyer, $lawyer_education)
    {
        $lawyer_education = LawyerEducation::withTrashed()->find($lawyer_education);
        if ($lawyer_education->trashed()) {
            $lawyer_education->restore();
            return redirect()->back()->with('message', 'LawyerEducation Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'LawyerEducation Not Found')->with('message_type', 'error');
        }
    }
}
