<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\CreateRequest;
use App\Http\Requests\Users\UpdateRequest;
use App\Models\Tenant;
use App\Models\User;
use App\Models\Role;
use App\Models\UserRole;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    /********* Initialize Permission based Middlewares  ***********/
    public function __construct()
    {
        $this->middleware('permission:users.add_podcast');
        $this->middleware('permission:users.add_podcast', ['only' => ['store']]);
        $this->middleware('permission:users.add_podcast', ['only' => ['update']]);
        $this->middleware('permission:users.add_podcast', ['only' => ['destroy']]);
        $this->middleware('permission:users.add_podcast', ['only' => ['export']]);
        $this->middleware('permission:users.add_podcast', ['only' => ['import']]);
    }
    public function index()
    {
        $users = User::query()->withAll()->whereNotNull('role_id')->get();
        return view('super_admins.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::active()->where('is_editable', 1)->get();

        return view('super_admins.users.create', compact('roles'));
    }

    public function show(User $user)
    {

        $currentRole = $user->user_roles()->first();
        $currentRole = $currentRole ? $currentRole->name : "";

        return view('super_admins.users.show', compact('user',  'currentRole'));
    }

    public function store(CreateRequest $request)
    {
        $role = Role::where('role_code', $request->role_code)->first();

        $data = $request->all();
        try {
            DB::beginTransaction();
            $data['password'] = Hash::make($request->password);
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            if ($request->file('profile_image_path')) {
                $image = $request->file('profile_image_path');
                $name = strtotime(now()) . $image->getClientOriginalName();
                $image->move(public_path() . '/profile_images/', $name);
                $data['profile_image_path'] = '/profile_images/' . $name;
            }
            $data['role_id'] = $role ? $role->id : null;
            $user = User::create($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.users.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.users.index')->with('message', 'User Created Successfully')->with('message_type', 'success');
    }

    public function edit(User $user)
    {
        $roles = Role::active()->where('is_editable', 1)->get();
        $currentRole = $user->role;
        $currentRole = $currentRole ? $currentRole->role_code : "";

        return view('super_admins.users.edit', compact('user', 'roles', 'currentRole'));
    }

    public function update(UpdateRequest $request, User $user)
    {
        $role = Role::where('role_code', $request->role_code)->first();

        $data = $request->all();
        // try {
        //     DB::beginTransaction();
        if ($request->file('profile_image_path')) {
            $image = $request->file('profile_image_path');
            $name = strtotime(now()) . $image->getClientOriginalName();
            $image->move(public_path() . '/profile_images/', $name);
            $data['profile_image_path'] = '/profile_images/' . $name;
        }
        if (!$request->is_active) {
            $data['is_active'] = 0;
        }
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }
        $data['role_id'] = $role ? $role->id : null;

        $user->update($data);
        // } catch (\Exception $e) {
        //     dd($e->getMessage());
        //     DB::rollback();
        //     return redirect()->route('super_admin.users.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        // }
        return redirect()->route('super_admin.users.index')->with('message', 'User Updated Successfully')->with('message_type', 'success');
    }

    public function destroy(User $user)
    {
        if (isset($user->profile_image_path)) {
            Storage::delete($user->profile_image_path);
        }
        $user->delete();
        return redirect()->back()->with('message', 'User Deleted Successfully')->with('message_type', 'success');
    }
}
