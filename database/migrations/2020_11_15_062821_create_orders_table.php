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
            $table->string('order_datetime')->nullable();
            $table->string('order_code')->unique();
            $table->enum('order_status',['ตะกร้า', 'รอการชำระเงิน', 'รอจัดส่งสินค้า','กำลังตรวจสอบหลักฐานการชำระเงิน', 'รอรับสินค้า', 'สำเร็จ', 'ยกเลิก'])->default('ตะกร้า');
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
