<?php

namespace App\Http\Controllers\API;

use Exception;
use Validator;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use App\Http\Resources\KitchenDisplayResource;

use App\Models\KitchenDisplay as KitchenDisplayModel;
use App\Models\Category;

use App\Http\Resources\Collections\KitchenDisplayCollection;

class KitchenDisplay extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try {

            $data['action_key'] = 'A_VIEW_KITCHEN_DISPLAY_LISTING';
            if(check_access(array($data['action_key']), true) == false){
                $response = $this->no_access_response_for_listing_table();
                return $response;
            }

            $item_array = array();

            $draw = $request->draw;
            $limit = $request->length;
            $offset = $request->start;
            
            $order_by = $request->order[0]["column"];
            $order_direction = $request->order[0]["dir"];
            $order_by_column =  $request->columns[$order_by]['name'];

            $filter_string = $request->search['value'];
            $filter_columns = array_filter(data_get($request->columns, '*.name'));
            
            $query = KitchenDisplayModel::select('kitchen_displays.*', 'master_status.label as status_label', 'master_status.color as status_color', 'user_created.fullname')
            ->take($limit)
            ->skip($offset)
            ->statusJoin()
            ->createdUser()

            ->when($order_by_column, function ($query, $order_by_column) use ($order_direction) {
                $query->orderBy($order_by_column, $order_direction);
            }, function ($query) {
                $query->orderBy('created_at', 'desc');
            })

            ->when($filter_string, function ($query, $filter_string) use ($filter_columns) {
                $query->where(function ($query) use ($filter_string, $filter_columns){
                    foreach($filter_columns as $filter_column){
                        $query->orWhere($filter_column, 'like', '%'.$filter_string.'%');
                    }
                });
            })

            ->get();

            $kitchen_displays = KitchenDisplayResource::collection($query);
           
            $total_count = KitchenDisplayModel::select("id")->get()->count();

            $item_array = [];
            foreach($kitchen_displays as $key => $kitchen_display){
                
                $kitchen_display = $kitchen_display->toArray($request);

                $item_array[$key][] = $kitchen_display['kitchen_display_code'];
                $item_array[$key][] = $kitchen_display['label'];
                $item_array[$key][] = (isset($kitchen_display['status']['label']))?view('common.status', ['status_data' => ['label' => $kitchen_display['status']['label'], "color" => $kitchen_display['status']['color']]])->render():'-';
                $item_array[$key][] = $kitchen_display['created_at_label'];
                $item_array[$key][] = $kitchen_display['updated_at_label'];
                $item_array[$key][] = (isset($kitchen_display['created_by']['fullname']))?$kitchen_display['created_by']['fullname']:'-';
                $item_array[$key][] = view('kitchen_display.layouts.kitchen_display_actions', ['kitchen_display' => $kitchen_display])->render();
            }

            $response = [
                'draw' => $draw,
                'recordsTotal' => $total_count,
                'recordsFiltered' => $total_count,
                'data' => $item_array
            ];
            
