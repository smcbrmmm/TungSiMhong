<?php

namespace Database\Seeders;

use App\Models\PaymentInformation;
use Illuminate\Database\Seeder;

class PaymentInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $payment_info = new PaymentInformation();
        $payment_info->user_id = 2;
        $payment_info->order_id = 3;
        $payment_info->payment_datetime = "2020-08-05 18:10:23";
        $payment_info->payment_amount = 168;
        $payment_info->img_slip = "/imgProduct/1605786052.jpg";
        $payment_info->save();


        $payment_info = new PaymentInformation();
        $payment_info->user_id = 6;
        $payment_info->order_id = 5;
        $payment_info->payment_datetime = "2020-10-17 11:33:50";
        $payment_info->payment_amount = 559;
        $payment_info->img_slip = "/imgProduct/1605784917.jpg";
        $payment_info->save();

        $payment_info = new PaymentInformation();
        $payment_info->user_id = 4;
        $payment_info->order_id = 6;
        $payment_info->payment_datetime = "2020-11-19 06:11:45";
        $payment_info->payment_amount = 480;
        $payment_info->img_slip = "/imgProduct/1605784917.jpg";
        $payment_info->save();
    }
}
