<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Category;
use Illuminate\Validation\Rule;
use Session;

class CategoryController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category_list = Category::all();
        return view('page.category-list', ['category_list' => $category_list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('page.category-add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'category_name' => 'required|unique:categories'
        ]);

        if ($validator->fails()) {
            return redirect('categories/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        else{

            $category = new Category;
            $category->category_name = $request['category_name'];
            $category->save();
            return redirect('/categories')->with('success_message', 'New Category Added.');
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
        //$data['category_id'] = $id;
        $data['category_detail'] = Category::where('id', $id)->firstOrFail();
        return view('page.category-edit', $data);

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
       $validator = Validator::make($request->all(), [
            'category_name' => [
                'required',
                Rule::unique("categories")->ignore($request['category_name'], 'category_name')
            ]

        ]);

        if ($validator->fails()) {
            return redirect('categories/'.$id.'/edit')
                        ->withErrors($validator)
                        ->withInput();
        }
        else{
            $category = Category::find($id);
            $category['category_name'] = $request['category_name'];
            $category->save();

            return redirect('/categories')->with('success_message', 'Category successfully updated.');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        $category = Category::where("id", $request['id'])->delete();
        echo 'success';
    }
}
