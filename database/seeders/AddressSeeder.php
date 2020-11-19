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

        $address = new Address();
        $address->user_id = 4;
        $address->receiver_name = 'Sirawit Yuwasirinun';
        $address->place_name = 'บ้าน';
        $address->receiver_tel = '065-7925111';
        $address->postal = '72140';
        $address->province = 'สุพรรรณบุรี';
        $address->house_no = '218/1';
        $address->address ='ม.1 ต.วังน้ำซับ อ.ศรีประจันต์';
        $address->save();

        $address = new Address();
        $address->user_id = 5;
        $address->receiver_name = 'ทองริด ประสิทธ์ซับ';
        $address->place_name = 'บ้าน';
        $address->receiver_tel = '087-9025110';
        $address->postal = '11150';
        $address->province = 'นนทบุรี';
        $address->house_no = '198/125';
        $address->address ='ม.1 ต.ขุนศรี อ.ไทรน้อย';
        $address->save();


        $address = new Address();
        $address->user_id = 5;
        $address->receiver_name = 'Kotchakorn Prasitsub';
        $address->place_name = 'บ้านแม่';
        $address->receiver_tel = '091-8125110';
        $address->postal = '25000';
        $address->province = 'ปราจีนบุรี';
        $address->house_no = '33/91';
        $address->address ='ม.3 ต.ท่างาม	 อ.เมืองปราจีนบุรี';
        $address->save();

        $address = new Address();
        $address->user_id = 5;
        $address->receiver_name = 'ประเวศ ประสิทธ์ซับ';
        $address->place_name = 'บ้านปู่';
        $address->receiver_tel = '065-3232810';
        $address->postal = '62160';
        $address->province = 'ปราจีนบุรี';
        $address->house_no = '33/91';
        $address->address =' ต.ธำมรงค์  อ.เมืองกำแพงเพชร';
        $address->save();

        $address = new Address();
        $address->user_id = 6;
        $address->receiver_name = 'ไกร บุญไชโย';
        $address->place_name = 'อาคารเมธีบำรุง';
        $address->receiver_tel = '0871020251';
        $address->postal = '67270';
        $address->province = 'เพชรบูรณ์';
        $address->house_no = '2/208';
        $address->address =' ต.เขาค้อ  อ.เขาค้อ';
        $address->save();

        $address = new Address();
        $address->user_id = 7;
        $address->receiver_name = 'การัต มะระตะ';
        $address->place_name = 'แฟลตขาวสะอาด';
        $address->receiver_tel = '0819920658';
        $address->postal = '34000';
        $address->province = 'อุบลราชธานี';
        $address->house_no = '10/156';
        $address->address ='ม.10 ต.หนองขอน  อ.เมืองอุบลราชธานี';
        $address->save();
    }
}
