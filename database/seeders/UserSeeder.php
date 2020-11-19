<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'Samut Chouybumrung';
        $user->tel = '0922489093';
        $user->email = 'samut.c@ku.th';
        $user->password = Hash::make('samut123');
        $user->role = 'Customer';
        $user->save();

        $user = new User();
        $user->name = 'Jiraporn Kowootthitam ';
        $user->tel = '0955938259';
        $user->email = 'jiraporn.k@ku.th';
        $user->password = Hash::make('jiraporn123');
        $user->role = 'Customer';
        $user->save();


        $user = new User();
        $user->name = 'Admin';
        $user->tel = '0955938259';
        $user->email = 'admin@admin.com';
        $user->password = Hash::make('admin123');
        $user->role = 'Admin';
        $user->save();
    }
}
