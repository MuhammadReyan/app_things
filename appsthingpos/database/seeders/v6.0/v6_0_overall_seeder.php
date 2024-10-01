<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MasterStatus;
use App\Models\Menu as MenuModel;
use App\Models\Order as OrderModel;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class v6_0_overall_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings_mm = MenuModel::where([
            ['type', '=', 'MAIN_MENU'],
            ['menu_key', '=', 'MM_SETTINGS'],
        ])  
        ->active()
        ->first();

        MenuModel::where([
            ['type', '=', 'SUB_MENU'],
            ['menu_key', '=', 'SM_APP_SETTING'],
        ])
        ->update(['sort_order' => 11]);

        $kd_sm = MenuModel::create(
            [
                'type' => 'SUB_MENU',
                'menu_key' => 'SM_KITCHEN_DISPLAY', 
                'label' => "Kitchen Displays",
                'route' => "kitchen_displays",
                'parent' => $settings_mm->id,
                'is_restaurant_menu' => 1,
                'sort_order' => 10
            ]
        )->id;

        MenuModel::create(
            [
                'type' => 'ACTIONS',
                'menu_key' => 'A_ADD_KITCHEN_DISPLAY', 
                'label' => "Add Kitchen Display",
                'route' => "",
                'parent' => $kd_sm,
                'sort_order' => 1
            ]
        )->id;

        MenuModel::create(
            [
                'type' => 'ACTIONS',
                'menu_key' => 'A_EDIT_KITCHEN_DISPLAY', 
                'label' => "Edit Kitchen Display",
                'route' => "",
                'parent' => $kd_sm,
                'sort_order' => 2
            ]
        )->id;

        MenuModel::create(
            [
                'type' => 'ACTIONS',
                'menu_key' => 'A_DETAIL_KITCHEN_DISPLAY', 
                'label' => "View Kitchen Display Detail",
                'route' => "",
                'parent' => $kd_sm,
                'sort_order' => 3
            ]
        )->id;

        MenuModel::create(
            [
                'type' => 'ACTIONS',
                'menu_key' => 'A_VIEW_KITCHEN_DISPLAY_LISTING', 
                'label' => "View Kitchen Display Listing",
                'route' => "",
                'parent' => $kd_sm,
                'sort_order' => 4
            ]
        )->id;

        MasterStatus::firstOrCreate(
            [
                'key' => 'KITCHEN_DISPLAY_STATUS',
                'value' => '1',
                'value_constant' => 'ACTIVE',
                'label' => 'Active',
                'color' => 'label green-label'
            ]
        )->save();

        MasterStatus::firstOrCreate(
            [
                'key' => 'KITCHEN_DISPLAY_STATUS',
                'value' => '0',
                'value_constant' => 'INACTIVE',
                'label' => 'Inactive',
                'color' => 'label red-label'
            ]
        )->save();

        MenuModel::where([
            ['type', '=', 'SUB_MENU'],
            ['menu_key', '=', 'SM_RESTAURANT_KITCHEN'],
        ])
        ->update(['label' => 'Kitchen Display', 'route' => 'choose_kitchen_display']);

        MenuModel::where([
            ['type', '=', 'SUB_MENU'],
            ['menu_key', '=', 'SM_RESTAURANT_WAITER'],
        ])
        ->update(['label' => 'Waiter Display']);
       
        $previous_orders = OrderModel::withoutGlobalScopes()->select('id', 'created_at')->where('created_at', '>=', Carbon::now()->subDays(2)->format('Y-m-d'))->get();
        if(!empty($previous_orders)){
            foreach($previous_orders as $order){
                OrderModel::withoutGlobalScopes()->where('id', $order->id)->update(['quantity_updated_on' => $order->created_at]);
            }
        }
        
    }
}
