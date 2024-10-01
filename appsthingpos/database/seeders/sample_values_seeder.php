<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Config;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

use App\Models\Store as StoreModel;
use App\Models\Account as AccountModel;
use App\Models\Supplier as SupplierModel;
use App\Models\Category as CategoryModel;
use App\Models\Product as ProductModel;
use App\Models\Table as TableModel;
use App\Models\Taxcode as TaxcodeModel;
use App\Models\Discountcode as DiscountcodeModel;
use App\Models\Target as TargetModel;
use App\Models\User as UserModel;
use App\Models\Notification as NotificationModel;
use App\Models\BillingCounter as BillingCounterModel;
use App\Models\ProductImages as ProductImagesModel;
use App\Models\MeasurementUnit as MeasurementUnitModel;
use App\Models\AddonGroup as AddonGroupModel;
use App\Models\AddonGroupProduct as AddonGroupProductModel;
use App\Models\ProductAddonGroup as ProductAddonGroupModel;
use App\Models\VariantOption as VariantOptionModel;
use App\Models\ProductVariant as ProductVariantModel;
use App\Models\PaymentMethod as PaymentMethodModel;
use App\Models\BusinessRegister as BusinessRegisterModel;
use App\Models\Order as OrderModel;
use App\Models\KitchenDisplay as KitchenDisplayModel;
use App\Models\MasterTransactionType as MasterTransactionTypeModel;
use App\Models\Transaction as TransactionModel;
use App\Models\Customer as CustomerModel;

use App\Http\Controllers\API\Product as ProductAPI;
use App\Http\Controllers\API\User as UserAPI;
use App\Http\Controllers\API\Order as OrderAPI;
use App\Http\Controllers\API\Invoice as InvoiceAPI;
use App\Http\Controllers\API\PurchaseOrder as PurchaseOrderAPI;
use App\Http\Controllers\API\Quotation as QuotationAPI;

use Faker;

