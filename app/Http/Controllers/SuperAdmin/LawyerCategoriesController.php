<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\SuperAdmin\LawyerCategoriesExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\LawyerCategories\CreateRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\SuperAdmin\LawyerCategoriesImport;
use App\Models\LawyerCategory;
use App\Models\LawyerMainCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class LawyerCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /********* Initialize Permission based Middlewares  ***********/
    public function __construct()
    {
        $this->middleware('permission:lawyer_category.index');
        $this->middleware('permission:lawyer_category.add', ['only' => ['store']]);
        $this->middleware('permission:lawyer_category.edit', ['only' => ['update']]);
        $this->middleware('permission:lawyer_category.delete', ['only' => ['destroy']]);
        $this->middleware('permission:lawyer_category.export', ['only' => ['export']]);
        $this->middleware('permission:lawyer_category.import', ['only' => ['import']]);
    }
    /********* Getter For Pagination, Searching And Sorting  ***********/
    public function getter($req = null, $export = null)
    {
        if ($req != null) {
            $lawyer_categories =  LawyerCategory::withAll();
            if ($req->trash && $req->trash == 'with') {
                $lawyer_categories =  $lawyer_categories->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $lawyer_categories =  $lawyer_categories->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $lawyer_categories = $lawyer_categories->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $lawyer_categories = $lawyer_categories->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $lawyer_categories = $lawyer_categories->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $lawyer_categories = $lawyer_categories->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $lawyer_categories = $lawyer_categories->get();
                return $lawyer_categories;
            }
            $lawyer_categories = $lawyer_categories->get();
            return $lawyer_categories;
        }
        $lawyer_categories = LawyerCategory::withAll()->orderBy('id', 'desc')->get();
        return $lawyer_categories;
    }


    /*********View All LawyerCategories  ***********/
    public function index(Request $request)
    {
        $lawyer_categories = $this->getter($request);
        return view('super_admins.lawyer_categories.index')->with('lawyer_categories', $lawyer_categories);
    }

    /*********View Create Form of LawyerCategory  ***********/
    public function create()
    {
        $lawyer_main_categories = LawyerMainCategory::active()->get();

        return view('super_admins.lawyer_categories.create', compact('lawyer_main_categories'));
    }

    /*********Store LawyerCategory  ***********/
    public function store(CreateRequest $request)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            $data['image'] = uploadCroppedFile($request, 'image', 'lawyer_categories');

            $lawyer_category = LawyerCategory::create($data);
            $lawyer_category->slug = Str::slug($lawyer_category->name . ' ' . $lawyer_category->id, '-');
            $lawyer_category->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.lawyer_categories.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.lawyer_categories.index')->with('message', 'LawyerCategory Created Successfully')->with('message_type', 'success');
    }

    /*********View LawyerCategory  ***********/
    public function show(LawyerCategory $lawyer_category)
    {
        return view('super_admins.lawyer_categories.show', compact('lawyer_category'));
    }

    /*********View Edit Form of LawyerCategory  ***********/
    public function edit(LawyerCategory $lawyer_category)
    {
        $lawyer_main_categories = LawyerMainCategory::active()->get();

        return view('super_admins.lawyer_categories.edit', compact('lawyer_category', 'lawyer_main_categories'));
    }

    /*********Update LawyerCategory  ***********/
    public function update(CreateRequest $request, LawyerCategory $lawyer_category)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            if ($request->image) {
                $data['image'] = uploadCroppedFile($request, 'image', 'lawyer_categories', $lawyer_category->image);
            } else {
                $data['image'] = $lawyer_category->image;
            }
            $lawyer_category->update($data);
            $lawyer_category = LawyerCategory::find($lawyer_category->id);
            $slug = Str::slug($lawyer_category->name . ' ' . $lawyer_category->id, '-');
            $lawyer_category->update([
                'slug' => $slug
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.lawyer_categories.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.lawyer_categories.index')->with('message', 'LawyerCategory Updated Successfully')->with('message_type', 'success');
    }

    /********* Export  CSV And Excel  **********/
    public function export(Request $request)
    {
        $lawyer_categories = $this->getter($request, "export");
        if (in_array($request->export, ['csv,xlsx'])) {
            $extension = $request->export;
        } else {
            $extension = 'xlsx';
        }
        $filename = "lawyer_categories." . $extension;
        return Excel::download(new LawyerCategoriesExport($lawyer_categories), $filename);
    }
    /********* Import CSV And Excel  **********/
    public function import(ImportRequest $request)
    {
        $file = $request->file('file');
        Excel::import(new LawyerCategoriesImport, $file);
        return redirect()->back()->with('message', 'Blog Categories imported Successfully')->with('message_type', 'success');
    }


    /*********Soft DELETE LawyerCategory ***********/
    public function destroy(LawyerCategory $lawyer_category)
    {
        $lawyer_category->delete();
        return redirect()->back()->with('message', 'LawyerCategory Deleted Successfully')->with('message_type', 'success');
    }

    /*********Permanently DELETE LawyerCategory ***********/
    public function destroyPermanently(Request $request, $lawyer_category)
    {
        $lawyer_category = LawyerCategory::withTrashed()->find($lawyer_category);
        if ($lawyer_category) {
            if ($lawyer_category->trashed()) {
                if ($lawyer_category->image && file_exists(public_path($lawyer_category->image))) {
                    unlink(public_path($lawyer_category->image));
                }
                $lawyer_category->forceDelete();
                return redirect()->back()->with('message', 'Blog Category Deleted Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'Blog Category is Not in Trash')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'Blog Category Not Found')->with('message_type', 'error');
        }
    }
    /********* Restore LawyerCategory***********/
    public function restore(Request $request, $lawyer_category)
    {
        $lawyer_category = LawyerCategory::withTrashed()->find($lawyer_category);
        if ($lawyer_category->trashed()) {
            $lawyer_category->restore();
            return redirect()->back()->with('message', 'Blog Category Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'Blog Category Not Found')->with('message_type', 'error');
        }
    }
}
