<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\SuperAdmin\LawFirmsExport;
use App\Http\Controllers\Controller;
use App\Http\Controllers\NotificationSettingsController;
use App\Http\Requests\SuperAdmin\LawFirms\CreateRequest;
use App\Http\Requests\ImportRequest;
use App\Http\Requests\SuperAdmin\LawFirms\UpdateRequest;
use App\Imports\SuperAdmin\LawFirmsImport;
use App\Http\Resources\Web\LawFirmsResource;
use Inertia\Inertia;
use App\Models\LawFirm;
use App\Models\PricingPlan;
use App\Models\LawFirmCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Session;

class LawFirmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /********* Initialize Permission based Middlewares  ***********/
    public function __construct()
    {
        $this->middleware('permission:law_firm.index');
        $this->middleware('permission:law_firm.add', ['only' => ['store']]);
        $this->middleware('permission:law_firm.edit', ['only' => ['update']]);
        $this->middleware('permission:law_firm.delete', ['only' => ['destroy']]);
        $this->middleware('permission:law_firm.export', ['only' => ['export']]);
        $this->middleware('permission:law_firm.import', ['only' => ['import']]);
    }
    /********* Getter For Pagination, Searching And Sorting  ***********/
    public function getter($req = null, $export = null)
    {
        if ($req != null) {
            $law_firms =  LawFirm::withAll();
            if ($req->trash && $req->trash == 'with') {
                $law_firms =  $law_firms->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $law_firms =  $law_firms->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $law_firms = $law_firms->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $law_firms = $law_firms->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $law_firms = $law_firms->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $law_firms = $law_firms->OrderBy('is_approved', 'ASC');
            }
            if ($export != null) { // for export do not paginate
                $law_firms = $law_firms->get();
                return $law_firms;
            }
            $law_firms = $law_firms->get();
            return $law_firms;
        }
        $law_firms = LawFirm::withAll()->OrderBy('is_approved', 'ASC')->get();
        return $law_firms;
    }


    /*********View All LawFirms  ***********/
    public function index(Request $request)
    {
        $law_firms = $this->getter($request);
        return view('super_admins.law_firms.index')->with('law_firms', $law_firms);
    }

    /*********View Create Form of LawFirm  ***********/
    public function create()
    {

        $pricing_plans = PricingPlan::lawFirm()->get();
        $law_firm_categories = LawFirmCategory::active()->get();
        return view('super_admins.law_firms.create', compact('pricing_plans', 'law_firm_categories'));
    }

    /*********Store LawFirm  ***********/
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
            $data['image'] = uploadCroppedFile($request, 'image', 'law_firms');

            $law_firm = LawFirm::create($data);
            $user = User::where('email', $request->email)->first();
            if ($user) {
                $user->roles()->attach(['law_firm']);
                $law_firm->update(['user_id' => $user->id]);
            } else {
                $user = $law_firm->user()->create([
                    'name' => $law_firm->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);
                $user->markEmailAsVerified();
                $law_firm->update(['user_id' => $user->id]);
                $user->roles()->attach(['law_firm']);
            }
            $law_firm->law_firm_categories()->attach($request->law_firm_category_ids);
            $law_firm->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.law_firms.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.law_firms.index')->with('message', 'LawFirm Created Successfully')->with('message_type', 'success');
    }

    /*********View LawFirm  ***********/
    public function show(LawFirm $law_firm)
    {
        return view('super_admins.law_firms.show', compact('law_firm'));
    }

    /*********View Edit Form of LawFirm  ***********/
    public function edit(LawFirm $law_firm)
    {
        $law_firm_categories = LawFirmCategory::active()->get();
        $pricing_plans = PricingPlan::lawFirm()->get();
        return view('super_admins.law_firms.edit', compact('law_firm', 'pricing_plans', 'law_firm_categories'));
    }

    /*********Update LawFirm  ***********/
    public function update(UpdateRequest $request, LawFirm $law_firm)
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
                $data['image'] = uploadCroppedFile($request, 'image', 'law_firms', $law_firm->image);
            } else {
                $data['image'] = $law_firm->image;
            }
            if (isset($request->law_firm_category_ids)) {
                $law_firm->law_firm_categories()->sync($request->law_firm_category_ids);
            }
            $law_firm->update($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.law_firms.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.law_firms.index')->with('message', 'LawFirm Updated Successfully')->with('message_type', 'success');
    }

    /********* Export  CSV And Excel  **********/
    public function export(Request $request)
    {
        $law_firms = $this->getter($request, "export");
        if (in_array($request->export, ['csv,xlsx'])) {
            $extension = $request->export;
        } else {
            $extension = 'xlsx';
        }
        $filename = "law_firms." . $extension;
        return Excel::download(new LawFirmsExport($law_firms), $filename);
    }
    /********* Import CSV And Excel  **********/
    public function import(ImportRequest $request)
    {
        $file = $request->file('file');
        Excel::import(new LawFirmsImport, $file);
        return redirect()->back()->with('message', 'Blog Categories imported Successfully')->with('message_type', 'success');
    }


    /*********Soft DELETE LawFirm ***********/
    public function destroy(LawFirm $law_firm)
    {
        $law_firm->delete();
        return redirect()->back()->with('message', 'LawFirm Deleted Successfully')->with('message_type', 'success');
    }

    /*********Permanently DELETE LawFirm ***********/
    public function destroyPermanently(Request $request, $law_firm)
    {
        $law_firm = LawFirm::withTrashed()->find($law_firm);
        if ($law_firm) {
            if ($law_firm->trashed()) {
                if ($law_firm->image && file_exists(public_path($law_firm->image))) {
                    unlink(public_path($law_firm->image));
                }
                $law_firm->forceDelete();
                return redirect()->back()->with('message', 'LawFirm Deleted Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'LawFirm is Not in Trash')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'LawFirm Not Found')->with('message_type', 'error');
        }
    }
    /********* Restore LawFirm***********/
    public function restore(Request $request, $law_firm)
    {
        $law_firm = LawFirm::withTrashed()->find($law_firm);
        if ($law_firm->trashed()) {
            $law_firm->restore();
            return redirect()->back()->with('message', 'LawFirm Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'LawFirm Not Found')->with('message_type', 'error');
        }
    }
    /*********Approve LawFirm ***********/
    public function approve(LawFirm $law_firm)
    {
        if (!$law_firm->is_approved) {
            $law_firm->update(['is_approved' => 1, 'approved_at' => now()]);
        }
        $user = $law_firm->user;
        NotificationSettingsController::fireNotificationEvent($law_firm,'approve_or_reject_law_firm',[$user],'super_admin/law_firms','Law Firm Approved Successfully');

        return redirect()->back()->with('message', 'LawFirm Approved Successfully')->with('message_type', 'success');
    }


    public function profile(Request $request, $law_firm)
    {
        $law_firm = LawFirm::withChildrens()->withAll()->where('id', $law_firm)->first();
        if (!$law_firm) {
            abort(404);
        }
        $law_firm = new LawFirmsResource($law_firm);
        return Inertia::render('LawFirms/Profile', [
            'law_firm' => $law_firm
        ]);
    }

    public function bulkActionLawFirms(Request $request, $type)
    {
        if ($type == 'approve') {
            LawFirm::whereIn('id', $request->selected_ids)->update([
                'is_approved' => 1
            ]);
        } elseif ($type == 'disapprove') {
            LawFirm::whereIn('id', $request->selected_ids)->update([
                'is_approved' => 0
            ]);
        } elseif ($type == 'inactive') {
            LawFirm::whereIn('id', $request->selected_ids)->update([
                'is_active' => 0
            ]);
        } elseif ($type == 'active') {
            LawFirm::whereIn('id', $request->selected_ids)->update([
                'is_active' => 1
            ]);
        } elseif ($type == 'delete') {
            foreach ($request->selected_ids as $userId) {
                $business = LawFirm::where('id', $userId)->first();
                $this->destroy($business);
            }
        } elseif ($type == 'feature') {
            LawFirm::whereIn('id', $request->selected_ids)->update([
                'is_featured' => 1
            ]);
        } else {
            Session::flash('message', 'Some Thing Went Wrong !');
            return response()->json('Success', 200);
        }
        Session::flash('message', 'Updated Successfully');
        return response()->json('Success', 200);
    }
}
