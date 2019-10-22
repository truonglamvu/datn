<?php

use Illuminate\Database\Seeder;
use App\Repository\Users\UsersModel;
use Illuminate\Support\Facades\Hash;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new UsersModel();
        $user->name = "Trương Lâm Vũ";
        $user->date_of_birth = date('Y-m-d H:i:s', time());
        $user->address = "Hà Nội";
        $user->gender = 1;
       	$user->phone = "0962469879";
       	$user->email = "vutl.hust@gmail.com";
       	$user->password = Hash::make('123456');
       	$user->login_name = "truonglamvu";
       	$user->avarta = "Thai-do.jpg";
       	$user->status = 1;
       	$user->save();
       	$user->roles()->attach(7);
    }
}
