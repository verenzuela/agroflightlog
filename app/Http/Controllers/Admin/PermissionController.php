<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;
use App\Permission;
use DB;
use Auth;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {

            if( Auth::user()->can('permission-list') ){

                $permissions = Permission::orderBy('id','DESC')->paginate(8);
                return view('admin.permission.index',compact('permissions'))
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
        return view('admin.permission.create');
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

            if( Auth::user()->can('permission-create') ){

                $this->validate($request, [
                    'name' => 'required',
                    'display_name' => 'required',
                    'description' => 'required',
                ]);

                $permission = new Permission();
                $permission->name = $request->input('name');
                $permission->display_name = $request->input('display_name');
                $permission->description = $request->input('description');
                $permission->save();

                return redirect()->route('permission.index')
                                ->with('success','Permission created successfully');

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = Permission::find($id);
        if ($permission == null || count($permission) == 0) {
            return redirect()->intended('/dashboard');
        }

        return view('admin.permission.edit',compact('permission'));
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

            if( Auth::user()->can('permission-edit') ){

                $this->validate($request, [
                    'name' => 'required',
                    'display_name' => 'required',
                    'description' => 'required',
                ]);

                $permission = Permission::find($id);
                $permission->name = $request->input('name');
                $permission->display_name = $request->input('display_name');
                $permission->description = $request->input('description');
                $permission->save();

                return redirect()->route('permission.index')
                                ->with('success','Permission updated successfully');

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

            if( Auth::user()->can('permission-delete') ){

                DB::table("permissions")->where('id',$id)->delete();
                return redirect()->route('permission.index')
                                ->with('success','Permission deleted successfully');

            }else{
                return response()->json( array( 'code' => 403, 'message' => "You don't have permission to execute this function" ), 403 );
            }

        } catch (Exception $e) {
            return response()->json( array( 'code' => 500, 'message' => $e ), 500 );
        }
        
    }
}
