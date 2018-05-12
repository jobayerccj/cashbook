<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MediaCategory;
use Validator;
use Illuminate\Validation\Rule;
class MediaCategoryController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data['category_list'] = MediaCategory::all();
        return view('media.category-list', $data);
    }

    public function create()
    {
        return view('media.category-add');
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'alias' => 'required|unique:media_categories'
            ]);

        if($validator->fails()){
            return redirect('media_categories/create')
                            ->withErrors($validator)
                            ->withInput();
        }

        $mc = new MediaCategory;
        $mc->name = $request['name'];
        $mc->alias = $request['alias'];
        $mc->large_img_width = $request['large_img_width'];
        $mc->large_img_height = $request['large_img_height'];
        $mc->thumb_img_width = $request['thumb_img_width'];
        $mc->thumb_img_height = $request['thumb_img_height'];
        $mc->save();
        return redirect('media_categories')->with('success_message', 'Successfully added.');
    }

    public function destroy(Request $request)
    {
        MediaCategory::where("id", $request['id'])->delete();
        echo 'success';
    }

    public function edit($id)
    {
        $data['cat'] = MediaCategory::findOrFail($id);
        return view('media.category-edit', $data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'alias' => [
                'required',
                Rule::unique('media_categories')->ignore($request['alias'], 'alias')
            ]
        ]);

        if($validator->fails()){
            return redirect('media_categories/'.$id.'/edit')
                    ->withErrors($validator)
                    ->withInput();
        }

        $mc = MediaCategory::findOrFail($id);
        $mc->name = $request['name'];
        $mc->alias = $request['alias'];
        $mc->large_img_width = $request['large_img_width'];
        $mc->large_img_height = $request['large_img_height'];
        $mc->thumb_img_width = $request['thumb_img_width'];
        $mc->thumb_img_height = $request['thumb_img_height'];
        $mc->save();

        return redirect('/media_categories')->with('success_message', 'Successfully updated');
    }


}
