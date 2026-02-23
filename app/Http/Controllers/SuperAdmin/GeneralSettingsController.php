<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\GeneralSettings\UpdateRequest;
use App\Models\GeneralSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;


class GeneralSettingsController extends Controller
{
    /********* Initialize Permission based Middlewares  ***********/
    public function __construct()
    {
        $this->middleware('permission:general_setting.index');
        $this->middleware('permission:general_setting.add', ['only' => ['store']]);
        $this->middleware('permission:general_setting.edit', ['only' => ['update']]);
        $this->middleware('permission:general_setting.delete', ['only' => ['destroy']]);
        $this->middleware('permission:general_setting.export', ['only' => ['export']]);
        $this->middleware('permission:general_setting.import', ['only' => ['import']]);
    }
    public function index()
    {
        $general_settings = GeneralSetting::where('is_specific', 0)->get();
        $heading = 'General Settings';
        return view('super_admins.general_settings.index')->with('general_settings', $general_settings)->with('heading', $heading);
    }

    public function getSocialLinksSettings()
    {
        $general_settings = GeneralSetting::where('is_specific', 1)->where('page', 'website_social_links')->get();
        $heading = 'Social Links Settings';
        return view('super_admins.general_settings.index')->with('general_settings', $general_settings)->with('heading', $heading);
    }
    public function getEmailconfigurationsSettings()
    {
        $general_settings = GeneralSetting::where('is_specific', 1)->where('page', 'email_settings')->get();
        $heading = 'Email Configurations Settings';
        return view('super_admins.general_settings.index')->with('general_settings', $general_settings)->with('heading', $heading);
    }
    public function getPaymentMethodsSettings()
    {
        $general_settings = GeneralSetting::where('is_specific', 1)->where('page', 'payment_method_settings')->get();
        $heading = 'Subscription Methods Settings';
        return view('super_admins.general_settings.index')->with('general_settings', $general_settings)->with('heading', $heading);
    }

    public function getHomePageStatisticsSettings()
    {
        $general_settings = GeneralSetting::where('is_specific', 1)->where('page', 'home_page_statistics')->get();
        $heading = 'Home Page Statistics Settings';
        return view('super_admins.general_settings.index')->with('general_settings', $general_settings)->with('heading', $heading);
    }

    public function getFooterSettings()
    {
        $general_settings = GeneralSetting::where('is_specific', 1)->where('page', 'website_footer')->get();
        $heading = 'Footer Links Settings';
        return view('super_admins.general_settings.index')->with('general_settings', $general_settings)->with('heading', $heading);
    }
    public function getconfigurationsSettings()
    {
        $general_settings = GeneralSetting::where('is_specific', 1)->where('page', 'configurations')->get();
        $heading = 'Configurations Settings';
        return view('super_admins.general_settings.index')->with('general_settings', $general_settings)->with('heading', $heading);
    }
    public function getThemesSettings()
    {
        $general_settings = GeneralSetting::where('is_specific', 1)->where('page', 'theme')->get();
        $heading = 'Theme Settings';
        return view('super_admins.general_settings.index')->with('general_settings', $general_settings)->with('heading', $heading);
    }

    public function clearCache()
    {
        Artisan::call('cache:clear');
        return redirect()->back()->with('message', 'Cache Cleared Successfully')->with('message_type', 'success');
    }

    public function seoSettings()
    {

        $general_settings = GeneralSetting::where('is_specific', 1)->where('page', 'seo_settings')->get();
        // dd($general_settings);
        $heading = 'SEO Settings';
        return view('super_admins.general_settings.index')->with('general_settings', $general_settings)->with('heading', $heading);
    }

    public function update(UpdateRequest $request)
    {
        // dd($request->all());
        $settings = generalSettings();
        try {
            DB::beginTransaction();

            foreach ($request->general_setting_name as $key => $name) {
                if (isset($request->general_setting_value[$key])) {
                    $previous_value = $settings[$name];
                    if ($request->general_setting_type[$key] == 'image') {
                        $file = $request->general_setting_value[$key];
                        if ($file) {

                            if (!empty($previous_value) && file_exists(public_path($previous_value))) {
                                unlink(public_path($previous_value));
                            }

                            $image = $file;
                            $file_name = $name . '.' . $image->getClientOriginalExtension();
                            $image->move(public_path() . '/images/settings', $file_name);
                            $file_name = '/images/settings/' . $file_name;
                        } else {
                            $file_name = $previous_value;
                        }

                        GeneralSetting::where('name', $name)->update(['value' => $file_name]);
                    } elseif ($request->general_setting_type[$key] == 'array') {
                        $tagsArray = explode(',', $request->general_setting_value[$key]);
                        $formattedArray = json_encode(array_map('trim', $tagsArray));
                        GeneralSetting::where('name', $name)->update(['value' => $formattedArray]);
                    } else {
                        GeneralSetting::where('name', $name)->update(['value' => $request->general_setting_value[$key]]);
                    }
                } else {
                    if ($request->general_setting_type[$key] != 'image') {
                        GeneralSetting::where('name', $name)->update(['value' => $request->general_setting_value[$key]]);
                    }
                }
            }

            DB::commit();
            return redirect()->back()->with('message', 'General Settings Updated Successfully')->with('message_type', 'success');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
    }
}
