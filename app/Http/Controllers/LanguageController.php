<?php

namespace App\Http\Controllers;

use App\Language;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Validation\Rule;
use Session;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
         $this->middleware('auth');
     }

    public function index()
    {
      $language_list = Language::all();
      return view('language.list', ['language_list' => $language_list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('language.create');
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
          'name' => 'required',
          'code' => 'required|unique:languages'
      ]);

      if ($validator->fails()) {
          return redirect('languages/create')
                      ->withErrors($validator)
                      ->withInput();
      }

      else{

          $language = new Language;
          $language->name = $request['name'];
          $language->code = $request['code'];
          $language->save();
          return redirect('/languages')->with('success_message', 'New Language Added.');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function show(Language $language)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $data['language'] = Language::where('id', $id)->firstOrFail();
      return view('language.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $validator = Validator::make($request->all(), [
          'name' => 'required',
          'code' => ['required',Rule::unique("languages")->ignore($request['code'], 'code')]
      ]);

      if ($validator->fails()) {
          return redirect('languages/'.$id.'/edit')
                      ->withErrors($validator)
                      ->withInput();
      }

      else{

          $language = Language::find($id);
          $language->name = $request['name'];
          $language->code = $request['code'];
          $language->save();
          return redirect('/languages')->with('success_message', 'Language Updated');
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      Language::where("id", $request['id'])->delete();
      echo 'success';
    }
}
