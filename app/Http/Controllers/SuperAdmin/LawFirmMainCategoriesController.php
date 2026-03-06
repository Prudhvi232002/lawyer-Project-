<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\SuperAdmin\LawFirmMainCategoriesExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\LawFirmMainCategories\CreateRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\SuperAdmin\LawFirmMainCategoriesImport;
use App\Models\LawFirmMainCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class LawFirmMainCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /********* Initialize Permission based Middlewares  ***********/
    public function __construct()
    {
        $this->middleware('permission:law_firm_main_category.index');
        $this->middleware('permission:law_firm_main_category.add', ['only' => ['store']]);
        $this->middleware('permission:law_firm_main_category.edit', ['only' => ['update']]);
        $this->middleware('permission:law_firm_main_category.delete', ['only' => ['destroy']]);
        $this->middleware('permission:law_firm_main_category.export', ['only' => ['export']]);
        $this->middleware('permission:law_firm_main_category.import', ['only' => ['import']]);
    }
    /********* Getter For Pagination, Searching And Sorting  ***********/
    public function getter($req = null, $export = null)
    {
        if ($req != null) {
            $law_firm_main_categories =  LawFirmMainCategory::withAll();
            if ($req->trash && $req->trash == 'with') {
                $law_firm_main_categories =  $law_firm_main_categories->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $law_firm_main_categories =  $law_firm_main_categories->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $law_firm_main_categories = $law_firm_main_categories->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $law_firm_main_categories = $law_firm_main_categories->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $law_firm_main_categories = $law_firm_main_categories->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $law_firm_main_categories = $law_firm_main_categories->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $law_firm_main_categories = $law_firm_main_categories->get();
                return $law_firm_main_categories;
            }
            $law_firm_main_categories = $law_firm_main_categories->get();
            return $law_firm_main_categories;
        }
        $law_firm_main_categories = LawFirmMainCategory::withAll()->orderBy('id', 'desc')->get();
        return $law_firm_main_categories;
    }


    /*********View All LawFirmMainCategories  ***********/
    public function index(Request $request)
    {
        $law_firm_main_categories = $this->getter($request);
        return view('super_admins.law_firm_main_categories.index')->with('law_firm_main_categories', $law_firm_main_categories);
    }

    /*********View Create Form of LawFirmMainCategory  ***********/
    public function create()
    {

        return view('super_admins.law_firm_main_categories.create');
    }

    /*********Store LawFirmMainCategory  ***********/
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
            $data['image'] = uploadCroppedFile($request, 'image', 'law_firm_main_categories');
            $data['icon'] = uploadCroppedFile($request, 'icon', 'law_firm_main_categories');

            $law_firm_main_category = LawFirmMainCategory::create($data);
            $law_firm_main_category->slug = Str::slug($law_firm_main_category->name . ' ' . $law_firm_main_category->id, '-');
            $law_firm_main_category->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.law_firm_main_categories.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.law_firm_main_categories.index')->with('message', 'LawFirmMainCategory Created Successfully')->with('message_type', 'success');
    }

    /*********View LawFirmMainCategory  ***********/
    public function show(LawFirmMainCategory $law_firm_main_category)
    {
        return view('super_admins.law_firm_main_categories.show', compact('law_firm_main_category'));
    }

    /*********View Edit Form of LawFirmMainCategory  ***********/
    public function edit(LawFirmMainCategory $law_firm_main_category)
    {
        return view('super_admins.law_firm_main_categories.edit', compact('law_firm_main_category'));
    }

    /*********Update LawFirmMainCategory  ***********/
    public function update(CreateRequest $request, LawFirmMainCategory $law_firm_main_category)
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
                $data['image'] = uploadCroppedFile($request, 'image', 'law_firm_main_categories', $law_firm_main_category->image);
            } else {
                $data['image'] = $law_firm_main_category->image;
            }
            if ($request->icon) {
                $data['icon'] = uploadCroppedFile($request, 'icon', 'law_firm_main_categories', $law_firm_main_category->icon);
            } else {
                $data['icon'] = $law_firm_main_category->icon;
            }
            $law_firm_main_category->update($data);
            $law_firm_main_category = LawFirmMainCategory::find($law_firm_main_category->id);
            $slug = Str::slug($law_firm_main_category->name . ' ' . $law_firm_main_category->id, '-');
            $law_firm_main_category->update([
                'slug' => $slug
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.law_firm_main_categories.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.law_firm_main_categories.index')->with('message', 'LawFirmMainCategory Updated Successfully')->with('message_type', 'success');
    }

    /********* Export  CSV And Excel  **********/
    public function export(Request $request)
    {
        $law_firm_main_categories = $this->getter($request, "export");
        if (in_array($request->export, ['csv,xlsx'])) {
            $extension = $request->export;
        } else {
            $extension = 'xlsx';
        }
        $filename = "law_firm_main_categories." . $extension;
        return Excel::download(new LawFirmMainCategoriesExport($law_firm_main_categories), $filename);
    }
    /********* Import CSV And Excel  **********/
    public function import(ImportRequest $request)
    {
        $file = $request->file('file');
        Excel::import(new LawFirmMainCategoriesImport, $file);
        return redirect()->back()->with('message', 'LawFirm Main Categories imported Successfully')->with('message_type', 'success');
    }


    /*********Soft DELETE LawFirmMainCategory ***********/
    public function destroy(LawFirmMainCategory $law_firm_main_category)
    {
        $law_firm_main_category->delete();
        return redirect()->back()->with('message', 'LawFirmMainCategory Deleted Successfully')->with('message_type', 'success');
    }

    /*********Permanently DELETE LawFirmMainCategory ***********/
    public function destroyPermanently(Request $request, $law_firm_main_category)
    {
        $law_firm_main_category = LawFirmMainCategory::withTrashed()->find($law_firm_main_category);
        if ($law_firm_main_category) {
            if ($law_firm_main_category->trashed()) {
                if ($law_firm_main_category->image && file_exists(public_path($law_firm_main_category->image))) {
                    unlink(public_path($law_firm_main_category->image));
                }
                $law_firm_main_category->forceDelete();
                return redirect()->back()->with('message', 'LawFirm Main Category Deleted Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'LawFirm Main Category is Not in Trash')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'LawFirm Main Category Not Found')->with('message_type', 'error');
        }
    }
    /********* Restore LawFirmMainCategory***********/
    public function restore(Request $request, $law_firm_main_category)
    {
        $law_firm_main_category = LawFirmMainCategory::withTrashed()->find($law_firm_main_category);
        if ($law_firm_main_category->trashed()) {
            $law_firm_main_category->restore();
            return redirect()->back()->with('message', 'LawFirm Main Category Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'LawFirm Main Category Not Found')->with('message_type', 'error');
        }
    }
}
