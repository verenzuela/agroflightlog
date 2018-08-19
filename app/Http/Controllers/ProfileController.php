<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use DB;
use Auth;
use Illuminate\Support\Facades\Hash;


class ProfileController extends Controller
{
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
     * Show the user profile.
     *
     * @return \Illuminate\Http\Response
     */
    public static function index()
    {
        try {

            if( Auth::user()->can('user-list') ){

                $user = User::find(Auth::user()->id);
                return view('commons.profile.index', [ 'user' => $user, 'layout' => ProfileController::layout() ] );

            }else{
                return response()->json( array( 'code' => 403, 'message' => "You don't have permission to execute this function" ), 403 );
            }

        } catch (Exception $e) {
            return response()->json( array( 'code' => 500, 'message' => $e ), 500 );
        }
        
    }

    public function edit($id="")
    {
        $user = User::find(Auth::user()->id);
        return view( 'commons.profile.edit', [ 'user' => $user, 'layout' => ProfileController::layout() ] );
    }


    public function update(Request $request, $id)
    {
        try {

            if( Auth::user()->can('user-edit') ){

                $this->validate($request, [
                    'firstname' => 'required',
                    'email' => 'required',
                ]);

                $user = User::find($id);
                $user->firstname = $request->input('firstname');
                $user->lastname = $request->input('lastname');
                $user->email = $request->input('email');
                $user->save();

                return redirect()->route('profile.view')
                                ->with('success','Profile updated successfully');

            }else{
                return response()->json( array( 'code' => 403, 'message' => "You don't have permission to execute this function" ), 403 );
            }

        } catch (Exception $e) {
            return response()->json( array( 'code' => 500, 'message' => $e ), 500 );
        }
        
    }


    private static function layout(){
        $layout = "layouts.app.base";
        if( Auth::user()->username == 'admin' ){
            $layout = "layouts.admin.base";
        };

        return $layout;
    }


    public function change_password(Request $request, $id="")
    {
        try {

            if( Auth::user()->can('user-edit') ){

                $user = User::findOrFail($id);

                $this->validate($request, [
                    'password' => 'min:6',
                    'new_password' => 'min:6',
                ]);

                if (Hash::check($request->password, $user->password)) { 

                    $user->fill( ['password' => Hash::make($request->new_password)] )->save();
                    return redirect()->route('profile.view')
                                ->with('success','Password updated successfully');

                } else {
                    return redirect()->route('profile.view')->with('errors', 'Current password does not match');
                }



            }else{
                return response()->json( array( 'code' => 403, 'message' => "You don't have permission to execute this function" ), 403 );
            }

        } catch (Exception $e) {
            return response()->json( array( 'code' => 500, 'message' => $e ), 500 );
        }
        
    }

}
