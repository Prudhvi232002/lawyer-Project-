<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\SuperAdmin\LanguagesExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\AppCarousels\CreateRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\SuperAdmin\LanguagesImport;
use App\Models\AppCarousel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class AppCarouselsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  /********* Initialize Permission based Middlewares  ***********/
  public function __construct()
  {
    //   $this->middleware('permission:app_carousel.index');
    //   $this->middleware('permission:app_carousel.add', ['only' => ['store']]);
    //   $this->middleware('permission:app_carousel.edit', ['only' => ['update']]);
    //   $this->middleware('permission:app_carousel.delete', ['only' => ['destroy']]);
    //   $this->middleware('permission:app_carousel.export', ['only' => ['export']]);
    //   $this->middleware('permission:app_carousel.import', ['only' => ['import']]);
  }
    /********* Getter For Pagination, Searching And Sorting  ***********/
    public function getter($req = null, $export = null)
    {
        if ($req != null) {
            $app_carousels =  AppCarousel::withAll();
            if ($req->trash && $req->trash == 'with') {
                $app_carousels =  $app_carousels->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $app_carousels =  $app_carousels->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $app_carousels = $app_carousels->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $app_carousels = $app_carousels->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $app_carousels = $app_carousels->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $app_carousels = $app_carousels->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $app_carousels = $app_carousels->get();
                return $app_carousels;
            }
            $app_carousels = $app_carousels->get();
            return $app_carousels;
        }
        $app_carousels = AppCarousel::withAll()->orderBy('id', 'desc')->get();
        return $app_carousels;
    }


    /*********View All Languages  ***********/
    public function index(Request $request)
    {
        $app_carousels = $this->getter($request);
        return view('super_admins.app_carousels.index')->with('app_carousels', $app_carousels);
    }

    /*********View Create Form of AppCarousel  ***********/
    public function create()
    {
        return view('super_admins.app_carousels.create');
    }

    /*********Store AppCarousel  ***********/
    public function store(CreateRequest $request)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            $data['image'] = uploadCroppedFile($request,'image','app_carousels');

            $app_carousel = AppCarousel::create($data);
           
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
            return redirect()->route('super_admin.app_carousels.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.app_carousels.index')->with('message', 'AppCarousel Created Successfully')->with('message_type', 'success');
    }

    /*********View AppCarousel  ***********/
    public function show(AppCarousel $app_carousel)
    {
        return view('super_admins.app_carousels.show', compact('app_carousel'));
    }

    /*********View Edit Form of AppCarousel  ***********/
    public function edit(AppCarousel $app_carousel)
    {
        return view('super_admins.app_carousels.edit', compact('app_carousel'));
    }

    /*********Update AppCarousel  ***********/
    public function update(CreateRequest $request, AppCarousel $app_carousel)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            if ($request->image) {
                $data['image'] = uploadCroppedFile($request,'image','app_carousels',$app_carousel->image);
            } else {
                $data['image'] = $app_carousel->image;
            }
            $app_carousel->update($data);
          
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.app_carousels.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.app_carousels.index')->with('message', 'AppCarousel Updated Successfully')->with('message_type', 'success');
    }

    /********* Export  CSV And Excel  **********/
    public function export(Request $request)
    {
        $app_carousels = $this->getter($request, "export");
        if (in_array($request->export, ['csv,xlsx'])) {
            $extension = $request->export;
        } else {
            $extension = 'xlsx';
        }
        $filename = "app_carousels." . $extension;
        return Excel::download(new LanguagesExport($app_carousels), $filename);
    }
    /********* Import CSV And Excel  **********/
    public function import(ImportRequest $request)
    {
        $file = $request->file('file');
        Excel::import(new LanguagesImport, $file);
        return redirect()->back()->with('message', 'Blog Categories imported Successfully')->with('message_type', 'success');
    }


    /*********Soft DELETE AppCarousel ***********/
    public function destroy(AppCarousel $app_carousel)
    {
        if ($app_carousel->is_default) {
            return redirect()->back()->with('message', 'Cannot Delete Default AppCarousel')->with('message_type', 'error');
        }
        $app_carousel->delete();
        return redirect()->back()->with('message', 'AppCarousel Deleted Successfully')->with('message_type', 'success');
    }

    /*********Permanently DELETE AppCarousel ***********/
    public function destroyPermanently(Request $request, $app_carousel)
    {
        $app_carousel = AppCarousel::withTrashed()->find($app_carousel);
        if ($app_carousel) {
            if ($app_carousel->trashed()) {
                if ($app_carousel->image && file_exists(public_path($app_carousel->image))) {
                    unlink(public_path($app_carousel->image));
                }
                $app_carousel->forceDelete();
                return redirect()->back()->with('message', 'Blog Category Deleted Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'Blog Category is Not in Trash')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'Blog Category Not Found')->with('message_type', 'error');
        }
    }
    /********* Restore AppCarousel***********/
    public function restore(Request $request, $app_carousel)
    {
        $app_carousel = AppCarousel::withTrashed()->find($app_carousel);
        if ($app_carousel->trashed()) {
            $app_carousel->restore();
            return redirect()->back()->with('message', 'Blog Category Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'Blog Category Not Found')->with('message_type', 'error');
        }
    }
}
