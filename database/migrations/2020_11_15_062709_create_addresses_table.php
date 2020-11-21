<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('receiver_name','30')->nullable(true);
            $table->string('place_name','30')->nullable(true);
            $table->string('postal','5')->nullable(true);
            $table->string('receiver_tel','10')->nullable(true);
            $table->string('province','20')->nullable(true);
            $table->string('address','50')->nullable(true);
            $table->string('house_no','10')->nullable(true);
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
        Schema::dropIfExists('addresses');
    }
}
