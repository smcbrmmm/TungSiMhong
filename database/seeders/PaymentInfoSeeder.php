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
        $payment = new PaymentInformation();
        $payment->user_id = 1;
        $payment->order_id = 2;
        $payment->payment_datetime = date('Y-m-d H:i:s');
        $payment->payment_amount = 120;
        $payment->img_slip = 'Slip1';
        $payment->save();

        $payment = new PaymentInformation();
        $payment->user_id = 1;
        $payment->order_id = 2;
        $payment->payment_datetime = date('Y-m-d H:i:s');
        $payment->payment_amount = 110;
        $payment->img_slip = 'Slip2';
        $payment->save();
    }
}
