<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\SuperAdmin\CustomersExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\Customers\CreateRequest;
use App\Http\Requests\ImportRequest;
use App\Http\Requests\SuperAdmin\Customers\UpdateRequest;
use App\Imports\SuperAdmin\CustomersImport;
use App\Models\Customer;
use App\Models\PricingPlan;
use App\Models\Role;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /********* Initialize Permission based Middlewares  ***********/
    public function __construct()
    {
        $this->middleware('permission:customer.index');
        $this->middleware('permission:customer.add', ['only' => ['store']]);
        $this->middleware('permission:customer.edit', ['only' => ['update']]);
        $this->middleware('permission:customer.delete', ['only' => ['destroy']]);
        $this->middleware('permission:customer.export', ['only' => ['export']]);
        $this->middleware('permission:customer.import', ['only' => ['import']]);
    }
    /********* Getter For Pagination, Searching And Sorting  ***********/
    public function getter($req = null, $export = null)
    {
        if ($req != null) {
            $customers =  Customer::withAll();
            if ($req->trash && $req->trash == 'with') {
                $customers =  $customers->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $customers =  $customers->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $customers = $customers->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $customers = $customers->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $customers = $customers->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $customers = $customers->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $customers = $customers->get();
                return $customers;
            }
            $customers = $customers->get();
            return $customers;
        }
        $customers = Customer::withAll()->OrderBy('id', 'desc')->get();
        return $customers;
    }


    /*********View All Customers  ***********/
    public function index(Request $request)
    {
        $customers = $this->getter($request);
        return view('super_admins.customers.index')->with('customers', $customers);
    }

    /*********View Create Form of Customer  ***********/
    public function create()
    {
        return view('super_admins.customers.create');
    }

    /*********Store Customer  ***********/
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
            $data['image'] = uploadCroppedFile($request, 'image', 'customers');

            $customer = Customer::create($data);
            $user = User::where('email', $request->email)->first();
            if ($user) {
                $user->roles()->attach(['customer']);
                $customer->update(['user_id' => $user->id]);
            } else {
                $user = $customer->user()->create([
                    'name' => $customer->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);
                $user->markEmailAsVerified();
                $customer->update(['user_id' => $user->id]);
                $user->roles()->attach(['customer']);
            }
            $customer->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.customers.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.customers.index')->with('message', 'Customer Created Successfully')->with('message_type', 'success');
    }

    /*********View Customer  ***********/
    public function show(Customer $customer)
    {
        return view('super_admins.customers.show', compact('customer'));
    }

    /*********View Edit Form of Customer  ***********/
    public function edit(Customer $customer)
    {
        return view('super_admins.customers.edit', compact('customer'));
    }

    /*********Update Customer  ***********/
    public function update(UpdateRequest $request, Customer $customer)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            if ($request->image) {
                $data['image'] = uploadCroppedFile($request, 'image', 'customers', $customer->image);
            } else {
                $data['image'] = $customer->image;
            }
            $customer->update($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.customers.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.customers.index')->with('message', 'Customer Updated Successfully')->with('message_type', 'success');
    }

    /********* Export  CSV And Excel  **********/
    public function export(Request $request)
    {
        $customers = $this->getter($request, "export");
        if (in_array($request->export, ['csv,xlsx'])) {
            $extension = $request->export;
        } else {
            $extension = 'xlsx';
        }
        $filename = "customers." . $extension;
        return Excel::download(new CustomersExport($customers), $filename);
    }
    /********* Import CSV And Excel  **********/
    public function import(ImportRequest $request)
    {
        $file = $request->file('file');
        Excel::import(new CustomersImport, $file);
        return redirect()->back()->with('message', 'Blog Categories imported Successfully')->with('message_type', 'success');
    }


    /*********Soft DELETE Customer ***********/
    public function destroy(Customer $customer)
    {
        $user = $customer->user;
        $user->roles()->detach([Role::$Customer]);
        if (!$user->hasRole(Role::$LawFirm) && !$user->hasRole(Role::$Lawyer) && !$user->hasRole(Role::$SuperAdmin)) {
            $user->delete();
        }
        $customer->delete();
        return redirect()->back()->with('message', 'Customer Deleted Successfully')->with('message_type', 'success');
    }

    /*********Permanently DELETE Customer ***********/
    public function destroyPermanently(Request $request, $customer)
    {
        $customer = Customer::withTrashed()->find($customer);
        if ($customer) {
            if ($customer->trashed()) {
                if ($customer->image && file_exists(public_path($customer->image))) {
                    unlink(public_path($customer->image));
                }
                $customer->forceDelete();
                return redirect()->back()->with('message', 'Customer Deleted Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'Customer is Not in Trash')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'Customer Not Found')->with('message_type', 'error');
        }
    }
    /********* Restore Customer***********/
    public function restore(Request $request, $customer)
    {
        $customer = Customer::withTrashed()->find($customer);
        if ($customer->trashed()) {
            $customer->restore();
            return redirect()->back()->with('message', 'Customer Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'Customer Not Found')->with('message_type', 'error');
        }
    }
    /*********Approve Customer ***********/
    public function approve(Customer $customer)
    {
        if (!$customer->is_approved) {
            $customer->update(['is_approved' => 1, 'approved_at' => now()]);
        }
        return redirect()->back()->with('message', 'Customer Approved Successfully')->with('message_type', 'success');
    }
}
