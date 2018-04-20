<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\Welcome;

class RegistrationController extends Controller
{   
    public function __construct(){
        $this->middleware('guest');
    }

    public function create(){
    	return view('auth/register');
    }

    public function store(){
    	//validation

    	$this->validate(request(), [
    		'email' => 'required|email',
    		'password' => 'required|confirmed'
    	]);

    	//save user to db
    	$user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password'))
            ]);
    
        //send welcome email
        //create views, controller, chnage settings
        Mail::to(request('email'))->send(new Welcome($user));

    	//sign in
    	auth()->login($user);

    	//redirect to home page
    	return redirect('/');
    }
}
