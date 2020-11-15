<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PaymentInformationTableAddUserId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payment_information', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->after('id');

            $table->foreign('user_id')
                ->references('id')
                ->on('users');

            $table->unsignedBigInteger('order_id')->after('user_id');

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
        Schema::table('payment_information', function (Blueprint $table) {
            Schema::disableForeignKeyConstraints();
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
            $table->dropForeign(['order_id']);
            $table->dropColumn('order_id');
            Schema::enableForeignKeyConstraints();
        });
    }
}
