<?php

namespace App\Http\Controllers;

use App\MediaAlbum;
use App\MediaCategory;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Validation\Rule;

class MediaAlbumController extends Controller
{

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
      $data['album_list'] = MediaAlbum::all();
      return view('media.album-list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['categories'] = MediaCategory::all();
        return view('media.album-add',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $validator = Validator::make($request->all(),[
          'name' => 'required',
          'alias' => 'required|unique:media_albums'
          ]);

      if($validator->fails()){
          return redirect('media_albums/create')
                          ->withErrors($validator)
                          ->withInput();
      }

      $ma = new MediaAlbum;
      $ma->name = $request['name'];
      $ma->alias = $request['alias'];
      $ma->cat_id = $request['cat_id'];
      $ma->cover_image = "";
      $ma->save();
      return redirect('media_albums')->with('success_message', 'Successfully added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MediaAlbum  $mediaAlbum
     * @return \Illuminate\Http\Response
     */
    public function show(MediaAlbum $mediaAlbum)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MediaAlbum  $mediaAlbum
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $data['categories'] = MediaCategory::all();
      $data['album'] = MediaAlbum::findOrFail($id);
      return view('media.album-edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MediaAlbum  $mediaAlbum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $validator = Validator::make($request->all(),[
          'name' => 'required',
          'alias' => [
              'required',
              Rule::unique('media_albums')->ignore($request['alias'], 'alias')
          ]
      ]);

      if($validator->fails()){
          return redirect('media_albums/'.$id.'/edit')
                  ->withErrors($validator)
                  ->withInput();
      }

      $ma = MediaAlbum::findOrFail($id);
      $ma->name = $request['name'];
      $ma->alias = $request['alias'];
      $ma->cat_id = $request['cat_id'];
      $ma->cover_image = "";
      $ma->save();
      return redirect('media_albums')->with('success_message', 'Successfully updated.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MediaAlbum  $mediaAlbum
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      MediaAlbum::where("id", $request['id'])->delete();
      echo 'success';
    }
}
