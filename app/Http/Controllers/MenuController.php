<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Menu;
use App\PagesInMenu;
use Illuminate\Validation\Rule;
use App\Language;
use App\PagesInMenuDetail;

class MenuController extends Controller
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
        $data['menu_list'] = Menu::all();
        return view('menu.menu-list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        return view('menu.menu-add');
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
            'name' => 'required|unique:menus'
            ]);

        if($validator->fails()){
            return redirect('menus/create')
                            ->withErrors($validator)
                            ->withInput();
        }
        
        $menu = new Menu;
        
        $menu->name = $request['name'];
        $menu->save();
        return redirect('menus')->with('success_message', 'menu successfully added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $data['menu_id'] = $id;
        $data['menu_items'] = PagesInMenu::where('menu_id', $id)
                                            ->get();
        return view('menu.menu-detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $data['menu_detail'] = Menu::findOrFail($id);
        return view('menu.menu-edit', $data);
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
        $validator = Validator::make($request->all(),[
            'name' => [
                'required',
                Rule::unique('menus')->ignore($request['name'], 'name')
            ]
        ]);

        if($validator->fails()){
            return redirect('menus/'.$id.'/edit')
                    ->withErrors($validator)
                    ->withInput();
        }

        $menu = Menu::findOrFail($id);
        $menu->name = $request['name'];
        $menu->save();

        return redirect('/menus')->with('success_message', 'Menu successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $menu = Menu::where("id", $request['id'])->delete();
        echo 'success';
    }

    public function addItem(Request $request){

        $validator = Validator::make($request->all(),[
            'name'=>'emptyArray',
            'link' => 'required'
        ]);

        if($validator->fails()){
            $result['success'] = 0;
            $result['message'] = $validator->errors();
        }
        else{
            $pageInMenu = new PagesInMenu;
            $pageInMenu['menu_id'] = $request['menu_id'];
            $pageInMenu['link'] = $request['link'];
            if($request['parent_id']){
                $pageInMenu['parent_id'] = $request['parent_id'];
            }
            else{
                $pageInMenu['parent_id'] = 0;
            }
            
            $pageInMenu->save();

            $lang_list = Language::all();

            foreach ($lang_list as $key => $lang) {
                $page_in_menu_detail = new PagesInMenuDetail;
                $page_in_menu_detail['page_id'] = $pageInMenu['id'];
                $page_in_menu_detail['lang'] = $lang['code'];
                $page_in_menu_detail['name'] = $request['name'][$lang['code']];

                $page_in_menu_detail->save();
            }

            $result['success'] = 1;
            $result['message'] = "Menu item successfully added";
        }

        echo json_encode($result);
        
    }

    public function getAddItemModal(Request $request){
        $data['lang_list'] = Language::all();
        $data['parent_menu_list'] = PagesInMenu::where('parent_id', 0)
                                    ->where('menu_id', $request['menu_id'])
                                    ->get();
        $data['menu_id'] = $request['menu_id'];
        
        echo view('menu.add-item-modal', $data)->render();
    }

    public function getEditItemModal(Request $request){
        $data['lang_list'] = Language::all();
        $data['parent_menu_list'] = PagesInMenu::where('parent_id', 0)
                                    ->where('menu_id', $request['menu_id'])
                                    ->get();
        $data['menu_id'] = $request['menu_id'];
        $data['menu_item_detail'] = PagesInMenu::where("id", $request['id'])->firstOrFail();
        //echo json_encode($parent_menu_list);
        echo view('menu.edit-item-modal', $data)->render();
    }

    public function editItem(Request $request){
        
        $validator = Validator::make($request->all(),[
            'name'=>'emptyArray',
            'link' => 'required'
        ]);

        if($validator->fails()){
            $result['success'] = 0;
            $result['message'] = $validator->errors();
            
        }
        else{

            $pageInMenu = PagesInMenu::where('id', $request['id'])->first();
            $pageInMenu->menu_id = $request['menu_id'];
            $pageInMenu->link = $request['link'];
            $pageInMenu->parent_id = $request['parent_id'];
            $pageInMenu->save();

            $lang_list = Language::all();

            foreach ($lang_list as $key => $lang) {
                $page_in_menu_detail = PagesInMenuDetail::where('page_id', $request['id'])
                                                        ->where('lang', $lang['code'])
                                                        ->first();
                
                $page_in_menu_detail['name'] = $request['name'][$lang['code']];
                $page_in_menu_detail->save();
            }

            $result['success'] = 1;
            $result['message'] = "Menu item successfully updated";
        }

        echo json_encode($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroyMenuItem(Request $request)
    {   
        PagesInMenuDetail::where('page_id', $request['id'])->delete();
        PagesInMenu::where("id", $request['id'])->delete();
        echo 'success';
    }


}
