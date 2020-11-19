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
        $order->order_datetime = "2020-06-01 09:13:20";
        $order->order_code = "PSD125958";
        $order->order_status = "ตะกร้า";
        $order->save();

        $order = new Order();
        $order->address_id = 2;
        $order->user_id = 2;
        $order->order_datetime = "2020-06-19 18:26:04";
        $order->order_code = "SUP126958";
        $order->order_status = "ตะกร้า";
        $order->save();

        $order = new Order();
        $order->address_id = 2;
        $order->user_id = 2;
        $order->order_datetime = "2020-07-30 07:10:09";
        $order->order_code = "OOU126058";
        $order->order_status = "กำลังตรวจสอบการชำระเงิน";
        $order->save();

        $order = new Order();
        $order->address_id = 4;
        $order->user_id = 5;
        $order->order_datetime = "2020-07-30 07:10:09";
        $order->order_code = "YYT126058";
        $order->order_status = "รอการชำระเงิน";
        $order->save();


        $order = new Order();
        $order->address_id = 7;
        $order->user_id = 6;
        $order->order_datetime = "2020-10-16 15:36:54";
        $order->order_code = "KXX216078";
        $order->order_status = "สำเร็จ";
        $order->save();

        $order = new Order();
        $order->address_id = 3;
        $order->user_id = 4;
        $order->order_datetime = "2020-11-15 12:00:10";
        $order->order_code = "POX216138";
        $order->order_status = "รอจัดส่งสินค้า";
        $order->save();

        $order = new Order();
        $order->address_id = 8;
        $order->user_id = 7;
        $order->order_datetime = "2020-11-16 21:15:32";
        $order->order_code = "CVX216138";
        $order->order_status = "รอรับสินค้า";
        $order->save();




    }
}
