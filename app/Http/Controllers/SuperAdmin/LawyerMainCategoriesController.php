<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\SuperAdmin\LawyerMainCategoriesExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\LawyerMainCategories\CreateRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\SuperAdmin\LawyerMainCategoriesImport;
use App\Models\LawyerMainCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class LawyerMainCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /********* Initialize Permission based Middlewares  ***********/
    public function __construct()
    {
        $this->middleware('permission:lawyer_main_category.index');
        $this->middleware('permission:lawyer_main_category.add', ['only' => ['store']]);
        $this->middleware('permission:lawyer_main_category.edit', ['only' => ['update']]);
        $this->middleware('permission:lawyer_main_category.delete', ['only' => ['destroy']]);
        $this->middleware('permission:lawyer_main_category.export', ['only' => ['export']]);
        $this->middleware('permission:lawyer_main_category.import', ['only' => ['import']]);
    }
    /********* Getter For Pagination, Searching And Sorting  ***********/
    public function getter($req = null, $export = null)
    {
        if ($req != null) {
            $lawyer_main_categories =  LawyerMainCategory::withAll();
            if ($req->trash && $req->trash == 'with') {
                $lawyer_main_categories =  $lawyer_main_categories->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $lawyer_main_categories =  $lawyer_main_categories->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $lawyer_main_categories = $lawyer_main_categories->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $lawyer_main_categories = $lawyer_main_categories->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $lawyer_main_categories = $lawyer_main_categories->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $lawyer_main_categories = $lawyer_main_categories->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $lawyer_main_categories = $lawyer_main_categories->get();
                return $lawyer_main_categories;
            }
            $lawyer_main_categories = $lawyer_main_categories->get();
            return $lawyer_main_categories;
        }
        $lawyer_main_categories = LawyerMainCategory::withAll()->orderBy('id', 'desc')->get();
        return $lawyer_main_categories;
    }


    /*********View All LawyerMainCategories  ***********/
    public function index(Request $request)
    {
        $lawyer_main_categories = $this->getter($request);
        return view('super_admins.lawyer_main_categories.index')->with('lawyer_main_categories', $lawyer_main_categories);
    }

    /*********View Create Form of LawyerMainCategory  ***********/
    public function create()
    {

        return view('super_admins.lawyer_main_categories.create');
    }

    /*********Store LawyerMainCategory  ***********/
    public function store(CreateRequest $request)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            if (!$request->is_featured) {
                $data['is_featured'] = 0;
            }
            $data['image'] = uploadCroppedFile($request, 'image', 'lawyer_main_categories');
            $data['icon'] = uploadCroppedFile($request, 'icon', 'lawyer_main_categories');

            $lawyer_main_category = LawyerMainCategory::create($data);
            $lawyer_main_category->slug = Str::slug($lawyer_main_category->name . ' ' . $lawyer_main_category->id, '-');
            $lawyer_main_category->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.lawyer_main_categories.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.lawyer_main_categories.index')->with('message', 'LawyerMainCategory Created Successfully')->with('message_type', 'success');
    }

    /*********View LawyerMainCategory  ***********/
    public function show(LawyerMainCategory $lawyer_main_category)
    {
        return view('super_admins.lawyer_main_categories.show', compact('lawyer_main_category'));
    }

    /*********View Edit Form of LawyerMainCategory  ***********/
    public function edit(LawyerMainCategory $lawyer_main_category)
    {
        return view('super_admins.lawyer_main_categories.edit', compact('lawyer_main_category'));
    }

    /*********Update LawyerMainCategory  ***********/
    public function update(CreateRequest $request, LawyerMainCategory $lawyer_main_category)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            if (!$request->is_featured) {
                $data['is_featured'] = 0;
            }
            if ($request->image) {
                $data['image'] = uploadCroppedFile($request, 'image', 'lawyer_main_categories', $lawyer_main_category->image);
            } else {
                $data['image'] = $lawyer_main_category->image;
            }
            if ($request->icon) {
                $data['icon'] = uploadCroppedFile($request, 'icon', 'lawyer_main_categories', $lawyer_main_category->icon);
            } else {
                $data['icon'] = $lawyer_main_category->icon;
            }
            $lawyer_main_category->update($data);
            $lawyer_main_category = LawyerMainCategory::find($lawyer_main_category->id);
            $slug = Str::slug($lawyer_main_category->name . ' ' . $lawyer_main_category->id, '-');
            $lawyer_main_category->update([
                'slug' => $slug
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.lawyer_main_categories.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.lawyer_main_categories.index')->with('message', 'LawyerMainCategory Updated Successfully')->with('message_type', 'success');
    }

    /********* Export  CSV And Excel  **********/
    public function export(Request $request)
    {
        $lawyer_main_categories = $this->getter($request, "export");
        if (in_array($request->export, ['csv,xlsx'])) {
            $extension = $request->export;
        } else {
            $extension = 'xlsx';
        }
        $filename = "lawyer_main_categories." . $extension;
        return Excel::download(new LawyerMainCategoriesExport($lawyer_main_categories), $filename);
    }
    /********* Import CSV And Excel  **********/
    public function import(ImportRequest $request)
    {
        $file = $request->file('file');
        Excel::import(new LawyerMainCategoriesImport, $file);
        return redirect()->back()->with('message', 'Blog Categories imported Successfully')->with('message_type', 'success');
    }


    /*********Soft DELETE LawyerMainCategory ***********/
    public function destroy(LawyerMainCategory $lawyer_main_category)
    {
        $lawyer_main_category->delete();
        return redirect()->back()->with('message', 'LawyerMainCategory Deleted Successfully')->with('message_type', 'success');
    }

    /*********Permanently DELETE LawyerMainCategory ***********/
    public function destroyPermanently(Request $request, $lawyer_main_category)
    {
        $lawyer_main_category = LawyerMainCategory::withTrashed()->find($lawyer_main_category);
        if ($lawyer_main_category) {
            if ($lawyer_main_category->trashed()) {
                if ($lawyer_main_category->image && file_exists(public_path($lawyer_main_category->image))) {
                    unlink(public_path($lawyer_main_category->image));
                }
                $lawyer_main_category->forceDelete();
                return redirect()->back()->with('message', 'Blog Category Deleted Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'Blog Category is Not in Trash')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'Blog Category Not Found')->with('message_type', 'error');
        }
    }
    /********* Restore LawyerMainCategory***********/
    public function restore(Request $request, $lawyer_main_category)
    {
        $lawyer_main_category = LawyerMainCategory::withTrashed()->find($lawyer_main_category);
        if ($lawyer_main_category->trashed()) {
            $lawyer_main_category->restore();
            return redirect()->back()->with('message', 'Blog Category Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'Blog Category Not Found')->with('message_type', 'error');
        }
    }
}
