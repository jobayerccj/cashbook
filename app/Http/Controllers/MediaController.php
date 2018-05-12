<?php

namespace App\Http\Controllers;

use App\MediaAlbum;
use App\Media;
use App\MediaLang;
use Illuminate\Http\Request;
use Image;
use Validator;
use Illuminate\Validation\Rule;
use App\Language;

class MediaController extends Controller
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
    public function index($id="")
    {
      $data['album_id'] = "";
      $data['media_list'] = array();
      if($id){
        $data['media_list'] = Media::getAllMediaByAlbum($id)->get();
        $data['album_id'] = $id;
      }

      $data['album_list'] = MediaAlbum::all();

      return view('media.media-list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function show(Media $media)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function edit(Media $media)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Media $media)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      $md = Media::find($request['id']);
      if($md->type == 1){
        unlink('uploads/media/'.$md->name);
        unlink('uploads/media/thumbs/'.$md->name);
      }
      $md->delete();
      echo 'success';
    }

    public function upload_image(Request $request){
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'album_id' => 'required'
        ]);

        if($validator->fails()){
            return json_encode(array("error"=>$validator->errors()->first('image')));
        }
      if ($request->hasFile('image')) {
        $album_id = $request->album_id;
        $category_data = MediaAlbum::findOrFail($album_id)->category_data;
        if($category_data){
          $extension = $request->file('image')->getClientOriginalExtension(); // getting image extension
          $fileName = $album_id.'-'.time(). '-' .uniqid() . '.' . $extension; // renameing image
          Image::make($request->file('image'))->resize($category_data->large_img_width, $category_data->large_img_height,function($constraint){
            $constraint->aspectRatio();
          })->save('uploads/media/'.$fileName);
          Image::make($request->file('image'))->fit($category_data->thumb_img_width, $category_data->thumb_img_height)->save('uploads/media/thumbs/'.$fileName);

          $md = new Media;
          $md->name = $fileName;
          $md->album_id = $album_id;
          $md->type = 1;
          $md->order = Media::where('album_id',$album_id)->count() + 1;
          $md->save();
          $id = $md->id;

          echo json_encode(array('image'=>$fileName,'id'=>$id));
        }else{
          return json_encode(array("error"=>"Something went wrong!"));
        }

        //$img = Image::make('storage/app/public/media/0RSzBM81b0a149ts6IRRWRSI22QEFPFMRWLqvzrB.jpeg');
        //Image::make($path_thumb)->resize(200, 200)->save();
        //echo $path;
      }
    }

    public function sort_media(Request $request){
      $ids = $request->id;

      foreach($ids as $order => $id){
        $md = Media::findOrFail($id);
        $md->order = $order;
        $md->save();
      }
    }

    public function additional_data($id){
      $data = array();
      $lang_list = Language::all();
      foreach($lang_list as $key => $lang){
        $data['additional_data'][$lang['code']] = MediaLang::where('media_id',$id)
                                                           ->where('lang_code',$lang['code'])
                                                           ->first();
      }
      $data['lang_list'] = $lang_list;
      $data['media_id'] = $id;
      return view('media.media-data', $data);
    }

    public function additional_data_save(Request $request){
        $validator = Validator::make($request->all(),
            [
                'media_id' => 'required'
            ]
        );

        if($validator->fails()){
            return "error";
        }

        $lang_list = Language::all();
        $media_id = $request['media_id'];

        foreach ($lang_list as $key => $lang) {
          echo $lang['code'];
/*/*
          $media_lang = MediaLang::updateOrCreate(
                        ['media_id' => $media_id, 'lang_code' => $lang['code']],
                        [
                          'media_id' => $media_id,
                          'lang_code' => $lang['code'],
                          'title' => $request['title'][$lang['code']],
                          'description' => $request['description'][$lang['code']]
                        ]
                    );
*/

            /*$media_lang = new MediaLang;
            $media_lang::updateOrCreate(['id' => $media_id, 'lang_code' => $lang['code']],array("title" => $request['title'][$lang['code']], 'description' => $request['description'][$lang['code']]));*/

            //$media_lang = MediaLang::firstOrNew(['id' => $media_id, 'lang_code' => $lang['code']],array("title" => $request['title'][$lang['code']], 'description' => $request['description'][$lang['code']]));
          /*  $media_lang = MediaLang::where('id',$media_id)->where('lang_code',$lang['code'])->first();
            $media_lang->title = $request['title'][$lang['code']];
            $media_lang->description = $request['description'][$lang['code']];
            $media_lang->save();
            */

            $media_lang = MediaLang::updateOrCreate(
              ['media_id' => $request['media_id'], 'lang_code' => $lang['code']],
              [ 
                'media_id' => $request['media_id'],
                'lang_code' => $lang['code'],
                'title' => $request['title'][$lang['code']],
                'description' => $request['description'][$lang['code']]
              ]

            );
        }

        return json_encode($request['title']['en']);
    }
}
