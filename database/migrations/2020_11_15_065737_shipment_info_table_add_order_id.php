<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ShipmentInfoTableAddOrderId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shipment_infos', function (Blueprint $table) {
            $table->unsignedBigInteger('order_id')->after('id');

            $table->foreign('order_id')
                ->references('id')
                ->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shipment_infos', function (Blueprint $table) {
            Schema::disableForeignKeyConstraints();
            $table->dropForeign(['order_id']);
            $table->dropColumn('order_id');
            Schema::enableForeignKeyConstraints();
        });
    }
}
