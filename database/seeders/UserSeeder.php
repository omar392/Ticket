<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Customer Man 1',
            'user_type' => 'customer',
            'email' => 'customer1@ticket.com',
            'phone' => '0560258430',
            'google_token' => '0000xxx0000',
            'password' => bcrypt('123456')

        ]);
        User::create([
            'name' => 'Employee Man 1',
            'user_type' => 'employee',
            'email' => 'employee1@ticket.com',
            'phone' => '01067747215',
            'google_token' => '0000xdxx0000',
            'password' => bcrypt('123456')

        ]);
        User::create([
            'name' => 'Customer Man 2',
            'user_type' => 'customer',
            'email' => 'customer2@ticket.com',
            'phone' => '0502150220',
            'google_token' => '0000xxx0000',
            'password' => bcrypt('123456')

        ]);
        User::create([
            'name' => 'Employee Man 2',
            'user_type' => 'employee',
            'email' => 'employee2@ticket.com',
            'phone' => '01063938132',
            'google_token' => '0000xdxx0000',
            'password' => bcrypt('123456')

        ]);
    }
}
