<?php
namespace App\Http\Controllers\Admin;;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;
use App\Permission;
use DB;
use Auth;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {

            if( Auth::user()->can('role-list') ){

                $roles = Role::orderBy('id','DESC')->paginate(5);
                return view('admin.roles.index',compact('roles'))
                    ->with('i', ($request->input('page', 1) - 1) * 5);

            }else{
                return response()->json( array( 'code' => 403, 'message' => "You don't have permission to execute this function" ), 403 );
            }

        } catch (Exception $e) {
            return response()->json( array( 'code' => 500, 'message' => $e ), 500 );
        }
        
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = Permission::get();
        return view('admin.roles.create',compact('permission'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            if( Auth::user()->can('role-create') ){

                $this->validate($request, [
                    'name' => 'required|unique:roles,name',
                    'display_name' => 'required',
                    'description' => 'required',
                    'permission' => 'required',
                ]);


                $role = new Role();
                $role->name = $request->input('name');
                $role->display_name = $request->input('display_name');
                $role->description = $request->input('description');
                $role->save();


                foreach ($request->input('permission') as $key => $value) {
                    $role->attachPermission($value);
                }


                return redirect()->route('roles.index')
                                ->with('success','Role created successfully');

            }else{
                return response()->json( array( 'code' => 403, 'message' => "You don't have permission to execute this function" ), 403 );
            }

        } catch (Exception $e) {
            return response()->json( array( 'code' => 500, 'message' => $e ), 500 );
        }
        
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
        $rolePermissions = Permission::join("permission_role","permission_role.permission_id","=","permissions.id")
            ->where("permission_role.role_id",$id)
            ->get();


        return view('admin.roles.show',compact('role','rolePermissions'));
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
        $rolePermissions = DB::table("permission_role")->where("permission_role.role_id",$id)
            ->pluck('permission_role.permission_id','permission_role.permission_id')->all();

        return view('admin.roles.edit',compact('role','permission','rolePermissions'));
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
        try {

            if( Auth::user()->can('role-edit') ){

                $this->validate($request, [
                    'display_name' => 'required',
                    'description' => 'required',
                    'permission' => 'required',
                ]);


                $role = Role::find($id);
                $role->display_name = $request->input('display_name');
                $role->description = $request->input('description');
                $role->save();


                DB::table("permission_role")->where("permission_role.role_id",$id)
                    ->delete();


                foreach ($request->input('permission') as $key => $value) {
                    $role->attachPermission($value);
                }


                return redirect()->route('roles.index')
                                ->with('success','Role updated successfully');

            }else{
                return response()->json( array( 'code' => 403, 'message' => "You don't have permission to execute this function" ), 403 );
            }

        } catch (Exception $e) {
            return response()->json( array( 'code' => 500, 'message' => $e ), 500 );
        }
        
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            if( Auth::user()->can('role-delete') ){

                DB::table("roles")->where('id',$id)->delete();
                return redirect()->route('roles.index')
                                ->with('success','Role deleted successfully');

            }else{
                return response()->json( array( 'code' => 403, 'message' => "You don't have permission to execute this function" ), 403 );
            }

        } catch (Exception $e) {
            return response()->json( array( 'code' => 500, 'message' => $e ), 500 );
        }
        
    }
}