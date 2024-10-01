<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\MasterStatus;
use App\Models\Store as StoreModel;
use App\Models\Role as RoleModel;
use App\Models\User as UserModel;
use App\Models\KitchenDisplay as KitchenDisplayModel;

use App\Http\Resources\KitchenDisplayResource;
use App\Http\Resources\UserResource;

class Kitchen extends Controller
{
    public function index(Request $request, $slack){
        
        //check access
        $data['menu_key'] = 'MM_RESTAURANT';
        $data['sub_menu_key'] = 'SM_RESTAURANT_KITCHEN';
        check_access(array($data['menu_key'],$data['sub_menu_key']));

        $data['order_link'] = route('order', ['slack' => '']);

        $data['store_slack'] = $request->logged_user_store_slack;

        $data['kitchen_display_slack'] = $slack;

        $kitchen_display = KitchenDisplayModel::select('*')->active()->where('slack', '=', $slack)->first();
        $kitchen_display_data = new KitchenDisplayResource($kitchen_display); 
        $data['kitchen_display_data'] = $kitchen_display_data;
        
        return view('kitchen.kitchen', $data);
    }

    public function waiter(Request $request){
        //check access
        $data['menu_key'] = 'MM_RESTAURANT';
        $data['sub_menu_key'] = 'SM_RESTAURANT_WAITER';
        check_access(array($data['menu_key'],$data['sub_menu_key']));

        $is_waiter = false;

        $store_data = StoreModel::select('id', 'restaurant_waiter_role_id')
        ->where([
            ['id', '=', $request->logged_user_store_id],
            ['status', '=', 1]
        ])
        ->first();

        $data['users'] = [];
        if (!empty($store_data)) {
            if($request->logged_user_role_id != $store_data->restaurant_waiter_role_id && $store_data->restaurant_waiter_role_id != null){
                
                $is_waiter = false;

                if ($store_data->restaurant_waiter_role_id != ''){
                    $waiter_role_id = RoleModel::select('id')
                    ->where('id', '=', $store_data->restaurant_waiter_role_id)
                    ->active()
                    ->first();
                    
                    $user_list = UserModel::select('*', 'user_stores.id as user_store_access')
                    ->hideSuperAdminRole()
                    ->userStoreAccessData()
                    ->active()
                    ->where('role_id', '=', $waiter_role_id->id)
                    ->where('user_stores.store_id', $store_data->id)
                    ->whereNotNull('user_stores.id')
                    ->groupBy('users.id')
                    ->get();
                    
                    $users = UserResource::collection($user_list);
                    $data['users'] = $users;
                }     
            }else{
                $is_waiter = true;
            }
        }

        $data['is_waiter'] = $is_waiter;

        $data['store_slack'] = $request->logged_user_store_slack;

        $data['order_link'] = route('order', ['slack' => '']);
        
        return view('kitchen.waiter', $data);
    }

    public function choose_kitchen_display(Request $request){
        //check access
        $data['menu_key'] = 'MM_RESTAURANT';
        $data['sub_menu_key'] = 'SM_RESTAURANT_KITCHEN';
        check_access(array($data['menu_key'],$data['sub_menu_key']));

        $kitchen_displays = KitchenDisplayModel::select('*')->active()->get();

        $kitchen_display_data = KitchenDisplayResource::collection($kitchen_displays);
        
        $data['kitchen_display_data'] = $kitchen_display_data;

        $data['kitchen_link'] = route('kitchen', ['slack' => '']);

        $data['store_slack'] = $request->logged_user_store_slack;

        return view('kitchen.kitchen_display', $data);
    }
}
