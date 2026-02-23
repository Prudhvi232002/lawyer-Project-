<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\SuperAdmin\LawyersExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\Lawyers\CreateRequest;
use App\Http\Requests\ImportRequest;
use App\Http\Requests\SuperAdmin\Lawyers\UpdateRequest;
use App\Imports\SuperAdmin\LawyersImport;
use App\Http\Resources\Web\LawyersResource;
use Inertia\Inertia;
use App\Models\Lawyer;
use App\Models\LawFirm;
use App\Models\LawyerMainCategory;
use App\Models\LawyerCategory;
use App\Models\PricingPlan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Session;
use App\Http\Controllers\NotificationSettingsController;
use App\Models\Role;

class LawyersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /********* Initialize Permission based Middlewares  ***********/
    public function __construct()
    {
        $this->middleware('permission:lawyer.index');
        $this->middleware('permission:lawyer.add', ['only' => ['store']]);
        $this->middleware('permission:lawyer.edit', ['only' => ['update']]);
        $this->middleware('permission:lawyer.delete', ['only' => ['destroy']]);
        $this->middleware('permission:lawyer.export', ['only' => ['export']]);
        $this->middleware('permission:lawyer.import', ['only' => ['import']]);
    }
    /********* Getter For Pagination, Searching And Sorting  ***********/
    public function getter($req = null, $export = null)
    {
        if ($req != null) {
            $lawyers =  Lawyer::withAll();
            if ($req->trash && $req->trash == 'with') {
                $lawyers =  $lawyers->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $lawyers =  $lawyers->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $lawyers = $lawyers->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $lawyers = $lawyers->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $lawyers = $lawyers->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $lawyers = $lawyers->OrderBy('is_approved', 'ASC');
            }
            if ($export != null) { // for export do not paginate
                $lawyers = $lawyers->get();
                return $lawyers;
            }
            $lawyers = $lawyers->get();
            return $lawyers;
        }
        $lawyers = Lawyer::withAll()->OrderBy('is_approved', 'ASC')->get();
        return $lawyers;
    }


    /*********View All Lawyers  ***********/
    public function index(Request $request)
    {
        $lawyers = $this->getter($request);
        $law_firms = LawFirm::approved()->active()->get();
        return view('super_admins.lawyers.index', compact('lawyers', 'law_firms'));
    }

    /*********View Create Form of Lawyer  ***********/
    public function create()
    {
        $law_firms = LawFirm::active()->approved()->get();
        $lawyer_categories = LawyerCategory::active()->get();
        $pricing_plans = PricingPlan::lawyer()->get();
        return view('super_admins.lawyers.create', compact('pricing_plans', 'law_firms', 'lawyer_categories'));
    }

    /*********Store Lawyer  ***********/
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
            if (!$request->is_premium) {
                $data['is_premium'] = 0;
            }
            $data['image'] = uploadCroppedFile($request, 'image', 'lawyers');

            $lawyer = Lawyer::create($data);
            $user = User::where('email', $request->email)->first();
            if ($user) {
                $user->roles()->attach(['lawyer']);
                $lawyer->update(['user_id' => $user->id]);
            } else {
                $user = $lawyer->user()->create([
                    'name' => $lawyer->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);
                $user->markEmailAsVerified();
                $lawyer->update(['user_id' => $user->id]);
                $user->roles()->attach(['lawyer']);
            }
            $lawyer->lawyer_categories()->attach($request->lawyer_category_ids);
            $lawyer->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.lawyers.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.lawyers.index')->with('message', 'Lawyer Created Successfully')->with('message_type', 'success');
    }

    /*********View Lawyer  ***********/
    public function show(Lawyer $lawyer)
    {
        $lawyer = Lawyer::withAll()->find($lawyer->id);
        return view('super_admins.lawyers.show', compact('lawyer'));
    }

    /*********View Edit Form of Lawyer  ***********/
    public function edit(Lawyer $lawyer)
    {
        $pricing_plans = PricingPlan::lawyer()->get();
        $lawyer_categories = LawyerCategory::active()->get();
        $law_firms = LawFirm::active()->approved()->get();
        return view('super_admins.lawyers.edit', compact('lawyer', 'pricing_plans', 'law_firms', 'lawyer_categories'));
    }

    /*********Update Lawyer  ***********/
    public function update(UpdateRequest $request, Lawyer $lawyer)
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
            if (!$request->is_premium) {
                $data['is_premium'] = 0;
            }
            if ($request->image) {
                $data['image'] = uploadCroppedFile($request, 'image', 'lawyers', $lawyer->image);
            } else {
                $data['image'] = $lawyer->image;
            }
            if (isset($request->lawyer_category_ids)) {
                $lawyer->lawyer_categories()->sync($request->lawyer_category_ids);
            }
            $lawyer->update($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.lawyers.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.lawyers.index')->with('message', 'Lawyer Updated Successfully')->with('message_type', 'success');
    }

    /********* Export  CSV And Excel  **********/
    public function export(Request $request)
    {
        $lawyers = $this->getter($request, "export");
        if (in_array($request->export, ['csv,xlsx'])) {
            $extension = $request->export;
        } else {
            $extension = 'xlsx';
        }
        $filename = "lawyers." . $extension;
        return Excel::download(new LawyersExport($lawyers), $filename);
    }
    /********* Import CSV And Excel  **********/
    public function import(ImportRequest $request)
    {
        $file = $request->file('file');
        Excel::import(new LawyersImport, $file);
        return redirect()->back()->with('message', 'Blog Categories imported Successfully')->with('message_type', 'success');
    }

    public function viewBlogs(Lawyer $lawyer)
    {
        $lawyer_blogs = $lawyer->lawyer_posts()->get();
        $lawyer_id = $lawyer->id;
        return view('super_admins.lawyers.show_blogs', compact('lawyer_blogs', 'lawyer_id'));
    }
    public function viewEvents(Lawyer $lawyer)
    {
        $lawyer_events = $lawyer->lawyer_events()->get();
        $lawyer_id = $lawyer->id;
        return view('super_admins.lawyers.show_events', compact('lawyer_events', 'lawyer_id'));
    }
    public function viewSocialLinks(Lawyer $lawyer)
    {
        $lawyer_settings = $lawyer->lawyer_settings()->get();
        $lawyer_id = $lawyer->id;
        return view('super_admins.lawyers.show_social', compact('lawyer_settings', 'lawyer_id'));
    }

    public function profile(Request $request, $lawyer)
    {
        $lawyer = lawyer::withChildrens()->withAll()->where('id', $lawyer)->first();
        if (!$lawyer) {
            abort(404);
        }
        $lawyer = new LawyersResource($lawyer);
        return Inertia::render('Lawyers/Profile', [
            'lawyer' => $lawyer
        ]);
    }


    /*********Soft DELETE Lawyer ***********/
    public function destroy(Lawyer $lawyer)
    {
        $user = $lawyer->user;
        $user->roles()->detach([Role::$Lawyer]);
        if (!$user->hasRole(Role::$LawFirm) && !$user->hasRole(Role::$Customer) && !$user->hasRole(Role::$SuperAdmin)) {
            $user->delete();
        }
        $lawyer->delete();
        return redirect()->back()->with('message', 'Lawyer Deleted Successfully')->with('message_type', 'success');
    }

    /*********Permanently DELETE Lawyer ***********/
    public function destroyPermanently(Request $request, $lawyer)
    {
        $lawyer = Lawyer::withTrashed()->find($lawyer);
        if ($lawyer) {
            if ($lawyer->trashed()) {
                if ($lawyer->image && file_exists(public_path($lawyer->image))) {
                    unlink(public_path($lawyer->image));
                }
                $lawyer->forceDelete();
                return redirect()->back()->with('message', 'Lawyer Deleted Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'Lawyer is Not in Trash')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'Lawyer Not Found')->with('message_type', 'error');
        }
    }
    /********* Restore Lawyer***********/
    public function restore(Request $request, $lawyer)
    {
        $lawyer = Lawyer::withTrashed()->find($lawyer);
        if ($lawyer->trashed()) {
            $lawyer->restore();
            return redirect()->back()->with('message', 'Lawyer Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'Lawyer Not Found')->with('message_type', 'error');
        }
    }
    /*********Approve Lawyer ***********/
    public function approve(Lawyer $lawyer)
    {
        if (!$lawyer->is_approved) {
            $lawyer->update(['is_approved' => 1, 'approved_at' => now()]);
        }
        $user = $lawyer->user;

        NotificationSettingsController::fireNotificationEvent($lawyer,'approve_or_reject_lawyer',[$user],'super_admin/lawyers','Lawyer Approved Successfully');


        // NotificationSettingsController::fireNotificationEvent($lawyer, 'approve_or_reject_lawyer', [$lawyer]);

        return redirect()->back()->with('message', 'Lawyer Approved Successfully')->with('message_type', 'success');
    }
   public function bulkActionLawyers(Request $request, $type)
    {
        if ($type == 'approve') {
            Lawyer::whereIn('id', $request->selected_ids)->update([
                'is_approved' => 1
            ]);
        } elseif ($type == 'disapprove') {
            Lawyer::whereIn('id', $request->selected_ids)->update([
                'is_approved' => 0
            ]);
        } elseif ($type == 'inactive') {
            Lawyer::whereIn('id', $request->selected_ids)->update([
                'is_active' => 0
            ]);
        } elseif ($type == 'active') {
            Lawyer::whereIn('id', $request->selected_ids)->update([
                'is_active' => 1
            ]);
        } elseif ($type == 'delete') {
            foreach ($request->selected_ids as $userId) {
                $lawyer = Lawyer::where('id', $userId)->first();
                $this->destroy($lawyer);
            }
        } elseif ($type == 'feature') {
            Lawyer::whereIn('id', $request->selected_ids)->update([
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
