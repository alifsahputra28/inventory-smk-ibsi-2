<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:role-list', ['only' => ['index']]);
         $this->middleware('permission:role-create', ['only' => ['create','store']]);
         $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = Role::latest();
            return DataTables::of($data)
            ->addIndexColumn('DT_RowIndex')
            ->addColumn('action', function($data){
                $id             = $data->id;
                $url_edit       = route('roles.edit', $id);
                $url_show       = route('roles.show', $id);
                $url_delete     = route('roles.destroy', $id);

                $edit     = '<a href="'.$url_edit.'" class="dropdown-item" data-toggle="tooltip" title="Edit" data-bs-placement="top">Edit Data</a>';
                $show    = '<a href="'.$url_show.'" class="dropdown-item" data-toggle="tooltip" title="Show" data-bs-placement="top">Show Data</a>';
                $delete    = '<a href="javascript:void(0)" id="'.$id.'" data-id="'.$url_delete.'" class="dropdown-item btn-delete" data-toggle="tooltip" title="Delete" data-bs-placement="top">Delete Data</a>';
                $button    = '<div class="dropup-center dropstart">
                <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-three-dots-vertical"></i>
                </button>
                <ul class="dropdown-menu">
                  <li>'.$edit.'</li>
                  <li>'.$show.'</li>
                  <li>'.$delete.'</li>
                </ul>
              </div>';

                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('pages.roles.index');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $permission = Permission::get();
        $permissionDashboard = Permission::take(1)->get();
        $permissionRoles = Permission::skip(1)->take(4)->get();
        $permissionUsers = Permission::skip(5)->take(4)->get();
        $permissionLaboratoryRoom = Permission::skip(9)->take(4)->get();
        $permissionDataComputer = Permission::skip(13)->take(4)->get();
        $permissionDataSupportingDevice = Permission::skip(17)->take(4)->get();
        $permissionLaboratoryComputer = Permission::skip(21)->take(4)->get();
        $permissionLaboratorySupportingDevice = Permission::skip(25)->take(4)->get();
        $permissionOther = Permission::skip(29)->take(4)->get();
        $role = new Role();
        $rolePermissions = [];
        // dd($permissionRoles);
        $permission = Permission::get();
        return view('pages.roles.create',compact('permission','permissionDashboard','permissionRoles','permissionUsers', 'role', 'rolePermissions', 'permissionLaboratoryRoom', 'permissionDataComputer', 'permissionDataSupportingDevice', 'permissionLaboratoryComputer', 'permissionLaboratorySupportingDevice', 'permissionOther'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {

        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
    
        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));
    
        return redirect()->route('roles.index')
                        ->with('success','Role created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): View
    {
        $role = Role::find($id);
        $permissionDashboard = Permission::take(1)->get();
        $permissionRoles = Permission::skip(1)->take(4)->get();
        $permissionUsers = Permission::skip(5)->take(4)->get();
        $permissionLaboratoryRoom = Permission::skip(9)->take(4)->get();
        $permissionDataComputer = Permission::skip(13)->take(4)->get();
        $permissionDataSupportingDevice = Permission::skip(17)->take(4)->get();
        $permissionLaboratoryComputer = Permission::skip(21)->take(4)->get();
        $permissionLaboratorySupportingDevice = Permission::skip(25)->take(4)->get();
        $permissionOther = Permission::skip(29)->take(4)->get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
        ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
        ->all();

        return view('pages.roles.show',compact('role','rolePermissions', 'permissionDashboard', 'permissionRoles', 'permissionUsers', 'permissionLaboratoryRoom', 'permissionDataComputer', 'permissionDataSupportingDevice', 'permissionLaboratoryComputer', 'permissionLaboratorySupportingDevice', 'permissionOther'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): View
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $permissionDashboard = Permission::take(1)->get();
        $permissionRoles = Permission::skip(1)->take(4)->get();
        $permissionUsers = Permission::skip(5)->take(4)->get();
        $permissionLaboratoryRoom = Permission::skip(9)->take(4)->get();
        $permissionDataComputer = Permission::skip(13)->take(4)->get();
        $permissionDataSupportingDevice = Permission::skip(17)->take(4)->get();
        $permissionLaboratoryComputer = Permission::skip(21)->take(4)->get();
        $permissionLaboratorySupportingDevice = Permission::skip(25)->take(4)->get();
        $permissionOther = Permission::skip(29)->take(4)->get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
    
        return view('pages.roles.edit',compact('role','permission','rolePermissions', 'permissionDashboard', 'permissionRoles','permissionUsers', 'permissionLaboratoryRoom', 'permissionDataComputer', 'permissionDataSupportingDevice', 'permissionLaboratoryComputer', 'permissionLaboratorySupportingDevice', 'permissionOther'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);
    
        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();
    
        $role->syncPermissions($request->input('permission'));
    
        return redirect()->route('roles.index')
                        ->with('success','Role updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("roles")->where('id',$id)->delete();

        return response()->json([
            'success'   => true,
            'message'   => 'Data User Berhasi Di Hapus'
        ]);
    }
}
