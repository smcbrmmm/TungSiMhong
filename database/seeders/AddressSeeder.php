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
        $address->receiver_name = 'Janjira Aekpatcha';
        $address->place_name = 'Home';
        $address->receiver_tel = '0955938259';
        $address->postal = '10900';
        $address->province = 'Bangkok';
        $address->house_no = '54/10';
        $address->address ='M.7';
        $address->save();

        $address = new Address();
        $address->user_id = 1;
        $address->receiver_name = 'Naomi Shabu';
        $address->place_name = 'Home2';
        $address->receiver_tel = '0955938259';
        $address->postal = '10700';
        $address->province = 'Bangkok';
        $address->house_no = '22/10';
        $address->address ='M.4';
        $address->save();
    }
}
