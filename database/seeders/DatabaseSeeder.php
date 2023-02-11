<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Role::create(
            [
            'name' => 'Developer',
            'slug'=>Str::random(30),
            ]
          );
        Role::create(
            [
            'name' => 'renter',
            'slug'=>Str::random(30),
            ]
          );

        User::create([
                'name'=>'Developer',
                'email'=>'developer@gmail.com',
                'account'=>'developer',
                'email_verified_at'=>now(),
                'password'=>Hash::make('password'),
                'role_id'=>1,
                
        ]);
    
    }
}
