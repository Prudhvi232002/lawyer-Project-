<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Exports\SuperAdmin\ContactsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\Currencies\CreateRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\SuperAdmin\ContactsImport;
use App\Models\Currency;
use App\Models\CurrencyCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class CurruncyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /********* Initialize Permission based Middlewares  ***********/
    public function __construct()
    {
        $this->middleware('permission:currency.index');
        $this->middleware('permission:currency.add', ['only' => ['store']]);
        $this->middleware('permission:currency.edit', ['only' => ['update']]);
        $this->middleware('permission:currency.delete', ['only' => ['destroy']]);
        $this->middleware('permission:currency.export', ['only' => ['export']]);
        $this->middleware('permission:currency.import', ['only' => ['import']]);
    }
    /********* Getter For Pagination, Searching And Sorting  ***********/
    public function getter($req = null, $export = null)
    {
        if ($req != null) {
            $currencies =  Currency::withAll();
            if ($req->trash && $req->trash == 'with') {
                $currencies =  $currencies->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $currencies =  $currencies->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $currencies = $currencies->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $currencies = $currencies->whereLike(['name', 'description'], $req->search);
            }
            if ($req->sort_field != null && $req->sort_type != null) {
                $currencies = $currencies->OrderBy($req->sort_field, $req->sort_type);
            } else {
                $currencies = $currencies->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $currencies = $currencies->get();
                return $currencies;
            }
            $currencies = $currencies->get();
            return $currencies;
        }
        $currencies = Currency::withAll()->orderBy('id', 'desc')->get();
        return $currencies;
    }


    /*********View All Currencies  ***********/
    public function index(Request $request)
    {
        $currencies = $this->getter($request);
        return view('super_admins.currencies.index')->with('currencies', $currencies);
    }

    /*********View Create Form of Currency  ***********/
    public function create()
    {
        return view('super_admins.currencies.create');
    }

    /*********Store Currency  ***********/
    public function store(Request $request)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if ($request->is_default) {
                Currency::where('is_default', 1)->update([
                    'is_default' => 0
                ]);
            }
            $currency = Currency::create($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.currencies.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.currencies.index')->with('message', 'Currency Created Successfully')->with('message_type', 'success');
    }

    /*********View Currency  ***********/
    public function show(Currency $currency)
    {
        return view('super_admins.currencies.show', compact('currency'));
    }

    /*********View Edit Form of Currency  ***********/
    public function edit(Currency $currency)
    {
        $currency_codes =  CurrencyCode::all();
        return view('super_admins.currencies.edit', compact('currency', 'currency_codes'));
    }

    /*********Update Currency  ***********/
    public function update(Request $request, Currency $currency)
    {

        if ($currency->code == 'USD' || $currency->code == 'usd') {
            $data = $request->except(['code']);
        } else {
            $data = $request->all();
        }
        if ($request->is_default && !$currency->is_default) {
            Currency::where('is_default', 1)->update([
                'is_default' => 0
            ]);
            $data['value'] = 1;
            $currency->update($data);
            return redirect()->route('super_admin.currencies.index')->with('message', 'Currency Updated Successfully')->with('message_type', 'success');
        } else if ($currency->is_default && !$request->is_default) {
            return redirect()->back()->with('message', 'One Currency must be Default')->with('message_type', 'error');
        } else {
            $currency->update($data);
            return redirect()->route('super_admin.currencies.index')->with('message', 'Currency Updated Successfully')->with('message_type', 'success');
        }
    }

    /*********Soft DELETE Currency ***********/
    public function destroy(Currency $currency)
    {
        if ($currency->is_default) {
            return redirect()->back()->with('message', 'You cannot delete default currency')->with('message_type', 'error');
        } else {
            $currency->delete();
            return redirect()->back()->with('message', 'Currency Deleted Successfully')->with('message_type', 'success');
        }
    }

    /*********Permanently DELETE Currency ***********/
    public function destroyPermanently(Request $request, $currency)
    {
        $currency = Currency::withTrashed()->find($currency);
        if ($currency) {
            if ($currency->trashed()) {
                $currency->forceDelete();
                return redirect()->back()->with('message', 'Currency Deleted Successfully')->with('message_type', 'success');
            } else {
                return redirect()->back()->with('message', 'Currency is Not in Trash')->with('message_type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'Currency Not Found')->with('message_type', 'error');
        }
    }
    /********* Restore Currency***********/
    public function restore(Request $request, $currency)
    {
        $currency = Currency::withTrashed()->find($currency);
        if ($currency->trashed()) {
            $currency->restore();
            return redirect()->back()->with('message', 'Currency Restored Successfully')->with('message_type', 'success');
        } else {
            return redirect()->back()->with('message', 'Currency Not Found')->with('message_type', 'error');
        }
    }
}
