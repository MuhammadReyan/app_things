<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class OrderProductLogs extends Model
{
    protected $table = 'order_product_logs';
    protected $hidden = ['id'];
    protected $fillable = ['slack', 'order_id', 'product_id', 'quantity', 'edit_counter', 'quantity_reduced', 'previous_quantity', 'is_ready_to_serve', 'merged', 'merged_from', 'merged_to', 'created_by', 'updated_by', 'created_at', 'updated_at'];

    public function duration($date){
        return ($date != null)?Carbon::parse($date)->diffForHumans(Carbon::now(), ['options' => Carbon::NO_ZERO_DIFF]):null;
    }

    public function parseDate($date){
        return ($date != null)?Carbon::parse($date)->format(config("app.date_time_format")):null;
    }
}