            return response()->json($response);
        }catch(Exception $e){
            return response()->json($this->generate_response(
                array(
                    "message" => $e->getMessage(),
                    "status_code" => $e->getCode()
                )
            ));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {

            if(!check_access(['A_ADD_KITCHEN_DISPLAY'], true)){
                throw new Exception("Invalid request", 400);
            }

            $this->validate_request($request);

            $kitchen_display_code_data_exists = KitchenDisplayModel::select('id')
            ->where('kitchen_display_code', '=', trim($request->kitchen_display_code))
            ->first();
            if (!empty($kitchen_display_code_data_exists)) {
                throw new Exception("Kitchen display code already exists", 400);
            }

            $kitchen_display_data_exists = KitchenDisplayModel::select('id')
            ->where('label', '=', trim($request->label))
            ->first();
            if (!empty($kitchen_display_data_exists)) {
                throw new Exception("Kitchen display name already exists", 400);
            }

            $categories = Category::select('id')
            ->whereIn('slack', explode(',', $request->categories))
            ->pluck('id')
            ->toArray();
            (count($categories) >0 )?sort($categories):$categories;
            if (empty($categories)) {
                throw new Exception("Category is required", 400);
            }

            DB::beginTransaction();
            
            $kitchen_display = [
                "slack" => $this->generate_slack("kitchen_displays"),
                "store_id" => $request->logged_user_store_id,
                "kitchen_display_code" => $request->kitchen_display_code,
                "label" => $request->label,
                "categories" => implode(',', $categories),
                "orange_timer" => $request->orange_timer,
                "red_timer" => $request->red_timer,
                "status" => $request->status,
                "created_by" => $request->logged_user_id
            ];
            
            $kitchen_display_id = KitchenDisplayModel::create($kitchen_display)->id;

            DB::commit();

            return response()->json($this->generate_response(
                array(
                    "message" => "Kitchen display created successfully", 
                    "data"    => $kitchen_display['slack']
                ), 'SUCCESS'
            ));

        }catch(Exception $e){
            return response()->json($this->generate_response(
                array(
                    "message" => $e->getMessage(),
                    "status_code" => $e->getCode()
                )
            ));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $slack
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($slack)
    { 
        try {

            if(!check_access(['A_DETAIL_KITCHEN_DISPLAY'], true)){
                throw new Exception("Invalid request", 400);
            }

            $item = KitchenDisplayModel::select('*')
            ->where('slack', $slack)
            ->first();

            $item_data = new KitchenDisplayResource($item);

            return response()->json($this->generate_response(
                array(
                    "message" => "Kitchen display loaded successfully", 
                    "data"    => $item_data
                ), 'SUCCESS'
            ));

        }catch(Exception $e){
            return response()->json($this->generate_response(
                array(
                    "message" => $e->getMessage(),
                    "status_code" => $e->getCode()
                )
            ));
        }  
    }

    /**
     * list all the specified resource.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function list(Request $request)
    {
        try {

            if(!check_access(['A_VIEW_KITCHEN_DISPLAY_LISTING'], true)){
                throw new Exception("Invalid request", 400);
            }

            $list = new KitchenDisplayCollection(KitchenDisplayModel::select('*')
            ->orderBy('created_at', 'desc')->paginate());

            return response()->json($this->generate_response(
                array(
                    "message" => "Kitchen display loaded successfully", 
                    "data"    => $list
                ), 'SUCCESS'
            ));

        }catch(Exception $e){
            return response()->json($this->generate_response(
                array(
                    "message" => $e->getMessage(),
                    "status_code" => $e->getCode()
                )
            ));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $slack
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $slack)
    {
        try {

            if(!check_access(['A_EDIT_KITCHEN_DISPLAY'], true)){
                throw new Exception("Invalid request", 400);
            }

            $this->validate_request($request);

            $kitchen_display_code_data_exists = KitchenDisplayModel::select('id')
            ->where([
                ['slack', '!=', $slack],
                ['kitchen_display_code', '=', trim($request->kitchen_display_code)]
            ])
            ->first();
            if (!empty($kitchen_display_code_data_exists)) {
                throw new Exception("Kitchen display code already exists", 400);
            }

            $kitchen_display_data_exists = KitchenDisplayModel::select('id')
            ->where([
                ['slack', '!=', $slack],
                ['label', '=', trim($request->label)],
            ])
            ->first();
            if (!empty($kitchen_display_data_exists)) {
                throw new Exception("Kitchen display name already exists", 400);
            }

            $categories = Category::select('id')
            ->whereIn('slack', explode(',', $request->categories))
            ->pluck('id')
            ->toArray();
            (count($categories) >0 )?sort($categories):$categories;
            if (empty($categories)) {
                throw new Exception("Category is required", 400);
            }

            DB::beginTransaction();
            
            $kitchen_display = [
                "kitchen_display_code" => $request->kitchen_display_code,
                "label" => $request->label,
                "categories" => implode(',', $categories),
                "orange_timer" => $request->orange_timer,
                "red_timer" => $request->red_timer,
                "status" => $request->status,
                "created_by" => $request->logged_user_id
            ];

            $action_response = KitchenDisplayModel::where('slack', $slack)
            ->update($kitchen_display);

            DB::commit();

            return response()->json($this->generate_response(
                array(
                    "message" => "Kitchen display updated successfully", 
                    "data"    => $slack
                ), 'SUCCESS'
            ));

        }catch(Exception $e){
            return response()->json($this->generate_response(
                array(
                    "message" => $e->getMessage(),
                    "status_code" => $e->getCode()
                )
            ));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($slack)
    {
        try{
            if(!check_access(['A_DELETE_KITCHEN_DISPLAY'], true)){
                throw new Exception("Invalid request", 400);
            }

            $kitchen_display_detail = KitchenDisplayModel::select('id')->where('slack', $slack)->first();
            if (empty($kitchen_display_detail)) {
                throw new Exception("Invalid kitchen_display provided", 400);
            }
            $kitchen_display_id = $kitchen_display_detail->id;
            
            DB::beginTransaction();

            KitchenDisplayModel::where('id', $kitchen_display_id)->delete();

            DB::commit();

            $forward_link = route('kitchen_displays');

            return response()->json($this->generate_response(
                array(
                    "message" => "Kitchen display deleted successfully", 
                    "data" => $slack,
                    "link" => $forward_link
                ), 'SUCCESS'
            ));

        }catch(Exception $e){
            return response()->json($this->generate_response(
                array(
                    "message" => $e->getMessage(),
                    "status_code" => $e->getCode()
                )
            ));
        }
    }

    public function validate_request($request)
    {
        $validator = Validator::make($request->all(), [
            'kitchen_display_code' => $this->get_validation_rules("codes", true),
            'label' => 'max:150|required',
            'status' => $this->get_validation_rules("status", true),
        ]);
        $validation_status = $validator->fails();
        if($validation_status){
            throw new Exception($validator->errors());
        }
    }
}
