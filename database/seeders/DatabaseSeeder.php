<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\PaymentInformation;
use App\Models\Product;
use App\Models\ShipmentInfo;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            UserSeeder::class,
            AddressSeeder::class,
            OrderSeeder::class,
            ShipmentInfoSeeder::class,
            PaymentInfoSeeder::class,
            ProductSeeder::class,
            OrderDetailSeeder::class
        ]);
    }
}
