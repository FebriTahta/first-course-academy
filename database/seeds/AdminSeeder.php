<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'name' => 'febri rizqi',
            'role' => 'admin',
            'stat' => '1',
            'email' => 'febrirtah@gmail.com',            
            'password' => bcrypt('secret123'),            
        ]);
    }
}
