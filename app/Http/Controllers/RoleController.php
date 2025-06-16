<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roles = Role::orderBy('id', 'DESC')->get();
        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = Permission::get();
        return view('roles.create', compact('permission'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name|max:100',
            // 'permission' => 'required',
        ]);

        $role = Role::create([
            'name' => $request->input('name'),
            'is_require_notification' => $request->input('is_require_notification'),
            'is_require_invite_user' => $request->input('is_require_invite_user')
        ]);
        $role->syncPermissions($request->input('permission'));

        return redirect()->route('roles.index')
                        ->with('success', 'Role created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
            ->where("role_has_permissions.role_id", $id)
            ->get();

        return view('roles.show', compact('role', 'rolePermissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        return view('roles.edit', compact('role', 'permission', 'rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:100',
            'permission' => 'required',
        ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->is_require_notification = $request->input('is_require_notification');
        $role->is_require_invite_user = $request->input('is_require_invite_user');
        $role->save();

        $role->syncPermissions($request->input('permission'));

        return redirect()->route('roles.index')
                        ->with('success', 'Role updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("roles")->where('id', $id)->delete();
        return redirect()->route('roles.index')
                        ->with('success', 'Role deleted successfully');
    }

    public function allroles(Request $request)
    {
        $columns = array(
            0 => 'ID',
            1 => 'Name',
            2 => 'Status',
        );
        $totalData = Role::count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $roles = Role::offset($start)
                        ->limit($limit)
                        ->orderBy($order, $dir)
                        ->get();
        } else {
            $search = $request->input('search.value');

            $roles =  Role::where('id', 'LIKE', "%{$search}%")
                        ->orWhere('name', 'LIKE', "%{$search}%")
                        ->orWhere('status', 'LIKE', "%{$search}%")
                        ->offset($start)
                        ->limit($limit)
                        ->orderBy($order, $dir)
                        ->get();

            $totalFiltered = Role::where('id', 'LIKE', "%{$search}%")
                             ->orWhere('name', 'LIKE', "%{$search}%")
                             ->orWhere('status', 'LIKE', "%{$search}%")
                             ->count();
        }

        $data = array();
        if (!empty($roles)) {
            foreach ($roles as $role) {
                $show =  route('roles.show', $role->id);
                $edit =  route('roles.edit', $role->id);
                $delete =  route('roles.destroy', $role->id);

                $nestedData['id'] = $role->id;
                $nestedData['name'] = '<span style="padding:3px 19px 3px 18px;background-color:#' . $role->color_code . ';color:white;">' . $role->name . '</span>';
                $nestedData['status'] = $role->status == 0 ? '<span class="btn btn-danger btn-sm">InActive</span>' : '<span class="btn btn-primary btn-sm">Active</span>';

                $nestedData['options'] = '';
                if (auth()->user()->can('role-list')) {
                    $nestedData['options'] .= "&nbsp;<a href='{$show}' title='SHOW' class='btn btn-info btn-sm'><span class='fa fa-eye'></span></a>";
                }
                if (auth()->user()->can('role-edit')) {
                    $nestedData['options'] .= "&nbsp;<a href='{$edit}' title='EDIT' class='btn btn-primary btn-sm'><span class='fa fa-edit'></span></a>";
                }
                if (auth()->user()->can('role-delete')) {
                    $nestedData['options'] .= "&nbsp;<a href='{$delete}' title='DELETE' class='btn btn-danger btn-sm'><span class='fa fa-trash'></span></a>";
                }

                $data[] = $nestedData;
            }
        }

        $json_data = array(
                    "draw"            => intval($request->input('draw')),
                    "recordsTotal"    => intval($totalData),
                    "recordsFiltered" => intval($totalFiltered),
                    "data"            => $data
                    );

        echo json_encode($json_data);
    }
}
