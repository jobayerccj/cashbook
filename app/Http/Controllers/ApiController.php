<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use App\PagesInMenu;
use App\PagesInMenuDetail;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserContact;

class ApiController extends Controller
{
    public function getMenuByName(Request $request){
    	//get id using name
    	$menu_id = Menu::where('name', $request['name'])
    					->value('id');

    	//get menu item from that id for specific lang
    	$menu_list = PagesInMenu::where('menu_id', $menu_id)
                                            ->get();
        foreach ($menu_list as $key => $menu) {
        	$menu_list[$key]['menu_lang'] = PagesInMenuDetail::where('page_id', $menu['id'])
    														 ->where('lang', $request['language'])
    														 ->first();
        }

    	echo json_encode($menu_list);
    }

    public function getSliderByName(Request $request){
    	$home_slider1 = DB::table('media_albums')
    						->join('media', 'media_albums.id', '=', 'media.album_id')
    						->where('media_albums.name', $request['name'])
    						->select('media.*')
    						->get();
    						
    	echo json_encode($home_slider1);
    }

    public function sendEmail(Request $request){

        $receiver = DB::table('settings')
                        ->where('set_name', 'email_noti')
                        //->select('set_value')
                        ->value('set_value');

        $result['detail'] = $request['email_detail'];

        if($receiver){
            Mail::to($receiver)->send(new UserContact($request));
            $result['status'] = 'success'; 
        }
        else{
            $result['status'] = 'failed';
        }


    	
    	echo json_encode($result);
    }
}
