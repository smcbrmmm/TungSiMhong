<?php

namespace Database\Seeders;

use App\Models\Order;
use Carbon\Traits\Date;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $order = new Order();
        $order->address_id = 1;
        $order->user_id = 1;
        $order->order_code = "PSD125958";
        $order->order_status = "ตะกร้า";
        $order->save();

        $order = new Order();
        $order->address_id = 2;
        $order->user_id = 2;
        $order->order_code = "SUP126958";
        $order->order_status = "ตะกร้า";
        $order->save();

        $order = new Order();
        $order->address_id = 2;
        $order->user_id = 2;
        $order->order_code = "OOU126058";
        $order->order_status = "รอการชำระเงิน";
        $order->save();

        $order = new Order();
        $order->address_id = 4;
        $order->user_id = 5;
        $order->order_code = "YYT126058";
        $order->order_status = "รอการชำระเงิน";
        $order->save();

        $order = new Order();
        $order->address_id = 7;
        $order->user_id = 6;
        $order->order_code = "YSS216058";
        $order->order_status = "ตะกร้า";
        $order->save();


    }
}
