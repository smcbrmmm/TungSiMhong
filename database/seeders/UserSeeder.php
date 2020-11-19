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
        $user->email = 'jiraporn.kow@ku.th';
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

        $user = new User();
        $user->name = 'Sirawit Yuwasirinun';
        $user->tel = '0958828259';
        $user->email = 'nobnaja@nob.com';
        $user->password = Hash::make('nobnaja123');
        $user->role = 'Customer';
        $user->save();

        $user = new User();
        $user->name = 'TongRid Prasitsub';
        $user->tel = '0651020259';
        $user->email = 'Tongridhot@hotmail.com';
        $user->password = Hash::make('123456TongRid');
        $user->role = 'Customer';
        $user->save();

        $user = new User();
        $user->name = 'Krai Boonchaiyo';
        $user->tel = '0871020251';
        $user->email = 'chaiyoK@hotmail.com';
        $user->password = Hash::make('123456789K');
        $user->role = 'Customer';
        $user->save();

        $user = new User();
        $user->name = 'Karath Marata';
        $user->tel = '0819920658';
        $user->email = 'KarathMRT@gmail.com';
        $user->password = Hash::make('741258369K');
        $user->role = 'Customer';
        $user->save();
    }
}
