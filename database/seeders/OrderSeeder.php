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
        $order->user_id = 1;
        $order->order_datetime = date('Y-m-d H:i:s');
        $order->order_status = 'รอยืนยันการชำระเงิน';
        $order->save();

        $order = new Order();
        $order->user_id = 1;
        $order->order_datetime = date('Y-m-d H:i:s');
        $order->order_status = 'รอจัดส่งสินค้า';
        $order->save();

    }
}
