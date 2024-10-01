<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Menu as MenuModel;

class v5_5_overall_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $product_sm = MenuModel::select('id')->where([
            ['type', '=', 'SUB_MENU'],
            ['menu_key', '=', 'SM_PRODUCTS'],
        ])
        ->active()
        ->first();

        MenuModel::create(
            [
                'type' => 'ACTIONS',
                'menu_key' => 'A_DELETE_PRODUCT', 
                'label' => "Delete Product",
                'route' => "",
                'parent' => $product_sm->id,
                'sort_order' => 5
            ]
        )->id;

        $category_sm = MenuModel::select('id')->where([
            ['type', '=', 'SUB_MENU'],
            ['menu_key', '=', 'SM_CATEGORY'],
        ])
        ->active()
        ->first();

        MenuModel::create(
            [
                'type' => 'ACTIONS',
                'menu_key' => 'A_DELETE_CATEGORY', 
                'label' => "Delete Category",
                'route' => "",
                'parent' => $category_sm->id,
                'sort_order' => 5
            ]
        )->id;

        $taxcode_sm = MenuModel::select('id')->where([
            ['type', '=', 'SUB_MENU'],
            ['menu_key', '=', 'SM_TAXCODES'],
        ])
        ->active()
        ->first();

        MenuModel::create(
            [
                'type' => 'ACTIONS',
                'menu_key' => 'A_DELETE_TAXCODE', 
                'label' => "Delete Tax Code",
                'route' => "",
                'parent' => $taxcode_sm->id,
                'sort_order' => 5
            ]
        )->id;

        $discountcode_sm = MenuModel::select('id')->where([
            ['type', '=', 'SUB_MENU'],
            ['menu_key', '=', 'SM_DISCOUNTCODES'],
        ])
        ->active()
        ->first();

        MenuModel::create(
            [
                'type' => 'ACTIONS',
                'menu_key' => 'A_DELETE_DISCOUNTCODE', 
                'label' => "Delete Discount Code",
                'route' => "",
                'parent' => $discountcode_sm->id,
                'sort_order' => 5
            ]
        )->id;

        $supplier_sm = MenuModel::select('id')->where([
            ['type', '=', 'SUB_MENU'],
            ['menu_key', '=', 'SM_SUPPLIERS'],
        ])
        ->active()
        ->first();

        MenuModel::create(
            [
                'type' => 'ACTIONS',
                'menu_key' => 'A_DELETE_SUPPLIER', 
                'label' => "Delete Supplier",
                'route' => "",
                'parent' => $supplier_sm->id,
                'sort_order' => 5
            ]
        )->id;

        $users_sm = MenuModel::select('id')->where([
            ['type', '=', 'SUB_MENU'],
            ['menu_key', '=', 'SM_USERS'],
        ])
        ->active()
        ->first();

        MenuModel::create(
            [
                'type' => 'ACTIONS',
                'menu_key' => 'A_DELETE_USER', 
                'label' => "Delete User",
                'route' => "",
                'parent' => $users_sm->id,
                'sort_order' => 5,
                'status' => 0
            ]
        )->id;

        $customer_sm = MenuModel::select('id')->where([
            ['type', '=', 'SUB_MENU'],
            ['menu_key', '=', 'SM_CUSTOMERS'],
        ])
        ->active()
        ->first();

        MenuModel::create(
            [
                'type' => 'ACTIONS',
                'menu_key' => 'A_DELETE_CUSTOMER', 
                'label' => "Delete Customer",
                'route' => "",
                'parent' => $customer_sm->id,
                'sort_order' => 5
            ]
        )->id;

        $role_sm = MenuModel::select('id')->where([
            ['type', '=', 'SUB_MENU'],
            ['menu_key', '=', 'SM_ROLES'],
        ])
        ->active()
        ->first();

        MenuModel::create(
            [
                'type' => 'ACTIONS',
                'menu_key' => 'A_DELETE_ROLE', 
                'label' => "Delete Role",
                'route' => "",
                'parent' => $role_sm->id,
                'sort_order' => 5
            ]
        )->id;
    }
}
