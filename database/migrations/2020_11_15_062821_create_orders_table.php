<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->date('order_datetime')->nullable();
            $table->enum('order_status',['ตะกร้า', 'รอยืนยันการชำระเงิน', 'รอจัดส่งสินค้า', 'รอรับสินค้า', 'สำเร็จ', 'ยกเลิก'])->default('ตะกร้า');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
