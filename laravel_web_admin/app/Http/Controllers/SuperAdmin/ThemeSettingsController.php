<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\GeneralSettings\UpdateRequest;
use App\Models\GeneralSetting;
use App\Models\HomeComponentOrders;
use App\Models\ThemeSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ThemeSettingsController extends Controller
{
    /********* Initialize Permission based Middlewares  ***********/
    public function __construct()
    {
        // $this->middleware('permission:general_setting.index');
        // $this->middleware('permission:general_setting.add', ['only' => ['store']]);
        // $this->middleware('permission:general_setting.edit', ['only' => ['update']]);
        // $this->middleware('permission:general_setting.delete', ['only' => ['destroy']]);
        // $this->middleware('permission:general_setting.export', ['only' => ['export']]);
        // $this->middleware('permission:general_setting.import', ['only' => ['import']]);
    }
    public function index()
    {
        $theme_settings = ThemeSetting::all()->groupBy('theme_code');
        $heading = 'Theme Settings';
        // dd($theme_settings);
        return view('super_admins.theme_settings.index')->with('theme_settings', $theme_settings)->with('heading', $heading);
    }

    public function update(Request $request)
    {
        $request->validate([
            'active_theme' => 'required|string',
            'theme_setting_ids' => 'array',
            'theme_setting_value' => 'array',
        ]);

        try {
            DB::beginTransaction();
            ThemeSetting::query()->update(['is_active' => 0]);
            $active_theme_code = $request->active_theme;
            $activeSettings = ThemeSetting::where('theme_code', $active_theme_code)->get();

            foreach ($activeSettings as $setting) {
                $setting->update(['is_active' => 1]);
            }
            if (!empty($request->theme_setting_value)) {
                foreach ($request->theme_setting_value as $id => $value) {
                    $themeSetting = ThemeSetting::find($id);
                    if ($themeSetting && $themeSetting->is_editable) {
                        $themeSetting->update(['value' => $value]);
                    }
                }
            }
            DB::commit();
            return redirect()->back()
                ->with('message', 'Theme activated successfully!')
                ->with('message_type', 'success');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('message', 'Something went wrong: ' . $e->getMessage())
                ->with('message_type', 'error');
        }
    }



    public function homeIndex()
    {
        $home_page_components = HomeComponentOrders::orderBy('sort_order')->get();
        $heading = 'Home Page Settings';
        return view('super_admins.home_page_settings.index')->with('heading', $heading)->with('home_page_components', $home_page_components);
    }

    public function homePage(Request $request)
    {
        $order = $request->order;

        try {
            DB::beginTransaction();

            foreach ($order as $index => $id) {
                $component = HomeComponentOrders::find($id);
                if ($component) {
                    $component->sort_order = $index + 1;
                    $component->save();
                }
            }

            DB::commit();
            return response()->json([
                'message' => 'Home Page Order saved successfully.',
                'status' => 'success'
            ]);
        } catch (\Throwable $e) {
            DB::rollback();
            return response()->json([
                'message' => 'Something went wrong: ' . $e->getMessage(),
                'status' => 'error'
            ]);
        }
    }

    public function homePageStatus(Request $request)
    {
        // dd($request->all());
        try {
            DB::beginTransaction();

            $component = HomeComponentOrders::find($request->id);
            if ($component) {
                $component->is_active = $request->is_active;
                $component->save();
            }

            DB::commit();
            return response()->json([
                'message' => 'Component Status Updated successfully.',
                'status' => 'success'
            ]);
        } catch (\Throwable $e) {
            DB::rollback();
            return response()->json([
                'message' => 'Something went wrong: ' . $e->getMessage(),
                'status' => 'error'
            ]);
        }
    }
}
