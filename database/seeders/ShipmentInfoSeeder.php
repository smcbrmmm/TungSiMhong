<?php

namespace Database\Seeders;

use App\Models\ShipmentInfo;
use Illuminate\Database\Seeder;

class ShipmentInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shipment = new ShipmentInfo();
        $shipment->order_id = 5 ;
        $shipment->tracking_no = "EF582621151TH" ;
        $shipment->send_time = "2020-10-17 09:45:12" ;
        $shipment->save();

        $shipment = new ShipmentInfo();
        $shipment->order_id = 7 ;
        $shipment->tracking_no = "EF782623331TH" ;
        $shipment->send_time = "2020-11-19 11:25:03" ;
        $shipment->save();
    }
}
