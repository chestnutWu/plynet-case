<?php

use Illuminate\Database\Seeder;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        //資料填充(填入第一位管理者)
        User::create([
            'name'=>'admin',
            'password'=>bcrypt('admin'),
            'type'=>'Admin',
            'email'=>'admin@gmail.com'
        ]);
    }
}
