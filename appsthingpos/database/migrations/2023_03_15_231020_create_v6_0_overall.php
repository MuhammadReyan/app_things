<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateV60Overall extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_product_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slack', 30)->unique();
            $table->integer('order_id');
            $table->integer('product_id');
            $table->decimal('quantity', 8, 2)->default(0);
            $table->tinyInteger('is_ready_to_serve')->default(0);
            $table->integer('edit_counter')->default(0);
            $table->tinyInteger('quantity_reduced')->nullable()->default(0);
            $table->decimal('previous_quantity', 8, 2)->nullable()->default(0);
            $table->tinyInteger('merged')->default(0);
            $table->integer('merged_from')->nullable();
            $table->integer('merged_to')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            $table->index(['order_id', 'product_id', 'is_ready_to_serve']);
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->datetime('quantity_updated_on')->nullable()->after('updated_by');
        });
        
        Schema::create('kitchen_displays', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slack', 30)->unique();
            $table->integer('store_id');
            $table->string('kitchen_display_code', 30);
            $table->string('label', 250);
            $table->text('categories');
            $table->decimal('orange_timer', 13, 2)->nullable()->default(5);
            $table->decimal('red_timer', 13, 2)->nullable()->default(15);
            $table->tinyInteger('status')->default(1);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            $table->index(['store_id', 'kitchen_display_code', 'status'], 'kd_indexes');
        });

        Artisan::call('db:seed', [
            '--class' => v6_0_overall_seeder::class,
            '--force' => true
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
