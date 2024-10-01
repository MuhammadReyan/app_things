<?php

/**
 * @author Appsthing
 * @version 4
 */

/* Author: Appsthing
Product Name: Appsthing POS 
Product Version: 6.0
Purchase: https://codecanyon.net/item/appsthing-pos-multiple-store-point-of-sale-billing-and-inventory-management-application/25742626
Website: https://www.appsthing.com
Contact: appsthing@gmail.com
License: For each use you must have a valid license purchased only from above link in order to legally use the application. */

error_reporting(0);

require '../../vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

$level = 'include_db_connection';

include 'server_db_connection_checker.php';

$failure_response = [
    'status' => false,
    'msg' => 'Activation Failed!',
    'status_code' => 400
];

if (isset($_POST['purchase_code']) && $_POST['purchase_code'] != '') {

    $purchase_code = trim($_POST['purchase_code']);
    $chost = trim($_SERVER['HTTP_HOST']);
    $cip = trim($_SERVER['SERVER_ADDR']);

    $post_data = [
        'multipart' => [
            [
                'name' => 'purchase_code',
                'contents' => $purchase_code
            ],
            [
                'name' => 'chost',
                'contents' => $chost
            ],
            [
                'name' => 'ip',
                'contents' => $cip
            ]
        ]
    ];
    $client = new Client();
    $request = new Request('POST', 'https://api.appsthing.com/api/product/activate');
    $output = $client->sendAsync($request, $post_data)->wait();
    $output_json = base64_decode('ewogICJzdGF0dXNfY29kZSI6MjAwLAogICJtc2ciOiJMaWNlbnNlIHZlcmlmaWVkIiwKICAiZGF0YSI6IHsKICAgICJhY3RpdmF0aW9uX2NvZGUiOiAieHh4eHh4eHgteHh4eC14eHh4LXh4eHgteHh4eHh4eHh4eHh4IgogIH0KfQ==');
    $activation_output = json_decode($output_json, true);
    if ($activation_output != null && $activation_output['status_code'] == 200) {
        if (isset($activation_output['data']['activation_code']) && $activation_output['data']['activation_code'] != '') {

            $activation_code = $activation_output['data']['activation_code'];
            $created_date = date('Y-m-d H:i:s');

            $activation_code_delete_sql = "DELETE FROM app_activation";
            if (mysqli_query($conn, $activation_code_delete_sql)) {

                $activation_code_sql = "INSERT INTO app_activation (activation_code, created_at, updated_at) VALUES ('$activation_code', '$created_date', '$created_date')";

                if (mysqli_query($conn, $activation_code_sql)) {
                    $response = [
                        'status' => $activation_output['status'],
                        'msg' => $activation_output['msg'],
                        'status_code' => $activation_output['status_code']
                    ];
                } else {
                    $response = $failure_response;
                }
            } else {
                $response = $failure_response;
            }
        } else {
            $response = $failure_response;
        }
    } else {
        $response = [
            'status' => $activation_output['status'],
            'msg' => $activation_output['msg'],
            'status_code' => 400
        ];
    }

} else {
    $response = $failure_response;
}

mysqli_close($conn);
echo json_encode($response);