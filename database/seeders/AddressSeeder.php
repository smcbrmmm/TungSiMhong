<?php

namespace Database\Seeders;

use App\Models\Address;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $address = new Address();
        $address->user_id = 1;
        $address->receiver_name = 'สมัชญ์ ช่วยบำรุง';
        $address->place_name = 'หอพักศุภกรแมนชั่น';
        $address->receiver_tel = '0955938259';
        $address->postal = '10900';
        $address->province = 'กรุงเทพมหานคร';
        $address->house_no = '2103/30';
        $address->address ='ซอยตลาดอมรพันธ์ ถนนพหลโยธิน แขวงลาดยาว เขตจตุจักร';
        $address->save();

        $address = new Address();
        $address->user_id = 1;
        $address->receiver_name = 'สกุลรัตน์ ช่วยบำรุง';
        $address->place_name = 'บ้านแม่';
        $address->receiver_tel = '085-7925230';
        $address->postal = '82120';
        $address->province = 'พังงา';
        $address->house_no = '54/10';
        $address->address ='ม.7 ต.ทุ่งมะพร้าว อ.ท้ายเหมือง';
        $address->save();
    }
}
