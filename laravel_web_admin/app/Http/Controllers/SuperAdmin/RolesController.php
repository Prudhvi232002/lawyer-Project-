<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\CreateRequest;
use App\Http\Requests\Role\UpdateRequest;
use App\Models\Role;
use App\Models\RolePermission;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    /********* Initialize Permission based Middlewares  ***********/
    public function __construct()
    {
        $this->middleware('permission:role.index');
        $this->middleware('permission:role.add', ['only' => ['store']]);
        $this->middleware('permission:role.edit', ['only' => ['update']]);
        $this->middleware('permission:role.delete', ['only' => ['destroy']]);
        $this->middleware('permission:role.export', ['only' => ['export']]);
        $this->middleware('permission:role.import', ['only' => ['import']]);
    }
    public function index()
    {
        $roles = Role::where('is_editable', 1)->get();
        return view('super_admins.roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = RolePermission::get()->groupBy('display_group');
        $tenants = [];
        $rolePermissions = array();


        return view('super_admins.roles.create', compact('permissions', 'rolePermissions'));
    }

    public function store(CreateRequest $request)
    {

        $data = $request->all();
        try {
            DB::beginTransaction();
            $role_code = strtolower(str_replace(' ', '_', trim($data['name'])));
            $check = Role::query()->where(['name' => $data['name'], 'role_code' => $role_code])->first();
            if ($check) {
                return redirect()->back()->with([
                    'message' => 'Role already exist',
                    'message_type' => 'error'
                ]);
            } else {
                $role = Role::create([
                    'name' => $data['name'],
                    'is_active' => 1,
                    'role_code' => $role_code,
                    'is_editable' => 1
                ]);

                if ($role && $request->permissions) {
                    $role->role_permissions()->attach($request->permissions);
                }
                DB::commit();
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.roles.index')->with([
                'message' => 'Something went wrong',
                'message_type' => 'error'
            ]);
        }
        return redirect()->route('super_admin.roles.index')->with([
            'message' => 'Role created successfully',
            'message_type' => 'success'
        ]);
    }

    public function edit(Role $role)
    {
        $rolePermissions = array();
        $permissions = RolePermission::get()->groupBy('display_group');
        $rolePermissions = $role->role_permissions->pluck('permission_code')->toArray();
        return view('super_admins.roles.edit', compact('permissions', 'role', 'rolePermissions'));
    }

    public function update(UpdateRequest $request, Role $role)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            $role_code = strtolower(str_replace(' ', '_', trim($data['name'])));

            $role->update([
                'name' => $data['name'],
                'role_code' => $role_code
            ]);
            if ($role) {
                $role->role_permissions()->sync($request->permissions);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.roles.index')->with([
                'message' => 'Something went wrong',
                'message_type' => 'error'
            ]);
        }
        return redirect()->route('super_admin.roles.index')->with([
            'message' => 'Role updated successfully',
            'message_type' => 'success'
        ]);
    }
    /*********Soft DELETE State ***********/
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->back()->with('message', 'Role Deleted Successfully')->with('message_type', 'success');
    }

    public function getPermissionsExceptRole(Request $request)
    {
        $permissions =  SuperAdminsGeneralController::getPermissionsExceptRole($request);
        $response = generateResponse($permissions, count($permissions) > 0 ? true : false, 'Permissions Fetched Successfully', null, 'collection');
        return response()->json($response, 200);
    }
}