class sample_values_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $base_controller = new Controller;

        $store_1 = DB::table("stores")->insertGetId([
            "slack" => $base_controller->generate_slack("stores"),
            "store_code" => strtoupper(trim("STORE1")),
            "name" => "Appsthing Store 1",
            "tax_number" => "100000000000",
            "address" => $faker->address,
            "country_id" => 230,
            "pincode" => "100111",
            "primary_contact" => $faker->e164PhoneNumber,
            "secondary_contact" => $faker->e164PhoneNumber,
            "primary_email" => $faker->unique()->email,
            "secondary_email" => $faker->unique()->email,
            "invoice_type" => "SMALL",
            "currency_code" => "USD",
            "currency_name" => "United States dollar",
            "restaurant_mode" =>1,
            "restaurant_chef_role_id" => 6,
            "restaurant_waiter_role_id" => 5,
            "restaurant_billing_type_id" => 2,
            "enable_digital_menu_otp_verification" => 0,
            "status" => 1,
            "created_at" => NOW(),
            "updated_at" => NOW(),
            "created_by" => 1
        ]);

        $store_2 = DB::table("stores")->insertGetId([
            "slack" => $base_controller->generate_slack("stores"),
            "store_code" => strtoupper(trim("STORE2")),
            "name" => "Appsthing Store 2",
            "tax_number" => "100000000001",
            "address" => $faker->address,
            "country_id" => 98,
            "pincode" => "560038",
            "primary_contact" => $faker->e164PhoneNumber,
            "secondary_contact" => $faker->e164PhoneNumber,
            "primary_email" => $faker->unique()->email,
            "secondary_email" => $faker->unique()->email,
            "invoice_type" => "A4",
            "currency_code" => "INR",
            "currency_name" => "Indian rupee",
            "restaurant_mode" => 0,
            "restaurant_waiter_role_id" => '',
            "restaurant_billing_type_id" => '',
            "enable_digital_menu_otp_verification" => 0,
            "status" => 1,
            "created_at" => NOW(),
            "updated_at" => NOW(),
            "created_by" => 1
        ]);

        $store_3 = DB::table("stores")->insertGetId([
            "slack" => $base_controller->generate_slack("stores"),
            "store_code" => strtoupper(trim("STORE3")),
            "name" => "Appsthing Store 3",
            "tax_number" => "100000000001",
            "address" => $faker->address,
            "country_id" => 230,
            "pincode" => "100222",
            "primary_contact" => $faker->e164PhoneNumber,
            "secondary_contact" => $faker->e164PhoneNumber,
            "primary_email" => $faker->unique()->email,
            "secondary_email" => $faker->unique()->email,
            "invoice_type" => "A4",
            "currency_code" => "USD",
            "currency_name" => "United States dollar",
            "restaurant_mode" =>1,
            "restaurant_chef_role_id" => 6,
            "restaurant_waiter_role_id" => 5,
            "restaurant_billing_type_id" => 1,
            "enable_digital_menu_otp_verification" => 0,
            "status" => 1,
            "created_at" => NOW(),
            "updated_at" => NOW(),
            "created_by" => 1
        ]);

        $store_4 = DB::table("stores")->insertGetId([
            "slack" => $base_controller->generate_slack("stores"),
            "store_code" => strtoupper(trim("STORE4")),
            "name" => "Appsthing Store 4",
            "tax_number" => "100000000001",
            "address" => $faker->address,
            "country_id" => 230,
            "pincode" => "100222",
            "primary_contact" => $faker->e164PhoneNumber,
            "secondary_contact" => $faker->e164PhoneNumber,
            "primary_email" => $faker->unique()->email,
            "secondary_email" => $faker->unique()->email,
            "invoice_type" => "A4",
            "currency_code" => "USD",
            "currency_name" => "United States dollar",
            "restaurant_mode" => 1,
            "restaurant_chef_role_id" => 6,
            "restaurant_waiter_role_id" => 5,
            "restaurant_billing_type_id" => 1,
            "enable_digital_menu_otp_verification" => 0,
            "status" => 1,
            "created_at" => NOW(),
            "updated_at" => NOW(),
            "created_by" => 1
        ]);

        $store_5 = DB::table("stores")->insertGetId([
            "slack" => $base_controller->generate_slack("stores"),
            "store_code" => strtoupper(trim("STORE5")),
            "name" => "Appsthing Store 5",
            "tax_number" => "100000000001",
            "address" => $faker->address,
            "country_id" => 230,
            "pincode" => "100222",
            "primary_contact" => $faker->e164PhoneNumber,
            "secondary_contact" => $faker->e164PhoneNumber,
            "primary_email" => $faker->unique()->email,
            "secondary_email" => $faker->unique()->email,
            "invoice_type" => "A4",
            "currency_code" => "USD",
            "currency_name" => "United States dollar",
            "restaurant_mode" =>0,
            "enable_digital_menu_otp_verification" => 0,
            "status" => 1,
            "created_at" => NOW(),
            "updated_at" => NOW(),
            "created_by" => 1
        ]);

        $manager_role_id = DB::table("roles")->insertGetId([
            'slack' => $base_controller->generate_slack("roles"),
            'role_code' => '100',
            'label' => 'Manager', 
            'status' => 1,
            "created_at" => NOW(),
            "updated_at" => NOW(),
            "created_by" => 1
        ]);

        $accounts_manager_role_id = DB::table("roles")->insertGetId([
            'slack' => $base_controller->generate_slack("roles"),
            'role_code' => '101',
            'label' => 'Accounts Manager', 
            'status' => 1,
            "created_at" => NOW(),
            "updated_at" => NOW(),
            "created_by" => 1
        ]);

        $cashier_role_id = DB::table("roles")->insertGetId([
            'slack' => $base_controller->generate_slack("roles"),
            'role_code' => '102',
            'label' => 'Cashier', 
            'status' => 1,
            "created_at" => NOW(),
            "updated_at" => NOW(),
            "created_by" => 1
        ]);

        $waiter_role_id = DB::table("roles")->insertGetId([
            'slack' => $base_controller->generate_slack("roles"),
            'role_code' => '103',
            'label' => 'Waiter', 
            'status' => 1,
            "created_at" => NOW(),
            "updated_at" => NOW(),
            "created_by" => 1
        ]);

        $chef_role_id = DB::table("roles")->insertGetId([
            'slack' => $base_controller->generate_slack("roles"),
            'role_code' => '104',
            'label' => 'Chef', 
            'status' => 1,
            "created_at" => NOW(),
            "updated_at" => NOW(),
            "created_by" => 1
        ]);

        DB::insert("INSERT INTO `role_menus` (`id`, `role_id`, `menu_id`, `created_by`, `created_at`, `updated_at`) VALUES
        (NULL, 3, 1, 1, NOW(), NOW()),
        (NULL, 3, 2, 1, NOW(), NOW()),
        (NULL, 3, 7, 1, NOW(), NOW()),
        (NULL, 3, 8, 1, NOW(), NOW()),
        (NULL, 3, 9, 1, NOW(), NOW()),
        (NULL, 3, 10, 1, NOW(), NOW()),
        (NULL, 3, 20, 1, NOW(), NOW()),
        (NULL, 3, 34, 1, NOW(), NOW()),
        (NULL, 3, 35, 1, NOW(), NOW()),
        (NULL, 3, 36, 1, NOW(), NOW()),
        (NULL, 3, 37, 1, NOW(), NOW()),
        (NULL, 3, 57, 1, NOW(), NOW()),
        (NULL, 3, 58, 1, NOW(), NOW()),
        (NULL, 3, 59, 1, NOW(), NOW()),
        (NULL, 3, 70, 1, NOW(), NOW()),
        (NULL, 3, 71, 1, NOW(), NOW()),
        (NULL, 3, 72, 1, NOW(), NOW()),
        (NULL, 3, 73, 1, NOW(), NOW()),
        (NULL, 3, 76, 1, NOW(), NOW()),
        (NULL, 3, 77, 1, NOW(), NOW()),
        (NULL, 3, 78, 1, NOW(), NOW()),
        (NULL, 3, 79, 1, NOW(), NOW()),
        (NULL, 3, 80, 1, NOW(), NOW()),
        (NULL, 3, 81, 1, NOW(), NOW()),
        (NULL, 3, 82, 1, NOW(), NOW()),
        (NULL, 3, 83, 1, NOW(), NOW()),
        (NULL, 3, 84, 1, NOW(), NOW()),
        (NULL, 3, 85, 1, NOW(), NOW()),
        (NULL, 3, 86, 1, NOW(), NOW()),
        (NULL, 3, 87, 1, NOW(), NOW()),
        (NULL, 3, 88, 1, NOW(), NOW()),
        (NULL, 3, 89, 1, NOW(), NOW()),
        (NULL, 3, 90, 1, NOW(), NOW()),
        (NULL, 3, 91, 1, NOW(), NOW()),
        (NULL, 3, 92, 1, NOW(), NOW()),
        (NULL, 3, 93, 1, NOW(), NOW()),
        (NULL, 3, 94, 1, NOW(), NOW()),
        (NULL, 3, 95, 1, NOW(), NOW()),
        (NULL, 3, 96, 1, NOW(), NOW()),
        (NULL, 3, 97, 1, NOW(), NOW()),
        (NULL, 3, 98, 1, NOW(), NOW()),
        (NULL, 3, 99, 1, NOW(), NOW()),
        (NULL, 3, 107, 1, NOW(), NOW()),
        (NULL, 3, 108, 1, NOW(), NOW()),
        (NULL, 3, 109, 1, NOW(), NOW()),
        (NULL, 3, 110, 1, NOW(), NOW()),
        (NULL, 3, 111, 1, NOW(), NOW()),
        (NULL, 3, 118, 1, NOW(), NOW()),
        (NULL, 3, 119, 1, NOW(), NOW()),
        (NULL, 3, 120, 1, NOW(), NOW()),
        (NULL, 3, 121, 1, NOW(), NOW()),
        (NULL, 3, 122, 1, NOW(), NOW()),
        (NULL, 3, 123, 1, NOW(), NOW()),
        (NULL, 3, 124, 1, NOW(), NOW()),
        (NULL, 3, 137, 1, NOW(), NOW()),
        (NULL, 3, 150, 1, NOW(), NOW()),
        (NULL, 3, 151, 1, NOW(), NOW()),
        (NULL, 3, 152, 1, NOW(), NOW()),
        (NULL, 3, 153, 1, NOW(), NOW()),
        (NULL, 3, 154, 1, NOW(), NOW()),
        (NULL, 3, 155, 1, NOW(), NOW()),
        (NULL, 3, 156, 1, NOW(), NOW()),
        (NULL, 3, 167, 1, NOW(), NOW()),
        (NULL, 3, 168, 1, NOW(), NOW()),
        (NULL, 3, 169, 1, NOW(), NOW()),
        (NULL, 3, 170, 1, NOW(), NOW()),
        (NULL, 3, 171, 1, NOW(), NOW()),
        (NULL, 3, 172, 1, NOW(), NOW()),
        (NULL, 3, 173, 1, NOW(), NOW()),
        (NULL, 3, 174, 1, NOW(), NOW()),
        (NULL, 3, 175, 1, NOW(), NOW()),
        (NULL, 3, 187, 1, NOW(), NOW()),
        (NULL, 3, 188, 1, NOW(), NOW()),
        (NULL, 3, 189, 1, NOW(), NOW()),
        (NULL, 5, 100, 1, NOW(), NOW()),
        (NULL, 5, 178, 1, NOW(), NOW()),
        (NULL, 5, 184, 1, NOW(), NOW()),
        (NULL, 6, 100, 1, NOW(), NOW()),
        (NULL, 6, 101, 1, NOW(), NOW()),
        (NULL, 6, 106, 1, NOW(), NOW()),
        (NULL, 6, 134, 1, NOW(), NOW()),
        (NULL, 6, 184, 1, NOW(), NOW()),
        (NULL, 2, 1, 1, NOW(), NOW()),
        (NULL, 2, 2, 1, NOW(), NOW()),
        (NULL, 2, 3, 1, NOW(), NOW()),
        (NULL, 2, 4, 1, NOW(), NOW()),
        (NULL, 2, 5, 1, NOW(), NOW()),
        (NULL, 2, 6, 1, NOW(), NOW()),
        (NULL, 2, 7, 1, NOW(), NOW()),
        (NULL, 2, 8, 1, NOW(), NOW()),
        (NULL, 2, 9, 1, NOW(), NOW()),
        (NULL, 2, 10, 1, NOW(), NOW()),
        (NULL, 2, 11, 1, NOW(), NOW()),
        (NULL, 2, 12, 1, NOW(), NOW()),
        (NULL, 2, 13, 1, NOW(), NOW()),
        (NULL, 2, 14, 1, NOW(), NOW()),
        (NULL, 2, 15, 1, NOW(), NOW()),
        (NULL, 2, 16, 1, NOW(), NOW()),
        (NULL, 2, 17, 1, NOW(), NOW()),
        (NULL, 2, 18, 1, NOW(), NOW()),
        (NULL, 2, 19, 1, NOW(), NOW()),
        (NULL, 2, 20, 1, NOW(), NOW()),
        (NULL, 2, 21, 1, NOW(), NOW()),
        (NULL, 2, 22, 1, NOW(), NOW()),
        (NULL, 2, 23, 1, NOW(), NOW()),
        (NULL, 2, 25, 1, NOW(), NOW()),
        (NULL, 2, 26, 1, NOW(), NOW()),
        (NULL, 2, 27, 1, NOW(), NOW()),
        (NULL, 2, 28, 1, NOW(), NOW()),
        (NULL, 2, 29, 1, NOW(), NOW()),
        (NULL, 2, 30, 1, NOW(), NOW()),
        (NULL, 2, 31, 1, NOW(), NOW()),
        (NULL, 2, 32, 1, NOW(), NOW()),
        (NULL, 2, 33, 1, NOW(), NOW()),
        (NULL, 2, 34, 1, NOW(), NOW()),
        (NULL, 2, 35, 1, NOW(), NOW()),
        (NULL, 2, 36, 1, NOW(), NOW()),
        (NULL, 2, 37, 1, NOW(), NOW()),
        (NULL, 2, 38, 1, NOW(), NOW()),
        (NULL, 2, 39, 1, NOW(), NOW()),
        (NULL, 2, 40, 1, NOW(), NOW()),
        (NULL, 2, 41, 1, NOW(), NOW()),
        (NULL, 2, 42, 1, NOW(), NOW()),
        (NULL, 2, 43, 1, NOW(), NOW()),
        (NULL, 2, 44, 1, NOW(), NOW()),
        (NULL, 2, 45, 1, NOW(), NOW()),
        (NULL, 2, 46, 1, NOW(), NOW()),
        (NULL, 2, 47, 1, NOW(), NOW()),
        (NULL, 2, 48, 1, NOW(), NOW()),
        (NULL, 2, 49, 1, NOW(), NOW()),
        (NULL, 2, 50, 1, NOW(), NOW()),
        (NULL, 2, 51, 1, NOW(), NOW()),
        (NULL, 2, 52, 1, NOW(), NOW()),
        (NULL, 2, 53, 1, NOW(), NOW()),
        (NULL, 2, 54, 1, NOW(), NOW()),
        (NULL, 2, 55, 1, NOW(), NOW()),
        (NULL, 2, 56, 1, NOW(), NOW()),
        (NULL, 2, 57, 1, NOW(), NOW()),
        (NULL, 2, 58, 1, NOW(), NOW()),
        (NULL, 2, 59, 1, NOW(), NOW()),
        (NULL, 2, 60, 1, NOW(), NOW()),
        (NULL, 2, 61, 1, NOW(), NOW()),
        (NULL, 2, 62, 1, NOW(), NOW()),
        (NULL, 2, 63, 1, NOW(), NOW()),
        (NULL, 2, 64, 1, NOW(), NOW()),
        (NULL, 2, 65, 1, NOW(), NOW()),
        (NULL, 2, 66, 1, NOW(), NOW()),
        (NULL, 2, 67, 1, NOW(), NOW()),
        (NULL, 2, 68, 1, NOW(), NOW()),
        (NULL, 2, 69, 1, NOW(), NOW()),
        (NULL, 2, 70, 1, NOW(), NOW()),
        (NULL, 2, 71, 1, NOW(), NOW()),
        (NULL, 2, 72, 1, NOW(), NOW()),
        (NULL, 2, 73, 1, NOW(), NOW()),
        (NULL, 2, 74, 1, NOW(), NOW()),
        (NULL, 2, 76, 1, NOW(), NOW()),
        (NULL, 2, 77, 1, NOW(), NOW()),
        (NULL, 2, 78, 1, NOW(), NOW()),
        (NULL, 2, 79, 1, NOW(), NOW()),
        (NULL, 2, 80, 1, NOW(), NOW()),
        (NULL, 2, 81, 1, NOW(), NOW()),
        (NULL, 2, 82, 1, NOW(), NOW()),
        (NULL, 2, 83, 1, NOW(), NOW()),
        (NULL, 2, 84, 1, NOW(), NOW()),
        (NULL, 2, 85, 1, NOW(), NOW()),
        (NULL, 2, 86, 1, NOW(), NOW()),
        (NULL, 2, 87, 1, NOW(), NOW()),
        (NULL, 2, 88, 1, NOW(), NOW()),
        (NULL, 2, 89, 1, NOW(), NOW()),
        (NULL, 2, 90, 1, NOW(), NOW()),
        (NULL, 2, 91, 1, NOW(), NOW()),
        (NULL, 2, 92, 1, NOW(), NOW()),
        (NULL, 2, 93, 1, NOW(), NOW()),
        (NULL, 2, 94, 1, NOW(), NOW()),
        (NULL, 2, 95, 1, NOW(), NOW()),
        (NULL, 2, 96, 1, NOW(), NOW()),
        (NULL, 2, 97, 1, NOW(), NOW()),
        (NULL, 2, 98, 1, NOW(), NOW()),
        (NULL, 2, 99, 1, NOW(), NOW()),
        (NULL, 2, 100, 1, NOW(), NOW()),
        (NULL, 2, 101, 1, NOW(), NOW()),
        (NULL, 2, 102, 1, NOW(), NOW()),
        (NULL, 2, 103, 1, NOW(), NOW()),
        (NULL, 2, 104, 1, NOW(), NOW()),
        (NULL, 2, 105, 1, NOW(), NOW()),
        (NULL, 2, 106, 1, NOW(), NOW()),
        (NULL, 2, 107, 1, NOW(), NOW()),
        (NULL, 2, 108, 1, NOW(), NOW()),
        (NULL, 2, 109, 1, NOW(), NOW()),
        (NULL, 2, 110, 1, NOW(), NOW()),
        (NULL, 2, 111, 1, NOW(), NOW()),
        (NULL, 2, 112, 1, NOW(), NOW()),
        (NULL, 2, 113, 1, NOW(), NOW()),
        (NULL, 2, 114, 1, NOW(), NOW()),
        (NULL, 2, 115, 1, NOW(), NOW()),
        (NULL, 2, 116, 1, NOW(), NOW()),
        (NULL, 2, 117, 1, NOW(), NOW()),
        (NULL, 2, 118, 1, NOW(), NOW()),
        (NULL, 2, 119, 1, NOW(), NOW()),
        (NULL, 2, 120, 1, NOW(), NOW()),
        (NULL, 2, 121, 1, NOW(), NOW()),
        (NULL, 2, 122, 1, NOW(), NOW()),
        (NULL, 2, 123, 1, NOW(), NOW()),
        (NULL, 2, 124, 1, NOW(), NOW()),
        (NULL, 2, 125, 1, NOW(), NOW()),
        (NULL, 2, 126, 1, NOW(), NOW()),
        (NULL, 2, 127, 1, NOW(), NOW()),
        (NULL, 2, 128, 1, NOW(), NOW()),
        (NULL, 2, 129, 1, NOW(), NOW()),
        (NULL, 2, 130, 1, NOW(), NOW()),
        (NULL, 2, 131, 1, NOW(), NOW()),
        (NULL, 2, 132, 1, NOW(), NOW()),
        (NULL, 2, 133, 1, NOW(), NOW()),
        (NULL, 2, 134, 1, NOW(), NOW()),
        (NULL, 2, 135, 1, NOW(), NOW()),
        (NULL, 2, 136, 1, NOW(), NOW()),
        (NULL, 2, 137, 1, NOW(), NOW()),
        (NULL, 2, 138, 1, NOW(), NOW()),
        (NULL, 2, 139, 1, NOW(), NOW()),
        (NULL, 2, 140, 1, NOW(), NOW()),
        (NULL, 2, 141, 1, NOW(), NOW()),
        (NULL, 2, 142, 1, NOW(), NOW()),
        (NULL, 2, 143, 1, NOW(), NOW()),
        (NULL, 2, 144, 1, NOW(), NOW()),
        (NULL, 2, 145, 1, NOW(), NOW()),
        (NULL, 2, 146, 1, NOW(), NOW()),
        (NULL, 2, 147, 1, NOW(), NOW()),
        (NULL, 2, 148, 1, NOW(), NOW()),
        (NULL, 2, 149, 1, NOW(), NOW()),
        (NULL, 2, 150, 1, NOW(), NOW()),
        (NULL, 2, 151, 1, NOW(), NOW()),
        (NULL, 2, 152, 1, NOW(), NOW()),
        (NULL, 2, 153, 1, NOW(), NOW()),
        (NULL, 2, 154, 1, NOW(), NOW()),
        (NULL, 2, 155, 1, NOW(), NOW()),
        (NULL, 2, 156, 1, NOW(), NOW()),
        (NULL, 2, 157, 1, NOW(), NOW()),
        (NULL, 2, 158, 1, NOW(), NOW()),
        (NULL, 2, 159, 1, NOW(), NOW()),
        (NULL, 2, 160, 1, NOW(), NOW()),
        (NULL, 2, 161, 1, NOW(), NOW()),
        (NULL, 2, 162, 1, NOW(), NOW()),
        (NULL, 2, 163, 1, NOW(), NOW()),
        (NULL, 2, 164, 1, NOW(), NOW()),
        (NULL, 2, 165, 1, NOW(), NOW()),
        (NULL, 2, 166, 1, NOW(), NOW()),
        (NULL, 2, 167, 1, NOW(), NOW()),
        (NULL, 2, 168, 1, NOW(), NOW()),
        (NULL, 2, 169, 1, NOW(), NOW()),
        (NULL, 2, 170, 1, NOW(), NOW()),
        (NULL, 2, 171, 1, NOW(), NOW()),
        (NULL, 2, 172, 1, NOW(), NOW()),
        (NULL, 2, 173, 1, NOW(), NOW()),
        (NULL, 2, 174, 1, NOW(), NOW()),
        (NULL, 2, 175, 1, NOW(), NOW()),
        (NULL, 2, 176, 1, NOW(), NOW()),
        (NULL, 2, 177, 1, NOW(), NOW()),
        (NULL, 2, 178, 1, NOW(), NOW()),
        (NULL, 2, 179, 1, NOW(), NOW()),
        (NULL, 2, 180, 1, NOW(), NOW()),
        (NULL, 2, 181, 1, NOW(), NOW()),
        (NULL, 2, 182, 1, NOW(), NOW()),
        (NULL, 2, 183, 1, NOW(), NOW()),
        (NULL, 2, 184, 1, NOW(), NOW()),
        (NULL, 2, 185, 1, NOW(), NOW()),
        (NULL, 2, 186, 1, NOW(), NOW()),
        (NULL, 2, 187, 1, NOW(), NOW()),
        (NULL, 2, 188, 1, NOW(), NOW()),
        (NULL, 2, 189, 1, NOW(), NOW()),
        (NULL, 2, 190, 1, NOW(), NOW()),
        (NULL, 2, 191, 1, NOW(), NOW()),
        (NULL, 2, 192, 1, NOW(), NOW()),
        (NULL, 2, 193, 1, NOW(), NOW()),
        (NULL, 2, 194, 1, NOW(), NOW()),
        (NULL, 2, 195, 1, NOW(), NOW()),
        (NULL, 2, 196, 1, NOW(), NOW()),
        (NULL, 2, 197, 1, NOW(), NOW()),
        (NULL, 2, 198, 1, NOW(), NOW()),
        (NULL, 2, 199, 1, NOW(), NOW()),
        (NULL, 2, 200, 1, NOW(), NOW()),
        (NULL, 2, 201, 1, NOW(), NOW()),
        (NULL, 2, 202, 1, NOW(), NOW()),
        (NULL, 2, NULL, 1, NOW(), NOW()),
        (NULL, 2, 204, 1, NOW(), NOW()),
        (NULL, 2, 205, 1, NOW(), NOW()),
        (NULL, 2, 206, 1, NOW(), NOW()),
        (NULL, 2, 207, 1, NOW(), NOW()),
        (NULL, 2, 208, 1, NOW(), NOW()),
        (NULL, 2, 209, 1, NOW(), NOW()),
        (NULL, 2, 210, 1, NOW(), NOW()),
        (NULL, 2, 211, 1, NOW(), NOW()),
        (NULL, 2, 212, 1, NOW(), NOW()),
        (NULL, 4, 1, 1, NOW(), NOW()),
        (NULL, 4, 2, 1, NOW(), NOW()),
        (NULL, 4, 9, 1, NOW(), NOW()),
        (NULL, 4, 34, 1, NOW(), NOW()),
        (NULL, 4, 35, 1, NOW(), NOW()),
        (NULL, 4, 36, 1, NOW(), NOW()),
        (NULL, 4, 37, 1, NOW(), NOW()),
        (NULL, 4, 76, 1, NOW(), NOW()),
        (NULL, 4, 77, 1, NOW(), NOW()),
        (NULL, 4, 78, 1, NOW(), NOW()),
        (NULL, 4, 79, 1, NOW(), NOW()),
        (NULL, 4, 80, 1, NOW(), NOW()),
        (NULL, 4, 81, 1, NOW(), NOW()),
        (NULL, 4, 82, 1, NOW(), NOW()),
        (NULL, 4, 91, 1, NOW(), NOW()),
        (NULL, 4, 95, 1, NOW(), NOW()),
        (NULL, 4, 96, 1, NOW(), NOW()),
        (NULL, 4, 97, 1, NOW(), NOW()),
        (NULL, 4, 98, 1, NOW(), NOW()),
        (NULL, 4, 118, 1, NOW(), NOW()),
        (NULL, 4, 119, 1, NOW(), NOW()),
        (NULL, 4, 123, 1, NOW(), NOW()),
        (NULL, 4, 167, 1, NOW(), NOW()),
        (NULL, 4, 174, 1, NOW(), NOW()),
        (NULL, 4, 187, 1, NOW(), NOW()),
        (NULL, 4, 188, 1, NOW(), NOW()),
        (NULL, 4, 189, 1, NOW(), NOW()),
        (NULL, 4, 190, 1, NOW(), NOW()),
        (NULL, 4, 191, 1, NOW(), NOW()),
        (NULL, 4, 192, 1, NOW(), NOW()),
        (NULL, 4, 193, 1, NOW(), NOW()),
        (NULL, 4, 194, 1, NOW(), NOW()),
        (NULL, 4, 195, 1, NOW(), NOW()),
        (NULL, 4, 196, 1, NOW(), NOW()),
        (NULL, 4, 197, 1, NOW(), NOW()),
        (NULL, 4, 205, 1, NOW(), NOW()),
        (NULL, 4, 206, 1, NOW(), NOW())");

        $hashed_password = Hash::make("posuser");

        $manager_user_id = DB::table("users")->insertGetId([
            "slack" => $base_controller->generate_slack("users"),
            "user_code" => "100",
            "fullname" => $faker->firstName ." ".$faker->lastName,
            "email" => "manager@appsthing.com",
            "password" => $hashed_password,
            "phone" => $faker->e164PhoneNumber,
            "role_id" => $manager_role_id, 
            "status" => 1,
            "created_at" => NOW(),
            "updated_at" => NOW(),
            "created_by" => 1
        ]);

        $accounts_manager_user_id = DB::table("users")->insertGetId([
            "slack" => $base_controller->generate_slack("users"),
            "user_code" => "101",
            "fullname" => $faker->firstName ." ".$faker->lastName,
            "email" => "accounts@appsthing.com",
            "password" => $hashed_password,
            "phone" => $faker->e164PhoneNumber,
            "role_id" => $accounts_manager_role_id, 
            "status" => 1,
            "created_at" => NOW(),
            "updated_at" => NOW(),
            "created_by" => 1
        ]);

        $cashier_user_id = DB::table("users")->insertGetId([
            "slack" => $base_controller->generate_slack("users"),
            "user_code" => "102",
            "fullname" => $faker->firstName ." ".$faker->lastName,
            "email" => "cashier@appsthing.com",
            "password" => $hashed_password,
            "phone" => $faker->e164PhoneNumber,
            "role_id" => $cashier_role_id, 
            "status" => 1,
            "created_at" => NOW(),
            "updated_at" => NOW(),
            "created_by" => 1
        ]);

        $waiter_user_id_1 = DB::table("users")->insertGetId([
            "slack" => $base_controller->generate_slack("users"),
            "user_code" => "103",
            "fullname" => $faker->firstName ." ".$faker->lastName,
            "email" => "waiter1@appsthing.com",
            "password" => $hashed_password,
            "phone" => $faker->e164PhoneNumber,
            "role_id" => $waiter_role_id, 
            "status" => 1,
            "created_at" => NOW(),
            "updated_at" => NOW(),
            "created_by" => 1
        ]);

        $waiter_user_id_2 = DB::table("users")->insertGetId([
            "slack" => $base_controller->generate_slack("users"),
            "user_code" => "104",
            "fullname" => $faker->firstName ." ".$faker->lastName,
            "email" => "waiter2@appsthing.com",
            "password" => $hashed_password,
            "phone" => $faker->e164PhoneNumber,
            "role_id" => $waiter_role_id, 
            "status" => 1,
            "created_at" => NOW(),
            "updated_at" => NOW(),
            "created_by" => 1
        ]);

        $waiter_user_id_3 = DB::table("users")->insertGetId([
            "slack" => $base_controller->generate_slack("users"),
            "user_code" => "105",
            "fullname" => $faker->firstName ." ".$faker->lastName,
            "email" => "waiter3@appsthing.com",
            "password" => $hashed_password,
            "phone" => $faker->e164PhoneNumber,
            "role_id" => $waiter_role_id, 
            "status" => 1,
            "created_at" => NOW(),
            "updated_at" => NOW(),
            "created_by" => 1
        ]);

        $chef_user_id = DB::table("users")->insertGetId([
            "slack" => $base_controller->generate_slack("users"),
            "user_code" => "106",
            "fullname" => $faker->firstName ." ".$faker->lastName,
            "email" => "chef@appsthing.com",
            "password" => $hashed_password,
            "phone" => $faker->e164PhoneNumber,
            "role_id" => $chef_role_id, 
            "status" => 1,
            "created_at" => NOW(),
            "updated_at" => NOW(),
            "created_by" => 1
        ]);

        DB::insert("INSERT INTO `user_menus` (`id`, `user_id`, `menu_id`, `created_by`, `created_at`, `updated_at`) VALUES
        (NULL, 1, 1, 1, NOW(), NOW()),
        (NULL, 1, 2, 1, NOW(), NOW()),
        (NULL, 1, 3, 1, NOW(), NOW()),
        (NULL, 1, 4, 1, NOW(), NOW()),
        (NULL, 1, 5, 1, NOW(), NOW()),
        (NULL, 1, 6, 1, NOW(), NOW()),
        (NULL, 1, 7, 1, NOW(), NOW()),
        (NULL, 1, 8, 1, NOW(), NOW()),
        (NULL, 1, 9, 1, NOW(), NOW()),
        (NULL, 1, 10, 1, NOW(), NOW()),
        (NULL, 1, 11, 1, NOW(), NOW()),
        (NULL, 1, 12, 1, NOW(), NOW()),
        (NULL, 1, 13, 1, NOW(), NOW()),
        (NULL, 1, 14, 1, NOW(), NOW()),
        (NULL, 1, 15, 1, NOW(), NOW()),
        (NULL, 1, 16, 1, NOW(), NOW()),
        (NULL, 1, 17, 1, NOW(), NOW()),
        (NULL, 1, 18, 1, NOW(), NOW()),
        (NULL, 1, 19, 1, NOW(), NOW()),
        (NULL, 1, 20, 1, NOW(), NOW()),
        (NULL, 1, 21, 1, NOW(), NOW()),
        (NULL, 1, 22, 1, NOW(), NOW()),
        (NULL, 1, 23, 1, NOW(), NOW()),
        (NULL, 1, 24, 1, NOW(), NOW()),
        (NULL, 1, 25, 1, NOW(), NOW()),
        (NULL, 1, 26, 1, NOW(), NOW()),
        (NULL, 1, 27, 1, NOW(), NOW()),
        (NULL, 1, 28, 1, NOW(), NOW()),
        (NULL, 1, 29, 1, NOW(), NOW()),
        (NULL, 1, 30, 1, NOW(), NOW()),
        (NULL, 1, 31, 1, NOW(), NOW()),
        (NULL, 1, 32, 1, NOW(), NOW()),
        (NULL, 1, 33, 1, NOW(), NOW()),
        (NULL, 1, 34, 1, NOW(), NOW()),
        (NULL, 1, 35, 1, NOW(), NOW()),
        (NULL, 1, 36, 1, NOW(), NOW()),
        (NULL, 1, 37, 1, NOW(), NOW()),
        (NULL, 1, 38, 1, NOW(), NOW()),
        (NULL, 1, 39, 1, NOW(), NOW()),
        (NULL, 1, 40, 1, NOW(), NOW()),
        (NULL, 1, 41, 1, NOW(), NOW()),
        (NULL, 1, 42, 1, NOW(), NOW()),
        (NULL, 1, 43, 1, NOW(), NOW()),
        (NULL, 1, 44, 1, NOW(), NOW()),
        (NULL, 1, 45, 1, NOW(), NOW()),
        (NULL, 1, 46, 1, NOW(), NOW()),
        (NULL, 1, 47, 1, NOW(), NOW()),
        (NULL, 1, 48, 1, NOW(), NOW()),
        (NULL, 1, 49, 1, NOW(), NOW()),
        (NULL, 1, 50, 1, NOW(), NOW()),
        (NULL, 1, 51, 1, NOW(), NOW()),
        (NULL, 1, 52, 1, NOW(), NOW()),
        (NULL, 1, 53, 1, NOW(), NOW()),
        (NULL, 1, 54, 1, NOW(), NOW()),
        (NULL, 1, 55, 1, NOW(), NOW()),
        (NULL, 1, 56, 1, NOW(), NOW()),
        (NULL, 1, 57, 1, NOW(), NOW()),
        (NULL, 1, 58, 1, NOW(), NOW()),
        (NULL, 1, 59, 1, NOW(), NOW()),
        (NULL, 1, 60, 1, NOW(), NOW()),
        (NULL, 1, 61, 1, NOW(), NOW()),
        (NULL, 1, 62, 1, NOW(), NOW()),
        (NULL, 1, 63, 1, NOW(), NOW()),
        (NULL, 1, 64, 1, NOW(), NOW()),
        (NULL, 1, 65, 1, NOW(), NOW()),
        (NULL, 1, 66, 1, NOW(), NOW()),
        (NULL, 1, 67, 1, NOW(), NOW()),
        (NULL, 1, 68, 1, NOW(), NOW()),
        (NULL, 1, 69, 1, NOW(), NOW()),
        (NULL, 1, 70, 1, NOW(), NOW()),
        (NULL, 1, 71, 1, NOW(), NOW()),
        (NULL, 1, 72, 1, NOW(), NOW()),
        (NULL, 1, 73, 1, NOW(), NOW()),
        (NULL, 1, 74, 1, NOW(), NOW()),
        (NULL, 1, 75, 1, NOW(), NOW()),
        (NULL, 4, 1, 1, NOW(), NOW()),
        (NULL, 4, 2, 1, NOW(), NOW()),
        (NULL, 4, 7, 1, NOW(), NOW()),
        (NULL, 4, 8, 1, NOW(), NOW()),
        (NULL, 4, 9, 1, NOW(), NOW()),
        (NULL, 4, 10, 1, NOW(), NOW()),
        (NULL, 4, 20, 1, NOW(), NOW()),
        (NULL, 4, 34, 1, NOW(), NOW()),
        (NULL, 4, 35, 1, NOW(), NOW()),
        (NULL, 4, 36, 1, NOW(), NOW()),
        (NULL, 4, 37, 1, NOW(), NOW()),
        (NULL, 4, 57, 1, NOW(), NOW()),
        (NULL, 4, 58, 1, NOW(), NOW()),
        (NULL, 4, 59, 1, NOW(), NOW()),
        (NULL, 4, 70, 1, NOW(), NOW()),
        (NULL, 4, 71, 1, NOW(), NOW()),
        (NULL, 4, 72, 1, NOW(), NOW()),
        (NULL, 4, 73, 1, NOW(), NOW()),
        (NULL, 4, 76, 1, NOW(), NOW()),
        (NULL, 4, 77, 1, NOW(), NOW()),
        (NULL, 4, 78, 1, NOW(), NOW()),
        (NULL, 4, 79, 1, NOW(), NOW()),
        (NULL, 4, 80, 1, NOW(), NOW()),
        (NULL, 4, 81, 1, NOW(), NOW()),
        (NULL, 4, 82, 1, NOW(), NOW()),
        (NULL, 4, 83, 1, NOW(), NOW()),
        (NULL, 4, 84, 1, NOW(), NOW()),
        (NULL, 4, 85, 1, NOW(), NOW()),
        (NULL, 4, 86, 1, NOW(), NOW()),
        (NULL, 4, 87, 1, NOW(), NOW()),
        (NULL, 4, 88, 1, NOW(), NOW()),
        (NULL, 4, 89, 1, NOW(), NOW()),
        (NULL, 4, 90, 1, NOW(), NOW()),
        (NULL, 4, 91, 1, NOW(), NOW()),
        (NULL, 4, 92, 1, NOW(), NOW()),
        (NULL, 4, 93, 1, NOW(), NOW()),
        (NULL, 4, 94, 1, NOW(), NOW()),
        (NULL, 4, 95, 1, NOW(), NOW()),
        (NULL, 4, 96, 1, NOW(), NOW()),
        (NULL, 4, 97, 1, NOW(), NOW()),
        (NULL, 4, 98, 1, NOW(), NOW()),
        (NULL, 4, 99, 1, NOW(), NOW()),
        (NULL, 4, 107, 1, NOW(), NOW()),
        (NULL, 4, 108, 1, NOW(), NOW()),
        (NULL, 4, 109, 1, NOW(), NOW()),
        (NULL, 4, 110, 1, NOW(), NOW()),
        (NULL, 4, 111, 1, NOW(), NOW()),
        (NULL, 4, 118, 1, NOW(), NOW()),
        (NULL, 4, 119, 1, NOW(), NOW()),
        (NULL, 4, 120, 1, NOW(), NOW()),
        (NULL, 4, 121, 1, NOW(), NOW()),
        (NULL, 4, 122, 1, NOW(), NOW()),
        (NULL, 4, 123, 1, NOW(), NOW()),
        (NULL, 4, 124, 1, NOW(), NOW()),
        (NULL, 4, 137, 1, NOW(), NOW()),
        (NULL, 4, 150, 1, NOW(), NOW()),
        (NULL, 4, 151, 1, NOW(), NOW()),
        (NULL, 4, 152, 1, NOW(), NOW()),
        (NULL, 4, 153, 1, NOW(), NOW()),
        (NULL, 4, 154, 1, NOW(), NOW()),
        (NULL, 4, 155, 1, NOW(), NOW()),
        (NULL, 4, 156, 1, NOW(), NOW()),
        (NULL, 4, 167, 1, NOW(), NOW()),
        (NULL, 4, 168, 1, NOW(), NOW()),
        (NULL, 4, 169, 1, NOW(), NOW()),
        (NULL, 4, 170, 1, NOW(), NOW()),
        (NULL, 4, 171, 1, NOW(), NOW()),
        (NULL, 4, 172, 1, NOW(), NOW()),
        (NULL, 4, 173, 1, NOW(), NOW()),
        (NULL, 4, 174, 1, NOW(), NOW()),
        (NULL, 4, 175, 1, NOW(), NOW()),
        (NULL, 4, 187, 1, NOW(), NOW()),
        (NULL, 4, 188, 1, NOW(), NOW()),
        (NULL, 4, 189, 1, NOW(), NOW()),
        (NULL, 6, 100, 1, NOW(), NOW()),
        (NULL, 6, 178, 1, NOW(), NOW()),
        (NULL, 6, 184, 1, NOW(), NOW()),
        (NULL, 7, 100, 1, NOW(), NOW()),
        (NULL, 7, 178, 1, NOW(), NOW()),
        (NULL, 7, 184, 1, NOW(), NOW()),
        (NULL, 8, 100, 1, NOW(), NOW()),
        (NULL, 8, 178, 1, NOW(), NOW()),
        (NULL, 8, 184, 1, NOW(), NOW()),
        (NULL, 9, 100, 1, NOW(), NOW()),
        (NULL, 9, 101, 1, NOW(), NOW()),
        (NULL, 9, 106, 1, NOW(), NOW()),
        (NULL, 9, 134, 1, NOW(), NOW()),
        (NULL, 9, 184, 1, NOW(), NOW()),
        (NULL, 3, 1, 1, NOW(), NOW()),
        (NULL, 3, 2, 1, NOW(), NOW()),
        (NULL, 3, 3, 1, NOW(), NOW()),
        (NULL, 3, 4, 1, NOW(), NOW()),
        (NULL, 3, 5, 1, NOW(), NOW()),
        (NULL, 3, 6, 1, NOW(), NOW()),
        (NULL, 3, 7, 1, NOW(), NOW()),
        (NULL, 3, 8, 1, NOW(), NOW()),
        (NULL, 3, 9, 1, NOW(), NOW()),
        (NULL, 3, 10, 1, NOW(), NOW()),
        (NULL, 3, 11, 1, NOW(), NOW()),
        (NULL, 3, 12, 1, NOW(), NOW()),
        (NULL, 3, 13, 1, NOW(), NOW()),
        (NULL, 3, 14, 1, NOW(), NOW()),
        (NULL, 3, 15, 1, NOW(), NOW()),
        (NULL, 3, 16, 1, NOW(), NOW()),
        (NULL, 3, 17, 1, NOW(), NOW()),
        (NULL, 3, 18, 1, NOW(), NOW()),
        (NULL, 3, 19, 1, NOW(), NOW()),
        (NULL, 3, 20, 1, NOW(), NOW()),
        (NULL, 3, 21, 1, NOW(), NOW()),
        (NULL, 3, 22, 1, NOW(), NOW()),
        (NULL, 3, 23, 1, NOW(), NOW()),
        (NULL, 3, 25, 1, NOW(), NOW()),
        (NULL, 3, 26, 1, NOW(), NOW()),
        (NULL, 3, 27, 1, NOW(), NOW()),
        (NULL, 3, 28, 1, NOW(), NOW()),
        (NULL, 3, 29, 1, NOW(), NOW()),
        (NULL, 3, 30, 1, NOW(), NOW()),
        (NULL, 3, 31, 1, NOW(), NOW()),
        (NULL, 3, 32, 1, NOW(), NOW()),
        (NULL, 3, 33, 1, NOW(), NOW()),
        (NULL, 3, 34, 1, NOW(), NOW()),
        (NULL, 3, 35, 1, NOW(), NOW()),
        (NULL, 3, 36, 1, NOW(), NOW()),
        (NULL, 3, 37, 1, NOW(), NOW()),
        (NULL, 3, 38, 1, NOW(), NOW()),
        (NULL, 3, 39, 1, NOW(), NOW()),
        (NULL, 3, 40, 1, NOW(), NOW()),
        (NULL, 3, 41, 1, NOW(), NOW()),
        (NULL, 3, 42, 1, NOW(), NOW()),
        (NULL, 3, 43, 1, NOW(), NOW()),
        (NULL, 3, 44, 1, NOW(), NOW()),
        (NULL, 3, 45, 1, NOW(), NOW()),
        (NULL, 3, 46, 1, NOW(), NOW()),
        (NULL, 3, 47, 1, NOW(), NOW()),
        (NULL, 3, 48, 1, NOW(), NOW()),
        (NULL, 3, 49, 1, NOW(), NOW()),
        (NULL, 3, 50, 1, NOW(), NOW()),
        (NULL, 3, 51, 1, NOW(), NOW()),
        (NULL, 3, 52, 1, NOW(), NOW()),
        (NULL, 3, 53, 1, NOW(), NOW()),
        (NULL, 3, 54, 1, NOW(), NOW()),
        (NULL, 3, 55, 1, NOW(), NOW()),
        (NULL, 3, 56, 1, NOW(), NOW()),
        (NULL, 3, 57, 1, NOW(), NOW()),
        (NULL, 3, 58, 1, NOW(), NOW()),
        (NULL, 3, 59, 1, NOW(), NOW()),
        (NULL, 3, 60, 1, NOW(), NOW()),
        (NULL, 3, 61, 1, NOW(), NOW()),
        (NULL, 3, 62, 1, NOW(), NOW()),
        (NULL, 3, 63, 1, NOW(), NOW()),
        (NULL, 3, 64, 1, NOW(), NOW()),
        (NULL, 3, 65, 1, NOW(), NOW()),
        (NULL, 3, 66, 1, NOW(), NOW()),
        (NULL, 3, 67, 1, NOW(), NOW()),
        (NULL, 3, 68, 1, NOW(), NOW()),
        (NULL, 3, 69, 1, NOW(), NOW()),
        (NULL, 3, 70, 1, NOW(), NOW()),
        (NULL, 3, 71, 1, NOW(), NOW()),
        (NULL, 3, 72, 1, NOW(), NOW()),
        (NULL, 3, 73, 1, NOW(), NOW()),
        (NULL, 3, 74, 1, NOW(), NOW()),
        (NULL, 3, 76, 1, NOW(), NOW()),
        (NULL, 3, 77, 1, NOW(), NOW()),
        (NULL, 3, 78, 1, NOW(), NOW()),
        (NULL, 3, 79, 1, NOW(), NOW()),
        (NULL, 3, 80, 1, NOW(), NOW()),
        (NULL, 3, 81, 1, NOW(), NOW()),
        (NULL, 3, 82, 1, NOW(), NOW()),
        (NULL, 3, 83, 1, NOW(), NOW()),
        (NULL, 3, 84, 1, NOW(), NOW()),
        (NULL, 3, 85, 1, NOW(), NOW()),
        (NULL, 3, 86, 1, NOW(), NOW()),
        (NULL, 3, 87, 1, NOW(), NOW()),
        (NULL, 3, 88, 1, NOW(), NOW()),
        (NULL, 3, 89, 1, NOW(), NOW()),
        (NULL, 3, 90, 1, NOW(), NOW()),
        (NULL, 3, 91, 1, NOW(), NOW()),
        (NULL, 3, 92, 1, NOW(), NOW()),
        (NULL, 3, 93, 1, NOW(), NOW()),
        (NULL, 3, 94, 1, NOW(), NOW()),
        (NULL, 3, 95, 1, NOW(), NOW()),
        (NULL, 3, 96, 1, NOW(), NOW()),
        (NULL, 3, 97, 1, NOW(), NOW()),
        (NULL, 3, 98, 1, NOW(), NOW()),
        (NULL, 3, 99, 1, NOW(), NOW()),
        (NULL, 3, 100, 1, NOW(), NOW()),
        (NULL, 3, 101, 1, NOW(), NOW()),
        (NULL, 3, 102, 1, NOW(), NOW()),
        (NULL, 3, 103, 1, NOW(), NOW()),
        (NULL, 3, 104, 1, NOW(), NOW()),
        (NULL, 3, 105, 1, NOW(), NOW()),
        (NULL, 3, 106, 1, NOW(), NOW()),
        (NULL, 3, 107, 1, NOW(), NOW()),
        (NULL, 3, 108, 1, NOW(), NOW()),
        (NULL, 3, 109, 1, NOW(), NOW()),
        (NULL, 3, 110, 1, NOW(), NOW()),
        (NULL, 3, 111, 1, NOW(), NOW()),
        (NULL, 3, 112, 1, NOW(), NOW()),
        (NULL, 3, 113, 1, NOW(), NOW()),
        (NULL, 3, 114, 1, NOW(), NOW()),
        (NULL, 3, 115, 1, NOW(), NOW()),
        (NULL, 3, 116, 1, NOW(), NOW()),
        (NULL, 3, 117, 1, NOW(), NOW()),
        (NULL, 3, 118, 1, NOW(), NOW()),
        (NULL, 3, 119, 1, NOW(), NOW()),
        (NULL, 3, 120, 1, NOW(), NOW()),
        (NULL, 3, 121, 1, NOW(), NOW()),
        (NULL, 3, 122, 1, NOW(), NOW()),
        (NULL, 3, 123, 1, NOW(), NOW()),
        (NULL, 3, 124, 1, NOW(), NOW()),
        (NULL, 3, 125, 1, NOW(), NOW()),
        (NULL, 3, 126, 1, NOW(), NOW()),
        (NULL, 3, 127, 1, NOW(), NOW()),
        (NULL, 3, 128, 1, NOW(), NOW()),
        (NULL, 3, 129, 1, NOW(), NOW()),
        (NULL, 3, 130, 1, NOW(), NOW()),
        (NULL, 3, 131, 1, NOW(), NOW()),
        (NULL, 3, 132, 1, NOW(), NOW()),
        (NULL, 3, 133, 1, NOW(), NOW()),
        (NULL, 3, 134, 1, NOW(), NOW()),
        (NULL, 3, 135, 1, NOW(), NOW()),
        (NULL, 3, 136, 1, NOW(), NOW()),
        (NULL, 3, 137, 1, NOW(), NOW()),
        (NULL, 3, 138, 1, NOW(), NOW()),
        (NULL, 3, 139, 1, NOW(), NOW()),
        (NULL, 3, 140, 1, NOW(), NOW()),
        (NULL, 3, 141, 1, NOW(), NOW()),
        (NULL, 3, 142, 1, NOW(), NOW()),
        (NULL, 3, 143, 1, NOW(), NOW()),
        (NULL, 3, 144, 1, NOW(), NOW()),
        (NULL, 3, 145, 1, NOW(), NOW()),
        (NULL, 3, 146, 1, NOW(), NOW()),
        (NULL, 3, 147, 1, NOW(), NOW()),
        (NULL, 3, 148, 1, NOW(), NOW()),
        (NULL, 3, 149, 1, NOW(), NOW()),
        (NULL, 3, 150, 1, NOW(), NOW()),
        (NULL, 3, 151, 1, NOW(), NOW()),
        (NULL, 3, 152, 1, NOW(), NOW()),
        (NULL, 3, 153, 1, NOW(), NOW()),
        (NULL, 3, 154, 1, NOW(), NOW()),
        (NULL, 3, 155, 1, NOW(), NOW()),
        (NULL, 3, 156, 1, NOW(), NOW()),
        (NULL, 3, 157, 1, NOW(), NOW()),
        (NULL, 3, 158, 1, NOW(), NOW()),
        (NULL, 3, 159, 1, NOW(), NOW()),
        (NULL, 3, 160, 1, NOW(), NOW()),
        (NULL, 3, 161, 1, NOW(), NOW()),
        (NULL, 3, 162, 1, NOW(), NOW()),
        (NULL, 3, 163, 1, NOW(), NOW()),
        (NULL, 3, 164, 1, NOW(), NOW()),
        (NULL, 3, 165, 1, NOW(), NOW()),
        (NULL, 3, 166, 1, NOW(), NOW()),
        (NULL, 3, 167, 1, NOW(), NOW()),
        (NULL, 3, 168, 1, NOW(), NOW()),
        (NULL, 3, 169, 1, NOW(), NOW()),
        (NULL, 3, 170, 1, NOW(), NOW()),
        (NULL, 3, 171, 1, NOW(), NOW()),
        (NULL, 3, 172, 1, NOW(), NOW()),
        (NULL, 3, 173, 1, NOW(), NOW()),
        (NULL, 3, 174, 1, NOW(), NOW()),
        (NULL, 3, 175, 1, NOW(), NOW()),
        (NULL, 3, 176, 1, NOW(), NOW()),
        (NULL, 3, 177, 1, NOW(), NOW()),
        (NULL, 3, 178, 1, NOW(), NOW()),
        (NULL, 3, 179, 1, NOW(), NOW()),
        (NULL, 3, 180, 1, NOW(), NOW()),
        (NULL, 3, 181, 1, NOW(), NOW()),
        (NULL, 3, 182, 1, NOW(), NOW()),
        (NULL, 3, 183, 1, NOW(), NOW()),
        (NULL, 3, 184, 1, NOW(), NOW()),
        (NULL, 3, 185, 1, NOW(), NOW()),
        (NULL, 3, 186, 1, NOW(), NOW()),
        (NULL, 3, 187, 1, NOW(), NOW()),
        (NULL, 3, 188, 1, NOW(), NOW()),
        (NULL, 3, 189, 1, NOW(), NOW()),
        (NULL, 3, 190, 1, NOW(), NOW()),
        (NULL, 3, 191, 1, NOW(), NOW()),
        (NULL, 3, 192, 1, NOW(), NOW()),
        (NULL, 3, 193, 1, NOW(), NOW()),
        (NULL, 3, 194, 1, NOW(), NOW()),
        (NULL, 3, 195, 1, NOW(), NOW()),
        (NULL, 3, 196, 1, NOW(), NOW()),
        (NULL, 3, 197, 1, NOW(), NOW()),
        (NULL, 3, 198, 1, NOW(), NOW()),
        (NULL, 3, 199, 1, NOW(), NOW()),
        (NULL, 3, 200, 1, NOW(), NOW()),
        (NULL, 3, 201, 1, NOW(), NOW()),
        (NULL, 3, 202, 1, NOW(), NOW()),
        (NULL, 3, 203, 1, NOW(), NOW()),
        (NULL, 3, 204, 1, NOW(), NOW()),
        (NULL, 3, 205, 1, NOW(), NOW()),
        (NULL, 3, 206, 1, NOW(), NOW()),
        (NULL, 3, 207, 1, NOW(), NOW()),
        (NULL, 3, 208, 1, NOW(), NOW()),
        (NULL, 3, 209, 1, NOW(), NOW()),
        (NULL, 3, 210, 1, NOW(), NOW()),
        (NULL, 3, 211, 1, NOW(), NOW()),
        (NULL, 3, 212, 1, NOW(), NOW()),
        (NULL, 5, 1, 1, NOW(), NOW()),
        (NULL, 5, 2, 1, NOW(), NOW()),
        (NULL, 5, 9, 1, NOW(), NOW()),
        (NULL, 5, 34, 1, NOW(), NOW()),
        (NULL, 5, 35, 1, NOW(), NOW()),
        (NULL, 5, 36, 1, NOW(), NOW()),
        (NULL, 5, 37, 1, NOW(), NOW()),
        (NULL, 5, 76, 1, NOW(), NOW()),
        (NULL, 5, 77, 1, NOW(), NOW()),
        (NULL, 5, 78, 1, NOW(), NOW()),
        (NULL, 5, 79, 1, NOW(), NOW()),
        (NULL, 5, 80, 1, NOW(), NOW()),
        (NULL, 5, 81, 1, NOW(), NOW()),
        (NULL, 5, 82, 1, NOW(), NOW()),
        (NULL, 5, 91, 1, NOW(), NOW()),
        (NULL, 5, 95, 1, NOW(), NOW()),
        (NULL, 5, 96, 1, NOW(), NOW()),
        (NULL, 5, 97, 1, NOW(), NOW()),
        (NULL, 5, 98, 1, NOW(), NOW()),
        (NULL, 5, 118, 1, NOW(), NOW()),
        (NULL, 5, 119, 1, NOW(), NOW()),
        (NULL, 5, 123, 1, NOW(), NOW()),
        (NULL, 5, 167, 1, NOW(), NOW()),
        (NULL, 5, 174, 1, NOW(), NOW()),
        (NULL, 5, 187, 1, NOW(), NOW()),
        (NULL, 5, 188, 1, NOW(), NOW()),
        (NULL, 5, 189, 1, NOW(), NOW()),
        (NULL, 5, 190, 1, NOW(), NOW()),
        (NULL, 5, 191, 1, NOW(), NOW()),
        (NULL, 5, 192, 1, NOW(), NOW()),
        (NULL, 5, 193, 1, NOW(), NOW()),
        (NULL, 5, 194, 1, NOW(), NOW()),
        (NULL, 5, 195, 1, NOW(), NOW()),
        (NULL, 5, 196, 1, NOW(), NOW()),
        (NULL, 5, 197, 1, NOW(), NOW()),
        (NULL, 5, 205, 1, NOW(), NOW()),
        (NULL, 5, 206, 1, NOW(), NOW())");

        DB::table("user_stores")->insert([
            ['user_id' => $manager_user_id,'store_id' => $store_1,'created_by' => '1','created_at' => NOW(),'updated_at' => NOW()],
            ['user_id' => $manager_user_id,'store_id' => $store_2,'created_by' => '1','created_at' => NOW(),'updated_at' => NOW()],
            ['user_id' => $manager_user_id,'store_id' => $store_3,'created_by' => '1','created_at' => NOW(),'updated_at' => NOW()],
            ['user_id' => $manager_user_id,'store_id' => $store_4,'created_by' => '1','created_at' => NOW(),'updated_at' => NOW()],
            ['user_id' => $manager_user_id,'store_id' => $store_5,'created_by' => '1','created_at' => NOW(),'updated_at' => NOW()],

            ['user_id' => $accounts_manager_user_id,'store_id' => $store_1,'created_by' => '1','created_at' => NOW(),'updated_at' => NOW()],
            ['user_id' => $accounts_manager_user_id,'store_id' => $store_2,'created_by' => '1','created_at' => NOW(),'updated_at' => NOW()],
            ['user_id' => $accounts_manager_user_id,'store_id' => $store_3,'created_by' => '1','created_at' => NOW(),'updated_at' => NOW()],
            ['user_id' => $accounts_manager_user_id,'store_id' => $store_4,'created_by' => '1','created_at' => NOW(),'updated_at' => NOW()],
            ['user_id' => $accounts_manager_user_id,'store_id' => $store_5,'created_by' => '1','created_at' => NOW(),'updated_at' => NOW()],
            
            ['user_id' => $cashier_user_id,'store_id' => $store_1,'created_by' => '1','created_at' => NOW(),'updated_at' => NOW()],
            ['user_id' => $cashier_user_id,'store_id' => $store_2,'created_by' => '1','created_at' => NOW(),'updated_at' => NOW()],
            ['user_id' => $cashier_user_id,'store_id' => $store_3,'created_by' => '1','created_at' => NOW(),'updated_at' => NOW()],

            ['user_id' => $waiter_user_id_1,'store_id' => $store_1,'created_by' => '1','created_at' => NOW(),'updated_at' => NOW()],
            ['user_id' => $waiter_user_id_1,'store_id' => $store_2,'created_by' => '1','created_at' => NOW(),'updated_at' => NOW()],
            ['user_id' => $waiter_user_id_1,'store_id' => $store_3,'created_by' => '1','created_at' => NOW(),'updated_at' => NOW()],
            ['user_id' => $waiter_user_id_1,'store_id' => $store_4,'created_by' => '1','created_at' => NOW(),'updated_at' => NOW()],
            ['user_id' => $waiter_user_id_1,'store_id' => $store_5,'created_by' => '1','created_at' => NOW(),'updated_at' => NOW()],

            ['user_id' => $waiter_user_id_2,'store_id' => $store_1,'created_by' => '1','created_at' => NOW(),'updated_at' => NOW()],
            ['user_id' => $waiter_user_id_2,'store_id' => $store_2,'created_by' => '1','created_at' => NOW(),'updated_at' => NOW()],
            ['user_id' => $waiter_user_id_2,'store_id' => $store_3,'created_by' => '1','created_at' => NOW(),'updated_at' => NOW()],
            ['user_id' => $waiter_user_id_2,'store_id' => $store_4,'created_by' => '1','created_at' => NOW(),'updated_at' => NOW()],
            ['user_id' => $waiter_user_id_2,'store_id' => $store_5,'created_by' => '1','created_at' => NOW(),'updated_at' => NOW()],

            ['user_id' => $waiter_user_id_3,'store_id' => $store_1,'created_by' => '1','created_at' => NOW(),'updated_at' => NOW()],
            ['user_id' => $waiter_user_id_3,'store_id' => $store_2,'created_by' => '1','created_at' => NOW(),'updated_at' => NOW()],
            ['user_id' => $waiter_user_id_3,'store_id' => $store_3,'created_by' => '1','created_at' => NOW(),'updated_at' => NOW()],
            ['user_id' => $waiter_user_id_3,'store_id' => $store_4,'created_by' => '1','created_at' => NOW(),'updated_at' => NOW()],
            ['user_id' => $waiter_user_id_3,'store_id' => $store_5,'created_by' => '1','created_at' => NOW(),'updated_at' => NOW()],

            ['user_id' => $chef_user_id,'store_id' => $store_1,'created_by' => '1','created_at' => NOW(),'updated_at' => NOW()],
            ['user_id' => $chef_user_id,'store_id' => $store_2,'created_by' => '1','created_at' => NOW(),'updated_at' => NOW()],
        ]);

        DB::insert("INSERT INTO `discount_codes` VALUES
        (NULL, 'BJG7srxA6sntdyRZlSuAYEhln', 1, 'Discount 5%', 'DISCOUNT5', '5.00', '', 1, 1, NULL, '2020-03-10 11:02:14', '2020-03-10 11:02:14'),
        (NULL, 'iIHzNpSGsBJG0NJfNE1lAGXcz', 2, 'Discount 5%', 'DISCOUNT5', '5.00', '', 1, 1, NULL, '2020-03-10 11:02:14', '2020-03-10 11:02:14'),
        (NULL, 'BJG7srxA6sntdyRZlSuAYE2E3', 3, 'Discount 5%', 'DISCOUNT5', '5.00', '', 1, 1, NULL, '2020-03-10 11:02:14', '2020-03-10 11:02:14'),
        (NULL, 'iIHzNpSGsBJG0NJfNE1lAGiUY', 4, 'Discount 5%', 'DISCOUNT5', '5.00', '', 1, 1, NULL, '2020-03-10 11:02:14', '2020-03-10 11:02:14'),
        (NULL, 'iIHzNpSGsBJG0NJfNE1lAGiVC', 5, 'Discount 5%', 'DISCOUNT5', '5.00', '', 1, 1, NULL, '2020-03-10 11:02:14', '2020-03-10 11:02:14')");

        DB::insert("INSERT INTO `tax_codes` VALUES
        (NULL, 'bZHz4YfWmYRpozFqRdhiiSAko', 1, 'EXCLUSIVE', 'Tax 7.5%', 'TAX75', '7.50', '', 1, 1, NULL, '2020-03-10 11:02:14', '2020-03-10 11:02:14'),
        (NULL, 'ul9fONoVjmBJWcBGEv7RVTsO0', 2, 'EXCLUSIVE', 'GST Tax', 'GST', '7.00', NULL, 1, 1, 1, '2020-03-10 11:02:14', '2020-03-10 11:04:12'),
        (NULL, 'yaXOLmFhzCUetYRwDtuuK8O8B', 3, 'EXCLUSIVE', 'Tax', 'TAX', '6.50', NULL, 1, 1, NULL, '2020-03-10 11:07:11', '2020-03-10 11:07:11'),
        (NULL, 'JUd4U9ddHa6kAB3d7wDVSoWAA', 4, 'EXCLUSIVE', 'Tax', 'TAX', '5.50', NULL, 1, 1, NULL, '2020-03-10 11:07:40', '2020-03-10 11:07:40'),
        (NULL, 'onyZTAozLdZmzhJcRv9BB1cxq', 5, 'EXCLUSIVE', 'Tax', 'TAX', '10.00', NULL, 1, 1, NULL, '2020-03-10 11:08:13', '2020-03-10 11:08:13'),
        (NULL, 'ontZTAozLdZmzhJcRv9BB1cxr', 1, 'EXCLUSIVE', 'Tax 0', 'TAX0', '0', NULL, 1, 1, NULL, '2020-03-10 11:08:13', '2020-03-10 11:08:13'),
        (NULL, 'ontZTAozLdZmzhJcRv9BB1cxw', 2, 'EXCLUSIVE', 'Tax 0', 'TAX0', '0', NULL, 1, 1, NULL, '2020-03-10 11:08:13', '2020-03-10 11:08:13'),
        (NULL, 'ontZT3ozLdZmzhJcRv9BB1cxq', 3, 'EXCLUSIVE', 'Tax 0', 'TAX0', '0', NULL, 1, 1, NULL, '2020-03-10 11:08:13', '2020-03-10 11:08:13'),
        (NULL, 'ontZT2ozLdZmzhJcRv9BB1cxy', 4, 'EXCLUSIVE', 'Tax 0', 'TAX0', '0', NULL, 1, 1, NULL, '2020-03-10 11:08:13', '2020-03-10 11:08:13'),
        (NULL, 'ontZT1ozLdZmzhJcRv9BB1cxn', 5, 'EXCLUSIVE', 'Tax 0', 'TAX0', '0', NULL, 1, 1, NULL, '2020-03-10 11:08:13', '2020-03-10 11:08:13')");
        

        DB::insert("INSERT INTO `tax_code_type` VALUES
        (NULL, 1, 'GST', '7.50', 1, '2020-03-10 11:02:14', NULL),
        (NULL, 2, 'CGST', '3.50', 1, '2020-03-10 11:04:12', '2020-03-10 11:04:12'),
        (NULL, 2, 'SGST', '3.50', 1, '2020-03-10 11:04:12', '2020-03-10 11:04:12'),
        (NULL, 3, 'TAX', '6.50', 1, '2020-03-10 11:07:11', '2020-03-10 11:07:11'),
        (NULL, 4, 'TAX', '5.50', 1, '2020-03-10 11:07:40', '2020-03-10 11:07:40'),
        (NULL, 5, 'TAX', '10.00', 1, '2020-03-10 11:08:13', '2020-03-10 11:08:13'),
        (NULL, 6, 'TAX', '0', 1, '2020-03-10 11:02:14', '2020-03-10 11:02:14'),
        (NULL, 7, 'TAX', '0', 2, '2020-03-10 11:02:14', '2020-03-10 11:02:14'),
        (NULL, 8, 'TAX', '0', 3, '2020-03-10 11:02:14', '2020-03-10 11:02:14'),
        (NULL, 9, 'TAX', '0', 4, '2020-03-10 11:02:14', '2020-03-10 11:02:14'),
        (NULL, 10, 'TAX', '0', 5, '2020-03-10 11:02:14', '2020-03-10 11:02:14')");

        
        DB::table("payment_methods")->insert([
            "slack" => $base_controller->generate_slack("payment_methods"),
            "label" => Str::title("Cash"),
            "description" => "Cash Payment",
            "status" => 1,
            "created_at" => NOW(),
            "updated_at" => NOW(),
            "created_by" => 1
        ]);

        DB::table("payment_methods")->insert([
            "slack" => $base_controller->generate_slack("payment_methods"),
            "label" => Str::title("Card"),
            "description" => "Card Payment",
            "status" => 1,
            "created_at" => NOW(),
            "updated_at" => NOW(),
            "created_by" => 1
        ]);

        for ($i = 0; $i < 100; $i++) {
            $firstname = $faker->firstName;
            $lastname = $faker->lastName;
            DB::table('customers')->insert([
                'slack' => $base_controller->generate_slack("customers"),
                'customer_type' => 'CUSTOM',
                'name' => $firstname ." ".$lastname,
                'email' => $faker->unique()->email,
                'phone' => $faker->e164PhoneNumber,
                'address' => $faker->address,
                'status' => 1,
                'created_by' => 1,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ]);
        }

        $active_stores = StoreModel::select('id')
        ->active()
        ->get();

        if(count($active_stores)>0){
            foreach ($active_stores as $active_store) {

                $account_exists = AccountModel::select('id')
                ->where('store_id', '=', trim($active_store->id))
                ->first();
                if (empty($account_exists)) {
                    
                    $account = [
                        "slack" => $base_controller->generate_slack("accounts"),
                        "store_id" => $active_store->id,
                        "account_code" => Str::random(6),
                        "account_type" => 1,
                        "label" => 'Default Sales Account',
                        "description" => 'Default Sales Account',
                        "initial_balance" => 0,
                        "pos_default" => 1,
                        "status" => 1,
                        "created_by" => 1
                    ];
                    
                    $account_id = AccountModel::create($account)->id;
                    
                    $code_start_config = Config::get('constants.unique_code_start.account');
                    $code_start = (isset($code_start_config))?$code_start_config:100;
                    
                    $account_code = [
                        "account_code" => ($code_start+$account_id)
                    ];

                    AccountModel::withoutGlobalScopes()->where('id', $account_id)
                    ->update($account_code);
                }

                $supplier = [
                    "slack" => $base_controller->generate_slack("suppliers"),
                    "store_id" => $active_store->id,
                    "supplier_code" => Str::random(6),
                    "name" => "Food Mart Co. Ltd.",
                    "address" => $faker->address,
                    "phone" => $faker->e164PhoneNumber,
                    "email" => $faker->unique()->email,
                    "pincode" => '11111',
                    "status" => 1,
                    "created_by" => 1
                ];
                
                $supplier_id = SupplierModel::create($supplier)->id;
    
                $code_start_config = Config::get('constants.unique_code_start.supplier');
                $code_start = (isset($code_start_config))?$code_start_config:100;
                
                $supplier_code = [
                    "supplier_code" => "SUP".($code_start+$supplier_id)
                ];
                SupplierModel::withoutGlobalScopes()->where('id', $supplier_id)
                ->update($supplier_code);
                
                for($j = 0; $j <= 25; $j++){
                    $supplier = [
                        "slack" => $base_controller->generate_slack("suppliers"),
                        "store_id" => $active_store->id,
                        "supplier_code" => Str::random(6),
                        "name" => $faker->catchPhrase,
                        "address" => $faker->address,
                        "phone" => $faker->e164PhoneNumber,
                        "email" => $faker->unique()->email,
                        "pincode" => '11111',
                        "status" => 1,
                        "created_by" => 1
                    ];
                    
                    $supplier_id = SupplierModel::create($supplier)->id;
        
                    $code_start_config = Config::get('constants.unique_code_start.supplier');
                    $code_start = (isset($code_start_config))?$code_start_config:100;
                    
                    $supplier_code = [
                        "supplier_code" => "SUP".($code_start+$supplier_id)
                    ];
                    SupplierModel::withoutGlobalScopes()->where('id', $supplier_id)
                    ->update($supplier_code);
                }

                $target_month = date("Y-01-01");

                for($k = 0; $k < 12; $k++){
                    $target = [
                        "slack" => $base_controller->generate_slack("targets"),
                        "store_id" => $active_store->id,
                        "month" => $target_month,
                        "income" => 99999,
                        "expense" => 99999,
                        "sales" => 99999,
                        "net_profit" => 99999,
                        "created_by" => 1
                    ];
                    
                    $target_id = TargetModel::create($target)->id;

                    $target_month = new Carbon($target_month);
                    $target_month->addMonths(1);
                    $target_month = date("Y-m-d", strtotime($target_month));
                    
                }

                $variant_option = [
                    "slack" => $base_controller->generate_slack("variant_options"),
                    "store_id" => $active_store->id,
                    "variant_option_code" => Str::random(6),
                    "label" => 'Size',
                    "status" => 1,
                    "created_by" => 1
                ];
                
                $variant_option_id = VariantOptionModel::withoutGlobalScopes()->create($variant_option)->id;
                
                $code_start_config = Config::get('constants.unique_code_start.variant_option');
                $code_start = (isset($code_start_config))?$code_start_config:100;
                
                $variant_option_code = [
                    "variant_option_code" => 'VO'.($code_start+$variant_option_id)
                ];
                VariantOptionModel::where('id', $variant_option_id)
                ->update($variant_option_code);

                $categories = [
                    "Veg Pizzas" => [
                        "display_on_pos_screen" => 1,
                        "display_on_qr_menu" => 1,
                        "items" => [
                            [
                                "item" => "Margherita - Regular",
                                "price" => 6.00,
                                "variants" => [
                                    [
                                        "item" => "Margherita - Medium",
                                        "price" => 8.00,
                                    ],
                                    [
                                        "item" => "Margherita - Large",
                                        "price" => 10.00,
                                    ],
                                ]
                            ],
                            [
                                "item" => "Double Cheese Margherita - Regular",
                                "price" => 10.00,
                                "variants" => [
                                    [
                                        "item" => "Double Cheese Margherita - Medium",
                                        "price" => 12.00,
                                    ],
                                    [
                                        "item" => "Double Cheese Margherita - Large",
                                        "price" => 14.00,
                                    ],
                                ]
                            ],
                            [
                                "item" => "Farm House - Regular",
                                "price" => 12.00,
                                "variants" => [
                                    [
                                        "item" => "Farm House - Medium",
                                        "price" => 13.00,
                                    ],
                                    [
                                        "item" => "Farm House - Large",
                                        "price" => 14.00,
                                    ],
                                ]
                            ],
                            [
                                "item" => "Peppy Paneer - Regular",
                                "price" => 8.25,
                                "variants" => [
                                    [
                                        "item" => "Peppy Paneer - Medium",
                                        "price" => 9.00,
                                    ],
                                    [
                                        "item" => "Peppy Paneer - Large",
                                        "price" => 10.00,
                                    ],
                                ]
                            ],
                            [
                                "item" => "Mexican Green Wave - Regular",
                                "price" => 14.00,
                                "variants" => [
                                    [
                                        "item" => "Mexican Green Wave - Medium",
                                        "price" => 15.00,
                                    ],
                                    [
                                        "item" => "Mexican Green Wave - Large",
                                        "price" => 16.00,
                                    ],
                                ]
                            ],
                            [
                                "item" => "Deluxe Veggie - Regular",
                                "price" => 8.00,
                                "variants" => [
                                    [
                                        "item" => "Deluxe Veggie - Medium",
                                        "price" => 9.00,
                                    ],
                                    [
                                        "item" => "Deluxe Veggie - Large",
                                        "price" => 10.00,
                                    ],
                                ]
                            ],
                            [
                                "item" => "Veg Extravaganza - Regular",
                                "price" => 6.00,
                                "variants" => [
                                    [
                                        "item" => "Veg Extravaganza - Medium",
                                        "price" => 8.00,
                                    ],
                                    [
                                        "item" => "Veg Extravaganza - Large",
                                        "price" => 10.00,
                                    ],
                                ]
                            ],
                            [
                                "item" => "Cheese N Corn - Regular",
                                "price" => 6.00,
                                "variants" => [
                                    [
                                        "item" => "Cheese N Corn - Medium",
                                        "price" => 8.00,
                                    ],
                                    [
                                        "item" => "Cheese N Corn - Large",
                                        "price" => 10.00,
                                    ],
                                ]
                            ],
                            [
                                "item" => "Veggie Paradise - Regular",
                                "price" => 8.50,
                                "variants" => [
                                    [
                                        "item" => "Veggie Paradise - Medium",
                                        "price" => 9.00,
                                    ],
                                    [
                                        "item" => "Veggie Paradise - Large",
                                        "price" => 10.00,
                                    ],
                                ]
                            ],
                            [
                                "item" => "Fresh Veggie - Regular",
                                "price" => 6.50,
                                "variants" => [
                                    [
                                        "item" => "Fresh Veggie - Medium",
                                        "price" => 8.00,
                                    ],
                                    [
                                        "item" => "Fresh Veggie - Large",
                                        "price" => 10.00,
                                    ],
                                ]
                            ],
                            [
                                "item" => "Indi Tandoori Paneer - Regular",
                                "price" => 7.00,
                                "variants" => [
                                    [
                                        "item" => "Indi Tandoori Paneer - Medium",
                                        "price" => 8.00,
                                    ],
                                    [
                                        "item" => "Indi Tandoori Paneer - Large",
                                        "price" => 10.00,
                                    ],
                                ]
                            ],
                        ]
                    ],
                    "Non Veg Pizzas" => [
                        "display_on_pos_screen" => 1,
                        "display_on_qr_menu" => 1,
                        "items" => [
                            [
                                "item" => "Pepper Barbecue Chicken - Regular",
                                "price" => 12.00,
                                "variants" => [
                                    [
                                        "item" => "Pepper Barbecue Chicken - Medium",
                                        "price" => 8.00,
                                    ],
                                    [
                                        "item" => "Pepper Barbecue Chicken - Large",
                                        "price" => 10.00,
                                    ],
                                ]
                            ],
                            [
                                "item" => "Chicken Sausage",
                                "price" => 14.25,
                                "variants" => [
                                    [
                                        "item" => "Chicken Sausage - Medium",
                                        "price" => 15.00,
                                    ],
                                    [
                                        "item" => "Chicken Sausage - Large",
                                        "price" => 16.00,
                                    ],
                                ]
                            ],
                            [
                                "item" => "Chicken Golden Delight",
                                "price" => 10.50,
                                "variants" => [
                                    [
                                        "item" => "Chicken Golden Delight - Medium",
                                        "price" => 11.00,
                                    ],
                                    [
                                        "item" => "Chicken Golden Delight - Large",
                                        "price" => 12.00,
                                    ],
                                ]
                            ],
                            [
                                "item" => "Non Veg Supreme",
                                "price" => 16.60,
                                "variants" => [
                                    [
                                        "item" => "Non Veg Supreme - Medium",
                                        "price" => 18.00,
                                    ],
                                    [
                                        "item" => "Non Veg Supreme - Large",
                                        "price" => 19.00,
                                    ],
                                ]
                            ],
                            [
                                "item" => "Chicken Dominator",
                                "price" => 11.00,
                                "variants" => [
                                    [
                                        "item" => "Chicken Dominator - Medium",
                                        "price" => 12.00,
                                    ],
                                    [
                                        "item" => "Chicken Dominator - Large",
                                        "price" => 14.00,
                                    ],
                                ]
                            ],
                            [
                                "item" => "Pepper Barbecue & Onion",
                                "price" => 18.00,
                                "variants" => [
                                    [
                                        "item" => "Pepper Barbecue & Onion - Medium",
                                        "price" => 19.00,
                                    ],
                                    [
                                        "item" => "Pepper Barbecue & Onion - Large",
                                        "price" => 21.00,
                                    ],
                                ]
                            ],
                            [
                                "item" => "Chicken Fiesta",
                                "price" => 19.00,
                                "variants" => [
                                    [
                                        "item" => "Chicken Fiesta - Medium",
                                        "price" => 21.00,
                                    ],
                                    [
                                        "item" => "Chicken Fiesta - Large",
                                        "price" => 22.00,
                                    ],
                                ]
                            ],
                            [
                                "item" => "Indi Chicken Tikka",
                                "price" => 20.00,
                                "variants" => [
                                    [
                                        "item" => "Indi Chicken Tikka - Medium",
                                        "price" => 21.00,
                                    ],
                                    [
                                        "item" => "Indi Chicken Tikka - Large",
                                        "price" => 22.00,
                                    ],
                                ]
                            ]
                        ]
                    ],
                    "Burger Pizza" => [
                        "display_on_pos_screen" => 1,
                        "display_on_qr_menu" => 1,
                        "items" => [
                            [
                                "item" => "Burger Pizza - Classic Veg",
                                "price" => 8.00
                            ],
                            [
                                "item" => "Burger Pizza - Premium Veg",
                                "price" => 9.00
                            ],
                            [
                                "item" => "Burger Pizza - Classic Non Veg",
                                "price" => 11.00
                            ],
                        ]
                    ],
                    "Side Orders" => [
                        "display_on_pos_screen" => 1,
                        "display_on_qr_menu" => 1,
                        "items" => [
                            [
                                "item" => "Garlic Breadsticks",
                                "price" => 2.00
                            ],
                            [
                                "item" => "Stuffed Garlic Bread",
                                "price" => 3.00
                            ],
                        ]
                    ],
                    "Beverages" => [
                        "display_on_pos_screen" => 1,
                        "display_on_qr_menu" => 1,
                        "items" => [
                            [
                                "item" => "Lipton Ice Tea",
                                "price" => 4.00
                            ],
                            [
                                "item" => "Pepsi",
                                "price" => 5.00
                            ],
                            [
                                "item" => "Sprite",
                                "price" => 6.00
                            ],
                            [
                                "item" => "Coca Cola",
                                "price" => 6.50
                            ],
                        ]
                    ],
                    "Pasta" => [
                        "display_on_pos_screen" => 1,
                        "display_on_qr_menu" => 1,
                        "items" => [
                            [
                                "item" => "Veg Pasta Italiano White",
                                "price" => 6.00
                            ],
                            [
                                "item" => "Tikka Masala Pasta Veg",
                                "price" => 5.50
                            ],
                            [
                                "item" => "Cheesy Jalapeno Pasta Veg",
                                "price" => 4.50
                            ],
                        ]
                    ],
                    "Chicken" => [
                        "display_on_pos_screen" => 1,
                        "display_on_qr_menu" => 1,
                        "items" => [
                            [
                                "item" => "Roasted Chicken Wings Peri-Peri",
                                "price" => 18.00
                            ],
                            [
                                "item" => "Roasted Chicken Wings Classic Hot Sauce",
                                "price" => 16.00
                            ],
                            [
                                "item" => "Chicken Meatballs Peri-Peri",
                                "price" => 15.50
                            ],
                            [
                                "item" => "Boneless Chicken Wings Peri-Peri",
                                "price" => 16.00
                            ],
                        ]
                    ],
                    "Ingredients" => [
                        "display_on_pos_screen" => 0,
                        "display_on_qr_menu" => 0,
                        "items" => [
                            [
                                "item" => "Cheese",
                                "price" => 2
                            ],
                            [
                                "item" => "Golden Corn",
                                "price" => 1
                            ],
                            [
                                "item" => "Paneer",
                                "price" => 1
                            ],
                            [
                                "item" => "Capsicum",
                                "price" => 1
                            ],
                            [
                                "item" => "Chicken",
                                "price" => 3
                            ],
                            [
                                "item" => "Goldern Corn",
                                "price" => 2
                            ],
                            [
                                "item" => "Black Olives",
                                "price" => 0.5
                            ],
                            [
                                "item" => "Capsicum",
                                "price" => 0.5
                            ],
                            [
                                "item" => "Lemon",
                                "price" => 0.5
                            ],
                            [
                                "item" => "Sugar",
                                "price" => 0.5
                            ],
                            [
                                "item" => "Red Paprika",
                                "price" => 0.5
                            ]
                        ]
                    ],
                    "Add-ons" => [
                        "display_on_pos_screen" => 1,
                        "display_on_qr_menu" => 0,
                        "items" => [
                            [
                                "item" => "Regular Bun",
                                "price" => 3.05,
                                "addon" => 1
                            ],
                            [
                                "item" => "Whole Wheat Bun",
                                "price" => 3.25,
                                "addon" => 1
                            ],
                            [
                                "item" => "Regular Fries",
                                "price" => 2.05,
                                "addon" => 1
                            ],
                            [
                                "item" => "Cheese Slice",
                                "price" => 3.45,
                                "addon" => 1
                            ],
                            [
                                "item" => "Ketchup",
                                "price" => 5.05,
                                "addon" => 1
                            ],
                            [
                                "item" => "Coke",
                                "price" => 5.00,
                                "addon" => 1
                            ],
                            [
                                "item" => "Latte",
                                "price" => 6.00,
                                "addon" => 1
                            ],
                            [
                                "item" => "Cappuccino",
                                "price" => 5.50,
                                "addon" => 1
                            ],
                            [
                                "item" => "Sweet Potato Fries",
                                "price" => 1.50,
                                "addon" => 1
                            ],
                            [
                                "item" => "Lettuce",
                                "price" => 2.50,
                                "addon" => 1
                            ],
                            [
                                "item" => "Pickles",
                                "price" => 3.50,
                                "addon" => 1
                            ],
                            [
                                "item" => "Extra Cheese",
                                "price" => 3.50,
                                "addon" => 1
                            ],
                            [
                                "item" => "Jam",
                                "price" => 0.50,
                                "addon" => 1
                            ],
                            [
                                "item" => "Cheese",
                                "price" => 1.50,
                                "addon" => 1
                            ],
                        ]
                    ]
                ];
                
                foreach($categories as $category_key => $category_item){
                    $category = [
                        "slack" => $base_controller->generate_slack("category"),
                        "store_id" => $active_store->id,
                        "category_code" => Str::random(6),
                        "label" => $category_key,
                        "description" => 'Category added for Demo website',
                        "display_on_pos_screen" => isset($category_item['display_on_pos_screen'])?$category_item['display_on_pos_screen']:0,
                        "display_on_qr_menu" => isset($category_item['display_on_qr_menu'])?$category_item['display_on_qr_menu']:0,
                        "status" => 1,
                        "created_by" => 1
                    ];
                    
                    $category_id = CategoryModel::create($category)->id;
        
                    $code_start_config = Config::get('constants.unique_code_start.category');
                    $code_start = (isset($code_start_config))?$code_start_config:100;
                    
                    $category_code = [
                        "category_code" => "CAT".($code_start+$category_id)
                    ];
                    CategoryModel::withoutGlobalScopes()->where('id', $category_id)
                    ->update($category_code);

                    $supplier = SupplierModel::withoutGlobalScopes()->select("id")->where('store_id', $active_store->id)->first();
                    $taxcode = TaxcodeModel::withoutGlobalScopes()->select("id")->where('store_id', $active_store->id)->first();
                    $discountcode = DiscountcodeModel::withoutGlobalScopes()->select("id")->where('store_id', $active_store->id)->first();

                    $taxcode_zero = TaxcodeModel::withoutGlobalScopes()->select("id")->where([
                        ['store_id', '=', $active_store->id],
                        ['tax_code', '=', 'TAX0'],
                    ])->first();

                    foreach($category_item['items'] as $category_item_data){
                        $product = [
                            "slack" => $base_controller->generate_slack("products"),
                            "store_id" => $active_store->id,
                            "name" => ucwords($category_item_data['item']),
                            "product_code" => strtoupper(Str::random(4)),
                            "description" => '',
                            "category_id" => $category_id,
                            "supplier_id" => (isset($supplier))?$supplier->id:NULL,
                            "tax_code_id" => ($category['display_on_pos_screen'] == 0)?$taxcode_zero->id:((isset($taxcode))?$taxcode->id:NULL),
                            "discount_code_id" => (isset($discountcode))?$discountcode->id:NULL,
                            "quantity" => 999999,
                            "purchase_amount_excluding_tax" => abs($category_item_data['price']-1),
                            "sale_amount_excluding_tax" => $category_item_data['price'],
                            "is_ingredient" => ($category_key == 'Ingredients')?1:0,
                            "is_addon_product" => (isset($category_item_data['addon']) && $category_item_data['addon'] == 1)?1:0,
                            "status" => 1,
                            "created_by" => 1
                        ];
                        
                        $product_id = ProductModel::withoutGlobalScopes()->create($product)->id;

                        $product_image_array = [
                            "slack" => $base_controller->generate_slack("product_images"),
                            "product_id" => $product_id,
                            "filename" => 'placeholder_image.png',
                            "status" => 1,
                            "created_by" => 1
                        ];
                        
                        $product_image_id = ProductImagesModel::create($product_image_array)->id;

                        $product_api = new ProductAPI();
                        $product_variant_code = $product_api->generate_variant_code();

                        $variant_product_array = [
                            "slack"             => $base_controller->generate_slack("product_variants"),
                            "variant_code"      => $product_variant_code,
                            "product_id"        => $product_id,
                            "variant_option_id" => $variant_option_id,
                            "created_by"        => 1
                        ];

                        ProductVariantModel::withoutGlobalScopes()->create($variant_product_array);

                        if(isset($category_item_data['variants'])){
                            foreach($category_item_data['variants'] as $variant){
                                $product = [
                                    "slack" => $base_controller->generate_slack("products"),
                                    "store_id" => $active_store->id,
                                    "name" => ucwords($variant['item']),
                                    "product_code" => strtoupper(Str::random(4)),
                                    "description" => '',
                                    "category_id" => $category_id,
                                    "supplier_id" => (isset($supplier))?$supplier->id:NULL,
                                    "tax_code_id" => ($category_key == 'Ingredients')?$taxcode_zero->id:((isset($taxcode))?$taxcode->id:NULL),
                                    "discount_code_id" => (isset($discountcode))?$discountcode->id:NULL,
                                    "quantity" => 99999,
                                    "purchase_amount_excluding_tax" => abs($variant['price']-1),
                                    "sale_amount_excluding_tax" => $variant['price'],
                                    "is_ingredient" => ($category_key == 'Ingredients')?1:0,
                                    "is_addon_product" => (isset($category_item_data['addon']) && $category_item_data['addon'] == 1)?1:0,
                                    "status" => 1,
                                    "created_by" => 1
                                ];
                                
                                $product_id = ProductModel::withoutGlobalScopes()->create($product)->id;
        
                                $product_image_array = [
                                    "slack" => $base_controller->generate_slack("product_images"),
                                    "product_id" => $product_id,
                                    "filename" => 'placeholder_image.png',
                                    "status" => 1,
                                    "created_by" => 1
                                ];
                                
                                $product_image_id = ProductImagesModel::create($product_image_array)->id;

                                $variant_product_array = [
                                    "slack"             => $base_controller->generate_slack("product_variants"),
                                    "variant_code"      => $product_variant_code,
                                    "product_id"        => $product_id,
                                    "variant_option_id" => $variant_option_id,
                                    "created_by"        => 1
                                ];

                                ProductVariantModel::withoutGlobalScopes()->create($variant_product_array);   

                            }
                        }
                    }
                }

                $addon_group_array = [
                    'Extra Fillings', 'Extra Add-on', 'Choose Your Add-on'
                ];

                $addon_products = ProductModel::withoutGlobalScopes()->where('store_id', $active_store->id)->where('is_addon_product', 1)->pluck('id')->chunk(3);

                foreach($addon_group_array as $key => $addon_group_array_item){
                    $addon_group = [
                        "slack" => $base_controller->generate_slack("addon_groups"),
                        "store_id" => $active_store->id,
                        "addon_group_code" => strtoupper(Str::random(6)),
                        "label" => $addon_group_array_item,
                        "multiple_selection" => 1,
                        "status" => 1,
                        "created_by" => 1
                    ];
                    
                    $addon_group_id = AddonGroupModel::create($addon_group)->id;
        
                    $code_start_config = Config::get('constants.unique_code_start.addon_group');
                    $code_start = (isset($code_start_config))?$code_start_config:100;
                    
                    $addon_group_code = [
                        "addon_group_code" => 'AOG'.($code_start+$addon_group_id)
                    ];
                    AddonGroupModel::withoutGlobalScopes()->where('id', $addon_group_id)
                    ->update($addon_group_code);

                    $addon_product_data_array = [];
                    foreach($addon_products[$key] as $ckey => $addon_product_chunk){
                        $addon_product_data_array[] = [
                            "addon_group_id" => $addon_group_id,
                            "product_id" => $addon_product_chunk,
                            "created_by" => 1
                        ];
                    }

                    if(!empty($addon_product_data_array) && count($addon_product_data_array)>0){
                        foreach($addon_product_data_array as $addon_product_data_array_item){
                            AddonGroupProductModel::create($addon_product_data_array_item);
                        }
                    }
                }

                $addon_groups = AddonGroupModel::withoutGlobalScopes()->where('store_id', $active_store->id)->active()->get();

                $billing_products = ProductModel::withoutGlobalScopes()->where('store_id', $active_store->id)->mainProduct()->pluck('id');

                foreach($billing_products as $billing_product_item){

                    $product_addon_group_array = [];
                    if(!empty($addon_groups)){
                        
                        foreach($addon_groups as $key => $addon_group_item){
                            $product_addon_group_array[] = [
                                "product_id" => $billing_product_item,
                                "addon_group_id" => $addon_group_item->id,
                                "created_by" => 1
                            ];
                        }
                    }
                    if(!empty($product_addon_group_array) && count($product_addon_group_array)>0){
                        foreach($product_addon_group_array as $product_addon_group_array_item){
                            ProductAddonGroupModel::create($product_addon_group_array_item);
                        }
                    }
                }
                
                for($k=1; $k<=10; $k++){ 
                    $table = [
                        "slack" => $base_controller->generate_slack("restaurant_tables"),
                        "store_id" => $active_store->id,
                        "table_number" => 'Table No. '.$k,
                        "no_of_occupants" => 5,
                        "status" => 1,
                        "created_by" => 1
                    ];
                    
                    $table_id = TableModel::create($table)->id;
                }

                for($j = 1; $j <= 6; $j++){
                    $billing_counter = [
                        "slack" => $base_controller->generate_slack("billing_counters"),
                        "store_id" => $active_store->id,
                        "billing_counter_code" => "C".$j,
                        "counter_name" => "Bill Counter ".$j,
                        "description" => '',
                        "status" => 1,
                        "created_by" => 1
                    ];
                    
                    $billing_counter_id = BillingCounterModel::create($billing_counter)->id;
                }
                
            }
        }

        $all_users = UserModel::select('id')
        ->active()
        ->get();

        if(count($all_users)>0){
            foreach ($all_users as $user) {

                for($k = 1; $k <= 10; $k++){
                    $notification = [
                        "slack" => $base_controller->generate_slack("notifications"),
                        "user_id" => $user->id,
                        "notification_text" => $faker->sentence($nbWords = 10, $variableNbWords = true),
                        "created_by" => 1
                    ];
                    $notif_id = NotificationModel::create($notification)->id;
                }

            }
        }

        $measurements = [
            [
                'unit_code' => 'L',
                'label' => 'Litre'
            ],
            [
                'unit_code' => 'T',
                'label' => 'Tablespoon'
            ],
            [
                'unit_code' => 'CUP',
                'label' => 'Cup'
            ],
            [
                'unit_code' => 'G',
                'label' => 'Gram'
            ],
        ];

        foreach ($measurements as $measurement) {

            $measurement_unit = [
                "slack" => $base_controller->generate_slack("measurement_units"),
                "unit_code" => $measurement['unit_code'],
                "label" => $measurement['label'],
                "status" => 1,
                "created_by" => 1
            ];
            
            MeasurementUnitModel::create($measurement_unit)->id;
        }
        
        Storage::disk('product')->putFileAs('/', new File(public_path('images/placeholder_images/placeholder_image.png')), 'placeholder_image.png');
        Storage::disk('product')->putFileAs('/', new File(public_path('images/placeholder_images/thumb_placeholder_image.png')), 'thumb_placeholder_image.png');
    
        $active_stores = StoreModel::select('id', 'restaurant_mode', 'currency_code')
        ->active()
        ->orderBy('id', 'asc')
        ->get();

        if(count($active_stores)>0){

            $user_data = UserModel::select('*')->where('user_code', 'SA')->first();
            
            $user_api = new UserAPI();
            $user_token = $user_api->generate_access_token($user_data);

            $order_api = new OrderAPI();
            foreach ($active_stores as $active_store) {
                $order_array = [];

                request()->merge([ 'logged_user_store_id' => $active_store->id ]);

                $billing_counter = BillingCounterModel::withoutGlobalScopes()->select('id')->inRandomOrder()->where('store_id', $active_store->id)->first();

                $business_register = [
                    "slack" => $base_controller->generate_slack("business_registers"),
                    "store_id" => $active_store->id,
                    "billing_counter_id" => $billing_counter->id,
                    "current_register" => 1,
                    "user_id" => $user_data->id,
                    "opening_date" => NOW(),
                    "opening_amount" => 0,
                    "created_by" => $user_data->id
                ];  
                $business_register_id = BusinessRegisterModel::create($business_register)->id;

                $count = ($active_store->id == 1)?200:50;
                for($j=0; $j<$count; $j++){

                    $cart = [];
                    
                    $random_limit = rand(1, 10);
                    $random_products = ProductModel::withoutGlobalScopes()->select('slack', 'product_code', 'quantity')->inRandomOrder()->where('store_id', $active_store->id)->limit($random_limit)->get();
                    $payment_method = PaymentMethodModel::withoutGlobalScopes()->inRandomOrder()->whereNull('payment_constant')->first();
                    $account = AccountModel::withoutGlobalScopes()->inRandomOrder()->where('store_id', $active_store->id)->first();
                    $waiter_user = UserModel::select('slack')->where('email', 'waiter1@appsthing.com')->first();

                    if(!empty($random_products)){
                        foreach($random_products as $random_product){
                            $cart[$random_product->slack] = [
                                'product_slack' => $random_product->slack,
                                'product_code' => $random_product->product_code,
                                'quantity' => rand(1, 10),
                            ];
                        }
                    }

                    $request = new Request();
                    $request->merge([
                        'access_token' => $user_token,
                        'logged_user_store_id' => $active_store->id,
                        'logged_user_id' => $user_data->id,
                        'logged_user_store_restaurant_mode' => $active_store->restaurant_mode,
                        'order_status' => 'CLOSE',
                        'customer' => '',
                        'contact_number' => '',
                        'address' => '',
                        'payment_method' => $payment_method->slack,
                        'business_account' => $account->slack,
                        'restaurant_mode' => $active_store->restaurant_mode,
                        'restaurant_order_type' => 'TAKEWAY',
                        'restaurant_table' => '',
                        'waiter' => $waiter_user->slack,
                        'billing_type' => 'QUICK_BILL',
                        'additional_discount_percentage' => 0,
                        'cart' => json_encode($cart)
                    ]);

                    $create_order = $order_api->store($request);
                    $order_response = json_decode(json_encode($create_order));
                    $order_array[] = $order_response->original->data;
                }

                
                $startDate = Carbon::now()->subDays(15)->format('Y-m-d');
                $endDate = Carbon::now()->subDays(1)->format('Y-m-d');
                $dateRange = CarbonPeriod::create($startDate, $endDate);
   
                $generated_date_range = $dateRange->toArray();
                foreach($generated_date_range as $date){
                    
                    OrderModel::withoutGlobalScopes()->inRandomOrder()->whereIn('slack', $order_array)
                    ->chunkById(rand(1,15), function ($orders) use ($date){
                        foreach ($orders as $order) {
                            DB::table('orders')
                            ->where('id', $order->id)
                            ->update([
                                'quantity_updated_on' => $date,
                                'created_at' => $date,
                                'updated_at' => $date
                            ]);

                            DB::table('order_products')
                            ->where('order_id', $order->id)
                            ->update([
                                'created_at' => $date,
                                'updated_at' => $date
                            ]);

                            DB::table('order_product_logs')
                            ->where('order_id', $order->id)
                            ->update([
                                'created_at' => $date,
                                'updated_at' => $date
                            ]);
                        }
                    });
                }

                //Food Station
                $categories = CategoryModel::withoutGlobalScopes()->select('id')
                ->whereNotIn('label', ['Beverages', 'Side Orders'])
                ->where('store_id', $active_store->id)
                ->pluck('id')
                ->toArray();
            
                $kitchen_display = [
                    "slack" => $base_controller->generate_slack("kitchen_displays"),
                    "store_id" => $active_store->id,
                    "kitchen_display_code" => 'FS',
                    "label" => 'Food Station',
                    "categories" => implode(',', $categories),
                    "orange_timer" => 15,
                    "red_timer" => 30,
                    "status" => 1,
                    "created_by" => $user_data->id
                ];
                
                $kitchen_display_id = KitchenDisplayModel::create($kitchen_display)->id;

                //Drinks Station
                $categories = CategoryModel::withoutGlobalScopes()->select('id')
                ->whereIn('label', ['Beverages', 'Side Orders'])
                ->where('store_id', $active_store->id)
                ->pluck('id')
                ->toArray();
            
                $kitchen_display2 = [
                    "slack" => $base_controller->generate_slack("kitchen_displays"),
                    "store_id" => $active_store->id,
                    "kitchen_display_code" => 'DS',
                    "label" => 'Drinks Station',
                    "categories" => implode(',', $categories),
                    "orange_timer" => 5,
                    "red_timer" => 15,
                    "status" => 1,
                    "created_by" => $user_data->id
                ];
                
                $kitchen_display2_id = KitchenDisplayModel::create($kitchen_display2)->id;

                $account = AccountModel::withoutGlobalScopes()->inRandomOrder()->where('store_id', $active_store->id)->first();
                $transaction_type_data = MasterTransactionTypeModel::withoutGlobalScopes()->inRandomOrder()->where('transaction_type_constant', 'EXPENSE')->first();
                $payment_method_data = PaymentMethodModel::withoutGlobalScopes()->inRandomOrder()->whereNull('payment_constant')->first();

                $user_data = UserModel::select('id', 'fullname', 'email', 'phone')
                ->inRandomOrder()
                ->active()
                ->first();
    
                $bill_to_id = $user_data->id;
                $bill_to_name = $user_data->fullname;
                $bill_to_contact = implode(', ',[$user_data->phone, $user_data->email]);
                $bill_to_address = '';

                $transaction = [
                    "slack" => $base_controller->generate_slack("transactions"),
                    "store_id" => $active_store->id,
                    "transaction_code" => Str::random(6),
                    "account_id" => $account->id,
                    "transaction_type" => $transaction_type_data->id,
                    "payment_method_id" => $payment_method_data->id,
                    "payment_method" => $payment_method_data->label,
                    "bill_to" => 'STAFF',
                    "bill_to_id" => $bill_to_id,
                    "bill_to_name" => $bill_to_name,
                    "bill_to_contact" => $bill_to_contact,
                    "bill_to_address" => $bill_to_address,
                    "currency_code" => $active_store->currency_code,
                    "amount" => '5000',
                    "notes" => 'Sample Expense',
                    "transaction_date" => NOW(),
                    "created_by" => $user_data->id
                ];
                
                $transaction_id = TransactionModel::create($transaction)->id;

                $invoice_api = new InvoiceAPI();
                for($j=0; $j<24; $j++){

                    $products = [];
                    $customer = CustomerModel::withoutGlobalScopes()->inRandomOrder()->first();
                    $payment_method_data = PaymentMethodModel::withoutGlobalScopes()->inRandomOrder()->whereNull('payment_constant')->first();

                    $random_limit = rand(1, 10);
                    $random_products = ProductModel::withoutGlobalScopes()->select('slack', 'name', 'sale_amount_excluding_tax', 'product_code', 'quantity')->inRandomOrder()->where('store_id', $active_store->id)->limit($random_limit)->get();

                    if(!empty($random_products)){
                        foreach($random_products as $random_product){
                            $products[] = [
                                'slack' => $random_product->slack,
                                'name' => $random_product->name,
                                'unit_price' => $random_product->sale_amount_excluding_tax,
                                'discount_percentage' => 0,
                                'tax_type' => 'EXCLUSIVE',
                                'tax_percentage' => 0,
                                'amount' => 0,
                                'quantity' => rand(1,10),
                            ];
                        }
                    }

                    $request = new Request();
                    $request->merge([
                        'access_token' => $user_token,
                        'logged_user_store_id' => $active_store->id,
                        'logged_user_id' => $user_data->id,
                        'bill_to' => 'CUSTOMER',
                        'bill_to_slack' => $customer->slack,
                        'invoice_reference' => Str::upper(Str::random(5)),
                        'invoice_date' => NOW(),
                        'invoice_due_date' => Carbon::now()->addDays(10)->format('Y-m-d H:i:s'),
                        'currency' => 'USD',
                        'shipping_charge' => 1,
                        'packing_charge' => 1,
                        'terms' => '',
                        'tax_option' => 'DEFAULT_TAX',
                        'products' => json_encode($products)
                    ]);
                    $create_invoice = $invoice_api->store($request);
                }

                $purchase_order_api = new PurchaseOrderAPI();
                $supplier = SupplierModel::withoutGlobalScopes()->where('supplier_code', 'SUP101')->first();
                for($j=0; $j<50; $j++){

                    $products = [];
                    $customer = CustomerModel::withoutGlobalScopes()->inRandomOrder()->first();

                    $random_limit = rand(1, 10);
                    $random_products = ProductModel::withoutGlobalScopes()->select('slack', 'name', 'sale_amount_excluding_tax', 'product_code', 'quantity')->inRandomOrder()->where('store_id', $active_store->id)->limit($random_limit)->get();

                    if(!empty($random_products)){
                        foreach($random_products as $random_product){
                            $products[] = [
                                'slack' => $random_product->slack,
                                'name' => $random_product->name,
                                'unit_price' => $random_product->sale_amount_excluding_tax,
                                'discount_percentage' => 0,
                                'tax_type' => 'EXCLUSIVE',
                                'tax_percentage' => 0,
                                'amount' => 0,
                                'quantity' => rand(1,10),
                            ];
                        }
                    }

                    $request = new Request();
                    $request->merge([
                        'access_token' => $user_token,
                        'supplier' => $supplier->slack,
                        'logged_user_store_id' => $active_store->id,
                        'logged_user_id' => $user_data->id,
                        'bill_to' => 'CUSTOMER',
                        'bill_to_slack' => $customer->slack,
                        'po_number' => Str::upper(Str::random(5)),
                        'po_reference' => Str::upper(Str::random(5)),
                        'order_date' => NOW(),
                        'order_due_date' => Carbon::now()->addDays(10)->format('Y-m-d H:i:s'),
                        'currency' => 'USD',
                        'shipping_charge' => 1,
                        'packing_charge' => 1,
                        'terms' => '',
                        'tax_option' => 'DEFAULT_TAX',
                        'update_stock' => 0,
                        'products' => json_encode($products)
                    ]);
                    $create_purchase_order = $purchase_order_api->store($request);
                }

                $quotation_api = new QuotationAPI();
                for($j=0; $j<24; $j++){

                    $products = [];
                    $customer = CustomerModel::withoutGlobalScopes()->inRandomOrder()->first();

                    $random_limit = rand(1, 10);
                    $random_products = ProductModel::withoutGlobalScopes()->select('slack', 'name', 'sale_amount_excluding_tax', 'product_code', 'quantity')->inRandomOrder()->where('store_id', $active_store->id)->limit($random_limit)->get();

                    if(!empty($random_products)){
                        foreach($random_products as $random_product){
                            $products[] = [
                                'slack' => $random_product->slack,
                                'name' => $random_product->name,
                                'unit_price' => $random_product->sale_amount_excluding_tax,
                                'discount_percentage' => 0,
                                'tax_type' => 'EXCLUSIVE',
                                'tax_percentage' => 0,
                                'amount' => 0,
                                'quantity' => rand(1,10),
                            ];
                        }
                    }

                    $request = new Request();
                    $request->merge([
                        'access_token' => $user_token,
                        'logged_user_store_id' => $active_store->id,
                        'logged_user_id' => $user_data->id,
                        'bill_to' => 'CUSTOMER',
                        'bill_to_slack' => $customer->slack,
                        'quotation_reference' => Str::upper(Str::random(5)),
                        'quotation_date' => NOW(),
                        'quotation_due_date' => Carbon::now()->addDays(10)->format('Y-m-d H:i:s'),
                        'currency' => 'USD',
                        'shipping_charge' => 1,
                        'packing_charge' => 1,
                        'terms' => '',
                        'tax_option' => 'DEFAULT_TAX',
                        'products' => json_encode($products)
                    ]);
                    $create_quotation = $quotation_api->store($request);
                }
            }
        }
    }
}
