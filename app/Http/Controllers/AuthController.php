<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;
use Auth;
use Session;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{   

    public function __construct()
    {   
        $rule = '1';

        //$this->middleware("userRole:$rule", ['except' => ['user_list']],'auth');
    }

    /**
     * Show user list.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function user_list()
    {
        
        $users = User::orderBy('id','ASC')->get();

		return view('auth.user-list', ['user_list' => $users]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function userEdit($id)
    {
        //
        $data['user_detail'] = User::where('id',$id)->firstOrFail();
        return view('auth.user-edit', $data);
    }

    /**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $req)
	{
		$v = Validator::make($req->all(), [
	        'name' => 'required',
	        'email' => 'required',
	        'password'=>'required_with:password_confirmation|same:password_confirmation|nullable|min:6',
            'password_confirmation'=>'sometimes|required_with:password|nullable|min:6',
    	]);


    	if ($v->fails())
	    {
	        return redirect()->back()->withErrors($v->errors());
	    }
	    else{
	    	$user = User::find ( $req->id );
	        $user->name = $req->name;
	        $user->email = $req->email;
			
	        if($req->password){
	        	$user->password = bcrypt($req->password);
	        }

	        $user->save ();

            Session::flash('success_message', 'User information successfully updated.'); 
	        return redirect('/user-list');
	    }
		
	}

    protected function destroy($id){
        //echo $id;exit;
    	if(Auth::user()->id == $id){
    		Session::flash('error_message', 'You can\'t delete your account, contact with another admin!'); 
    		return redirect('/user-list');
    	}
    	else{
    		$user = User::where("id", $id)->delete();
			//$user->where("id", $id)->delete();

			return redirect('/user-list');
    	}
		
	}
}
