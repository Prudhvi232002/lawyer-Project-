<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\UpdateRequest;
use App\Models\Setting;
use App\Models\SuperAdmin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Hash;


class SystemInformationsController extends Controller
{

    public function index()
    {
        $system_info = [
            // PHP Information
            'php_version' => phpversion(),
            'laravel_version' => app()->version(),
            'php_memory_limit' => ini_get('memory_limit'),
            'php_max_execution_time' => ini_get('max_execution_time'),
            'php_upload_max_filesize' => ini_get('upload_max_filesize'),
            'php_post_max_size' => ini_get('post_max_size'),
            'php_disabled_functions' => ini_get('disable_functions') ?: 'None',
            'php_loaded_extensions' => implode(', ', get_loaded_extensions()),

            // Laravel & Server Details
            'cache_driver' => config('cache.default'),
            'session_driver' => config('session.driver'),
            'queue_driver' => config('queue.default'),
            'server_software' => $_SERVER['SERVER_SOFTWARE'] ?? 'N/A',
            'server_ip' => $_SERVER['SERVER_ADDR'] ?? 'N/A',
            'server_port' => $_SERVER['SERVER_PORT'] ?? 'N/A',

            // Database Details
            'database_connection' => config('database.default'),
            'database_host' => config('database.connections.' . config('database.default') . '.host'),
            'database_name' => config('database.connections.' . config('database.default') . '.database'),
            'database_version' => \DB::select('SELECT version() as version')[0]->version ?? 'N/A',

            // Storage & Disk Details
            'free_disk_space' => round(disk_free_space("/") / 1024 / 1024 / 1024, 2) . ' GB',
            'total_disk_space' => round(disk_total_space("/") / 1024 / 1024 / 1024, 2) . ' GB',
            'log_file_size' => file_exists(storage_path('logs/laravel.log'))
                ? round(filesize(storage_path('logs/laravel.log')) / 1024, 2) . ' KB'
                : 'Log file not found',
        ];

        return view('super_admins.system_info.index', compact('system_info'));
    }



    public function update(UpdateRequest $request, User $user)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password);
            } else {
                unset($data['password']);
            }
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            if ($request->file('profile_image_path')) {
                $image = $request->file('profile_image_path');
                $name = strtotime(now()) . $image->getClientOriginalName();
                $image->move(public_path() . '/profile_images/', $name);
                $data['profile_image_path'] = '/profile_images/' . $name;
            }
            $super_admin = $user->update($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.profile.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        if ($request->filled('password')) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('super_admin.login')->with('message', 'Password Changed Successfully')->with('message_type', 'success');
        }
        return redirect()->route('super_admin.profile.index')->with('message', 'Profile Updated Successfully')->with('message_type', 'success');
    }
}
