<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Pages;
use Validator;
use App\Language;
use App\PageDetail;
use File;

class PagesController extends Controller
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
        $data['page_list'] = Pages::all();
        return view('page.page-list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['category_list'] = Category::all();
        $data['lang_list'] = Language::all();
        return view('page.page-add', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //echo '<pre>'; print_r($request['title']); echo '</pre>';


        $validator = Validator::make($request->all(),
            [
                'category' => 'required',
                'title' => 'emptyArray',
                'alias' => 'emptyArray',
                'description' => 'emptyArray'
            ]
        );

        if($validator->fails()){
            return redirect('pages/create')
                    ->withErrors($validator)
                    ->withInput();
        }

        else{

            $page = new Pages;
            $page->category = $request['category'];

             if($request['featured_image']){
                File::move('uploads/_temp/'.$request['featured_image'],'uploads/pages/'.$request['featured_image']);
                $page->featured_image = $request['featured_image'];
             }

            $page->save();

            $lang_list = Language::all();

            foreach ($lang_list as $key => $lang) {
                $page_detail = new PageDetail;
                $page_detail['page_id'] = $page['id'];
                $page_detail['title'] = $request['title'][$lang['code']];
                $page_detail['alias'] = $request['alias'][$lang['code']];
                $page_detail['lang'] = $lang['code'];
                $page_detail['description'] = $request['description'][$lang['code']];

                $page_detail->save();
            }

            return redirect('/pages')->with('success_message', 'New page successfully added');
        }
    }

    function count_value($item, $key){
        if(count($item)){
            $total_title++;
            return $total_title;
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
        $data['category_list'] = Category::all();
        $data['page_detail'] = Pages::where('id', $id)->firstOrFail();
        $data['lang_list'] = Language::all();
        return view('page.page-edit', $data);
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
        $validator = Validator::make($request->all(),
            [
                'category' => 'required',
                'title' => 'emptyArray',
                'alias' => 'emptyArray',
                'description' => 'emptyArray'
            ]
        );

        if($validator->fails()){
            $data['category_list'] = Category::all();
            $data['page_detail'] = Pages::where('id', $id)->firstOrFail();
            $data['lang_list'] = Language::all();

            return redirect('pages/'.$id.'/edit')
                    ->withErrors($validator)
                    ->withInput();
        }

        else{
            $page = Pages::findOrFail($id);

            $page->category = $request['category'];

            if($request['featured_image']){
                File::move('uploads/_temp/'.$request['featured_image'],'uploads/pages/'.$request['featured_image']);
                $page->featured_image = $request['featured_image'];
            }

            $page->save();

            $lang_list = Language::all();

            foreach ($lang_list as $key => $lang) {
                $page_detail = PageDetail::where('page_id', $id)
                                            ->where('lang', $lang['code'])
                                            ->first();

                $page_detail->title = $request['title'][$lang['code']];
                $page_detail->alias = $request['alias'][$lang['code']];
                $page_detail->description = $request['description'][$lang['code']];
                $page_detail->save();
            }

            return redirect('/pages')->with('success_message', 'page successfully updated');
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
        PageDetail::where("page_id", $request['id'])->delete();
        Pages::where("id", $request['id'])->delete();
        echo 'success';
    }

    public function upload_featured_img(Request $request){
        upload($request->all(),'myfile');

    }
}
