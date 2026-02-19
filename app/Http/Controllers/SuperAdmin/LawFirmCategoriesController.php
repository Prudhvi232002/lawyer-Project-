<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\SuperAdmin\LawFirmCategoriesExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\LawFirmCategories\CreateRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\SuperAdmin\LawFirmCategoriesImport;
use App\Models\LawFirmCategory;
use App\Models\LawFirmMainCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class LawFirmCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /********* Initialize Permission based Middlewares  ***********/
    public function __construct()
    {
        $this->middleware('permission:law_firm_category.index');
        $this->middleware('permission:law_firm_category.add', ['only' => ['store']]);
        $this->middleware('permission:law_firm_category.edit', ['only' => ['update']]);
        $this->middleware('permission:law_firm_category.delete', ['only' => ['destroy']]);
        $this->middleware('permission:law_firm_category.export', ['only' => ['export']]);
        $this->middleware('permission:law_firm_category.import', ['only' => ['import']]);
    }
    /********* Getter For Pagination, Searching And Sorting  ***********/
    public function getter($req = null, $export = null)
    {
        if ($req != null) {
            $law_firm_categories =  LawFirmCategory::withAll();
            if ($req->trash && $req->trash == 'with') {
                $law_firm_categories =  $law_firm_categories->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $law_firm_categories =  $law_firm_categories->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $law_firm_categories = $law_firm_categories->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $law_firm_categories = $law_firm_categories->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $law_firm_categories = $law_firm_categories->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $law_firm_categories = $law_firm_categories->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $law_firm_categories = $law_firm_categories->get();
                return $law_firm_categories;
            }
            $law_firm_categories = $law_firm_categories->get();
            return $law_firm_categories;
        }
        $law_firm_categories = LawFirmCategory::withAll()->orderBy('id', 'desc')->get();
        return $law_firm_categories;
    }


    /*********View All LawFirmCategories  ***********/
    public function index(Request $request)
    {
        $law_firm_categories = $this->getter($request);
        return view('super_admins.law_firm_categories.index')->with('law_firm_categories', $law_firm_categories);
    }

    /*********View Create Form of LawFirmCategory  ***********/
    public function create()
    {
        $law_firm_main_categories = LawFirmMainCategory::active()->get();
        return view('super_admins.law_firm_categories.create', compact('law_firm_main_categories'));
    }

    /*********Store LawFirmCategory  ***********/
    public function store(CreateRequest $request)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            $data['image'] = uploadCroppedFile($request, 'image', 'law_firm_categories');

            $law_firm_category = LawFirmCategory::create($data);
            $law_firm_category->slug = Str::slug($law_firm_category->name . ' ' . $law_firm_category->id, '-');
            $law_firm_category->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.law_firm_categories.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.law_firm_categories.index')->with('message', 'LawFirmCategory Created Successfully')->with('message_type', 'success');
    }

    /*********View LawFirmCategory  ***********/
    public function show(LawFirmCategory $law_firm_category)
    {
        return view('super_admins.law_firm_categories.show', compact('law_firm_category'));
    }

    /*********View Edit Form of LawFirmCategory  ***********/
    public function edit(LawFirmCategory $law_firm_category)
    {
        $law_firm_main_categories = LawFirmMainCategory::active()->get();
        return view('super_admins.law_firm_categories.edit', compact('law_firm_category', 'law_firm_main_categories'));
    }

    /*********Update LawFirmCategory  ***********/
    public function update(CreateRequest $request, LawFirmCategory $law_firm_category)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            if ($request->image) {
                $data['image'] = uploadCroppedFile($request, 'image', 'law_firm_categories', $law_firm_category->image);
            } else {
                $data['image'] = $law_firm_category->image;
            }
            $law_firm_category->update($data);
            $law_firm_category = LawFirmCategory::find($law_firm_category->id);
            $slug = Str::slug($law_firm_category->name . ' ' . $law_firm_category->id, '-');
            $law_firm_category->update([
                'slug' => $slug
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.law_firm_categories.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.law_firm_categories.index')->with('message', 'LawFirmCategory Updated Successfully')->with('message_type', 'success');
    }

    /********* Export  CSV And Excel  **********/
    public function export(Request $request)
    {
        $law_firm_categories = $this->getter($request, "export");
        if (in_array($request->export, ['csv,xlsx'])) {
            $extension = $request->export;
        } else {
            $extension = 'xlsx';
        }
        $filename = "law_firm_categories." . $extension;
        return Excel::download(new LawFirmCategoriesExport($law_firm_categories), $filename);
    }
    /********* Import CSV And Excel  **********/
    public function import(ImportRequest $request)
    {
        $file = $request->file('file');
        Excel::import(new LawFirmCategoriesImport, $file);
        return redirect()->back()->with('message', 'Blog Categories imported Successfully')->with('message_type', 'success');
    }


    /*********Soft DELETE LawFirmCategory ***********/
    public function destroy(LawFirmCategory $law_firm_category)
    {
        $law_firm_category->delete();
        return redirect()->back()->with('message', 'LawFirmCategory Deleted Successfully')->with('message_type', 'success');
    }

    /*********Permanently DELETE LawFirmCategory ***********/
    public function destroyPermanently(Request $request, $law_firm_category)
    {
        $law_firm_category = LawFirmCategory::withTrashed()->find($law_firm_category);
        if ($law_firm_category) {
            if ($law_firm_category->trashed()) {
                if ($law_firm_category->image && file_exists(public_path($law_firm_category->image))) {
                    unlink(public_path($law_firm_category->image));
                }
                $law_firm_category->forceDelete();
                return redirect()->back()->with('message', 'Blog Category Deleted Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'Blog Category is Not in Trash')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'Blog Category Not Found')->with('message_type', 'error');
        }
    }
    /********* Restore LawFirmCategory***********/
    public function restore(Request $request, $law_firm_category)
    {
        $law_firm_category = LawFirmCategory::withTrashed()->find($law_firm_category);
        if ($law_firm_category->trashed()) {
            $law_firm_category->restore();
            return redirect()->back()->with('message', 'Blog Category Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'Blog Category Not Found')->with('message_type', 'error');
        }
    }
}
