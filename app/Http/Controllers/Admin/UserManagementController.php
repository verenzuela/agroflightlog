<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use DB;
use Hash;
use Auth;

class UserManagementController extends Controller
{
       /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/user-management';

         /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            if( Auth::user()->can('user-list') ){

                $users = User::paginate(5);

                return view('admin/users-mgmt/index', ['users' => $users]);

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
        $roles = Role::pluck('display_name','id')->all();
        return view('admin/users-mgmt/create',compact('roles'));
        
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

            if( Auth::user()->can('user-create') ){

                $this->validate($request, [
                    'username' => 'required',
                    'email' => 'required|email|unique:users,email',
                    'password' => 'required|same:password-confirm',
                    'firstname' => 'required',
                    'lastname' => 'required'
                ]);

                $input = $request->all();
                $input['password'] = Hash::make($input['password']);
                
                $user = User::create($input);

                if($request->input('roles') != null ){
                    foreach ($request->input('roles') as $key => $value) {
                        $user->attachRole($value);
                    } 
                }
                
                return redirect()->route('user-management.index')
                                ->with('success','User created successfully');

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
        $user = User::find($id);

        if ($user == null || count($user) == 0) {
            return redirect()->intended('/user-management');
        }

        $roles = Role::pluck('display_name','id')->all();
        $userRole = $user->roles->pluck('id','id')->toArray();

        return view('admin/users-mgmt/edit',compact('user','roles','userRole'));
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

            if( Auth::user()->can('user-edit') ){

                $this->validate($request, [
                    'username' => 'required',
                    'email' => 'required|email|unique:users,email,'.$id,
                    'password' => 'same:password-confirm',
                    'firstname' => 'required',
                    'lastname' => 'required'
                ]);

                $input = $request->all();
                if(!empty($input['password'])){ 
                    $input['password'] = Hash::make($input['password']);
                }else{
                    $input = array_except($input,array('password'));    
                }

                $user = User::find($id);
                $user->update($input);
                DB::table('role_user')->where('user_id',$id)->delete();

                if($request->input('roles') != null ){
                    foreach ($request->input('roles') as $key => $value) {
                        $user->attachRole($value);
                    } 
                }

                return redirect()->route('user-management.index')
                                ->with('success','User updated successfully');

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

            if( Auth::user()->can('user-delete') ){

                User::where('id', $id)->delete();
                return redirect()->intended('/user-management');

            }else{
                return response()->json( array( 'code' => 403, 'message' => "You don't have permission to execute this function" ), 403 );
            }

        } catch (Exception $e) {
            return response()->json( array( 'code' => 500, 'message' => $e ), 500 );
        }

    }

    /**
     * Search user from database base on some specific constraints
     *
     * @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\Response
     */
    public function search(Request $request) {
        $constraints = [
            'username' => $request['username'],
            'firstname' => $request['firstname'],
            'lastname' => $request['lastname'],
            'department' => $request['department']
            ];

       $users = $this->doSearchingQuery($constraints);
       return view('admin/users-mgmt/index', ['users' => $users, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = User::query();
        $fields = array_keys($constraints);
        $index = 0;
        foreach ($constraints as $constraint) {
            if ($constraint != null) {
                $query = $query->where( $fields[$index], 'like', '%'.$constraint.'%');
            }

            $index++;
        }
        return $query->paginate(5);
    }
    private function validateInput($request) {
        $this->validate($request, [
        'username' => 'required|max:20',
        'email' => 'required|email|max:255|unique:users',
        'password' => 'required|min:6|confirmed',
        'firstname' => 'required|max:60',
        'lastname' => 'required|max:60'
    ]);
    }
}
