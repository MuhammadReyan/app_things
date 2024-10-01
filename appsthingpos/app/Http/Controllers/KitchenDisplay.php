<?php

namespace App\Http\Controllers;

use App\Models\MasterStatus;
use Illuminate\Http\Request;

use App\Models\KitchenDisplay as KitchenDisplayModel;
use App\Models\Category;

use App\Http\Resources\KitchenDisplayResource;

class KitchenDisplay extends Controller
{
    //This is the function that loads the listing page
    public function index(Request $request){
        //check access
        $data['menu_key'] = 'MM_SETTINGS';
        $data['sub_menu_key'] = 'SM_KITCHEN_DISPLAY';
        check_access(array($data['menu_key'],$data['sub_menu_key']));
        
        return view('kitchen_display.kitchen_displays', $data);
    }

    //This is the function that loads the add/edit page
    public function add_kitchen_display($slack = null){
        //check access
        $data['menu_key'] = 'MM_SETTINGS';
        $data['sub_menu_key'] = 'SM_KITCHEN_DISPLAY';
        $data['action_key'] = ($slack == null)?'A_ADD_KITCHEN_DISPLAY':'A_EDIT_KITCHEN_DISPLAY';
        check_access(array($data['action_key']));

        $data['statuses'] = MasterStatus::select('value', 'label')->filterByKey('KITCHEN_DISPLAY_STATUS')->active()->sortValueAsc()->get();

        $data['categories'] = Category::select('slack', 'category_code', 'label')->active()->sortLabelAsc()->showPosScreen()->get();

        $data['kitchen_display_data'] = null;
        if(isset($slack)){
            
            $kitchen_display = KitchenDisplayModel::where('slack', '=', $slack)->first();
            if (empty($kitchen_display)) {
                abort(404);
            }

            $kitchen_display_data = new KitchenDisplayResource($kitchen_display);
            $data['kitchen_display_data'] = $kitchen_display_data;
        }

        return view('kitchen_display.add_kitchen_display', $data);
    }

    //This is the function that loads the detail page
    public function detail($slack){
        $data['menu_key'] = 'MM_SETTINGS';
        $data['sub_menu_key'] = 'SM_KITCHEN_DISPLAY';
        $data['action_key'] = 'A_DETAIL_KITCHEN_DISPLAY';
        check_access([$data['action_key']]);

        $kitchen_display = KitchenDisplayModel::where('slack', '=', $slack)->first();
        
        if (empty($kitchen_display)) {
            abort(404);
        }

        $kitchen_display_data = new KitchenDisplayResource($kitchen_display);
        
        $data['kitchen_display_data'] = $kitchen_display_data;
        
        $data['categories'] = Category::select('slack', 'category_code', 'label')->active()->sortLabelAsc()->showPosScreen()->get();

        $data['delete_access'] = check_access(['A_DELETE_KITCHEN_DISPLAY'], true);

        return view('kitchen_display.kitchen_display_detail', $data);
    }
}
