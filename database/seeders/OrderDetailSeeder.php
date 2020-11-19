<?php


namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderDetail;
use Carbon\Traits\Date;
use Illuminate\Database\Seeder;


class OrderDetailSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $orderDetail = new OrderDetail();
        $orderDetail->product_id = 4;
        $orderDetail->order_id = 1;
        $orderDetail->orderdetail_quantity = 2;
        $orderDetail->orderdetail_price=240;
        $orderDetail->save();

        $orderDetail = new OrderDetail();
        $orderDetail->product_id = 10;
        $orderDetail->order_id = 1;
        $orderDetail->orderdetail_quantity = 5;
        $orderDetail->orderdetail_price=150;
        $orderDetail->save();

        $orderDetail = new OrderDetail();
        $orderDetail->product_id = 8;
        $orderDetail->order_id = 1;
        $orderDetail->orderdetail_quantity = 5;
        $orderDetail->orderdetail_price=100;
        $orderDetail->save();

        $orderDetail = new OrderDetail();
        $orderDetail->product_id = 1;
        $orderDetail->order_id = 2;
        $orderDetail->orderdetail_quantity = 2;
        $orderDetail->orderdetail_price=78;
        $orderDetail->save();

        $orderDetail = new OrderDetail();
        $orderDetail->product_id = 12;
        $orderDetail->order_id = 2;
        $orderDetail->orderdetail_quantity = 2;
        $orderDetail->orderdetail_price=90;
        $orderDetail->save();

        $orderDetail = new OrderDetail();
        $orderDetail->product_id = 10;
        $orderDetail->order_id = 3;
        $orderDetail->orderdetail_quantity = 3;
        $orderDetail->orderdetail_price=90;
        $orderDetail->save();

        $orderDetail = new OrderDetail();
        $orderDetail->product_id = 9;
        $orderDetail->order_id = 3;
        $orderDetail->orderdetail_quantity = 1;
        $orderDetail->orderdetail_price=30;
        $orderDetail->save();

        $orderDetail = new OrderDetail();
        $orderDetail->product_id = 4;
        $orderDetail->order_id = 3;
        $orderDetail->orderdetail_quantity = 2;
        $orderDetail->orderdetail_price=240;
        $orderDetail->save();

        $orderDetail = new OrderDetail();
        $orderDetail->product_id = 4;
        $orderDetail->order_id = 4;
        $orderDetail->orderdetail_quantity = 3;
        $orderDetail->orderdetail_price=360;
        $orderDetail->save();

        $orderDetail = new OrderDetail();
        $orderDetail->product_id = 7;
        $orderDetail->order_id = 4;
        $orderDetail->orderdetail_quantity = 3;
        $orderDetail->orderdetail_price=300;
        $orderDetail->save();

        $orderDetail = new OrderDetail();
        $orderDetail->product_id = 19;
        $orderDetail->order_id = 4;
        $orderDetail->orderdetail_quantity = 4;
        $orderDetail->orderdetail_price=180;
        $orderDetail->save();

        $orderDetail = new OrderDetail();
        $orderDetail->product_id = 6;
        $orderDetail->order_id = 5;
        $orderDetail->orderdetail_quantity = 1;
        $orderDetail->orderdetail_price=39;
        $orderDetail->save();

        $orderDetail = new OrderDetail();
        $orderDetail->product_id = 3;
        $orderDetail->order_id = 5;
        $orderDetail->orderdetail_quantity = 1;
        $orderDetail->orderdetail_price=290;
        $orderDetail->save();

        $orderDetail = new OrderDetail();
        $orderDetail->product_id = 15;
        $orderDetail->order_id = 5;
        $orderDetail->orderdetail_quantity = 1;
        $orderDetail->orderdetail_price=230;
        $orderDetail->save();

        $orderDetail = new OrderDetail();
        $orderDetail->product_id = 4;
        $orderDetail->order_id = 6;
        $orderDetail->orderdetail_quantity = 4;
        $orderDetail->orderdetail_price=480;
        $orderDetail->save();


    }

}
