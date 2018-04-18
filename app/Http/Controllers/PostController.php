<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Auth;
use DB;
use Carbon\Carbon;

class PostController extends Controller
{   
    public function __construct(){
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function index(){
        $posts = Post::latest();

        if($month = request('month')){
            $posts->whereMonth('created_at', Carbon::parse($month)->month);
        }

        if(request('year')){
            $posts->whereYear('created_at', request('year'));
        }

        $posts = $posts->get();

        //$archives = POST::archives();

    	return view('posts.index', compact('posts'));
    }

    public function show(Post $post){

        //$archives = POST::archives();

    	return view('posts.detail', compact('post'));
    }

    public function create(){
    	return view('posts.create');
    }

    public function store(){
    	
        //print_r(auth()->user()->id);exit;
        $this->validate(request(), [
            'title' => 'required',
            'body' => 'required'
        ]);
        
        auth()->user()->publish(
            new Post(request(['title', 'body']))
        ); 

        /*Post::create([
            'title' => request('title'), 
            'body' => request('body'),
            'user_id' => auth()->user()->id
        ]);*/

    	return redirect('/');
    }
}
