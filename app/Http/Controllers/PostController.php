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

        $archives = POST::selectRaw('year(created_at) year, monthName(created_at) month, count(*) published')
                        ->groupBy('year', 'month')
                        ->orderByRaw('min(created_at) desc')
                        ->get()
                        ->toArray();

    	return view('posts.index', compact('posts', 'archives'));
    }

    public function show(Post $post){

        $archives = POST::selectRaw('year(created_at) year, monthName(created_at) month, count(*) published')
                        ->groupBy('year', 'month')
                        ->orderByRaw('min(created_at) desc')
                        ->get()
                        ->toArray();

    	return view('posts.detail', compact('post', 'archives'));
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
