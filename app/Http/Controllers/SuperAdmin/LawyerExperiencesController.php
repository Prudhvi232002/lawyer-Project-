<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\SuperAdmin\LawyerEducationsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\LawyerExperience\CreateRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\SuperAdmin\LawyerEducationsImport;
use App\Models\LawyerExperience;
use App\Models\Lawyer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class LawyerExperiencesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /********* Initialize Permission based Middlewares  ***********/
    public function __construct()
    {
        $this->middleware('permission:lawyer.add_experience');
        $this->middleware('permission:lawyer.add_experience', ['only' => ['store']]);
        $this->middleware('permission:lawyer.add_experience', ['only' => ['update']]);
        $this->middleware('permission:lawyer.add_experience', ['only' => ['destroy']]);
        $this->middleware('permission:lawyer.add_experience', ['only' => ['export']]);
        $this->middleware('permission:lawyer.add_experience', ['only' => ['import']]);
    }
    /********* Getter For Pagination, Searching And Sorting  ***********/
    public function getter($req = null, $export = null, $lawyer)
    {
        if ($req != null) {
            $lawyer_experiences =  $lawyer->lawyer_experiences();
            if ($req->trash && $req->trash == 'with') {
                $lawyer_experiences =  $lawyer_experiences->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $lawyer_experiences =  $lawyer_experiences->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $lawyer_experiences = $lawyer_experiences->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $lawyer_experiences = $lawyer_experiences->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $lawyer_experiences = $lawyer_experiences->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $lawyer_experiences = $lawyer_experiences->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $lawyer_experiences = $lawyer_experiences->get();
                return $lawyer_experiences;
            }
            $lawyer_experiences = $lawyer_experiences->get();
            return $lawyer_experiences;
        }
        $lawyer_experiences = $lawyer->lawyer_experiences()->withAll()->orderBy('id', 'desc')->get();
        return $lawyer_experiences;
    }


    /*********View All LawyerExperience  ***********/
    public function index(Request $request, Lawyer $lawyer)
    {
        $lawyer_experiences = $this->getter($request, null, $lawyer);
        return view('super_admins.lawyers.lawyer_experiences.index', compact('lawyer_experiences', 'lawyer'));
    }

    /*********View Create Form of LawyerExperience  ***********/
    public function create(Lawyer $lawyer)
    {
        return view('super_admins.lawyers.lawyer_experiences.create', compact('lawyer'));
    }

    /*********Store LawyerExperience  ***********/
    public function store(CreateRequest $request, Lawyer $lawyer)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            $data = $request->all();
            $data['image'] = uploadFile($request, 'file', 'lawyer_experiences');
            $lawyer_experience = $lawyer->lawyer_experiences()->create($data);
            $lawyer_experience = $lawyer->lawyer_experiences()->withAll()->find($lawyer_experience->id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.lawyer_experiences.index', $lawyer->id)->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.lawyer_experiences.index', $lawyer->id)->with('message', 'Experience Created Successfully')->with('message_type', 'success');
    }

    /*********View LawyerExperience  ***********/
    public function show(Lawyer $lawyer, LawyerExperience $lawyer_experience)
    {
        if ($lawyer->id != $lawyer_experience->lawyer_id) {
            return redirect()->back()->with('message', 'LawyerExperience Not Found')->with('message_type', 'error');
        }
        return view('super_admins.lawyers.lawyer_experiences.show', compact('lawyer_experience', 'lawyer'));
    }

    /*********View Edit Form of LawyerExperience  ***********/
    public function edit(Lawyer $lawyer, LawyerExperience $lawyer_experience)
    {
        if ($lawyer->id != $lawyer_experience->lawyer_id) {
            return redirect()->back()->with('message', 'LawyerExperience Not Found')->with('message_type', 'error');
        }
        return view('super_admins.lawyers.lawyer_experiences.edit', compact('lawyer_experience', 'lawyer'));
    }

    /*********Update LawyerExperience  ***********/
    public function update(CreateRequest $request, Lawyer $lawyer, LawyerExperience $lawyer_experience)
    {
        if ($lawyer->id != $lawyer_experience->lawyer_id) {
            return redirect()->back()->with('message', 'LawyerExperience Not Found')->with('message_type', 'error');
        }
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            $data = $request->all();
            if ($request->file) {
                $data['image'] = uploadFile($request, 'file', 'lawyer_experiences', $lawyer_experience->image);
            } else {
                $data['image'] = $lawyer_experience->image;
            }
            $lawyer_experience->update($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.lawyer_experiences.index', $lawyer->id)->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.lawyer_experiences.index', $lawyer->id)->with('message', 'LawyerExperience Updated Successfully')->with('message_type', 'success');
    }

    /********* Export  CSV And Excel  **********/
    public function export(Request $request)
    {
        $lawyer_experiences = $this->getter($request, "export");
        if (in_array($request->export, ['csv,xlsx'])) {
            $extension = $request->export;
        } else {
            $extension = 'xlsx';
        }
        $filename = "lawyer_experiences." . $extension;
        return Excel::download(new LawyerEducationsExport($lawyer_experiences), $filename);
    }
    /********* Import CSV And Excel  **********/
    public function import(ImportRequest $request)
    {
        $file = $request->file('file');
        Excel::import(new LawyerEducationsImport, $file);
        return redirect()->back()->with('message', 'LawyerExperience Categories imported Successfully')->with('message_type', 'success');
    }


    /*********Soft DELETE LawyerExperience ***********/
    public function destroy(Lawyer $lawyer, LawyerExperience $lawyer_experience)
    {
        if ($lawyer->id != $lawyer_experience->lawyer_id) {
            return redirect()->back()->with('message', 'LawyerExperience Not Found')->with('message_type', 'error');
        }
        $lawyer_experience->delete();
        return redirect()->back()->with('message', 'LawyerExperience Deleted Successfully')->with('message_type', 'success');
    }

    /*********Permanently DELETE LawyerExperience ***********/
    public function destroyPermanently(Request $request, Lawyer $lawyer, $lawyer_experience)
    {
        $lawyer_experience = LawyerExperience::withTrashed()->find($lawyer_experience);
        if ($lawyer_experience) {
            if ($lawyer_experience->trashed()) {
                if ($lawyer_experience->image && file_exists(public_path($lawyer_experience->image))) {
                    unlink(public_path($lawyer_experience->image));
                }
                $lawyer_experience->forceDelete();
                return redirect()->back()->with('message', 'LawyerExperience Deleted Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'LawyerExperience is Not in Trash')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'LawyerExperience Not Found')->with('message_type', 'error');
        }
    }
    /********* Restore LawyerExperience***********/
    public function restore(Request $request, Lawyer $lawyer, $lawyer_experience)
    {
        $lawyer_experience = LawyerExperience::withTrashed()->find($lawyer_experience);
        if ($lawyer_experience->trashed()) {
            $lawyer_experience->restore();
            return redirect()->back()->with('message', 'LawyerExperience Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'LawyerExperience Not Found')->with('message_type', 'error');
        }
    }
}
