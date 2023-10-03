<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Contracts\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        DB::table('roles')->insert([
            'name' => 'super-admin',
            'guard_name' => 'web',
        ]);
        DB::table('roles')->insert([
            'name' => 'customer',
            'guard_name' => 'web',
        ]);
        
        $user=User::Create([
            'name' => 'himanshu',
            'email' => 'himanshu@test.com',
            'password' => Hash::make('1234'),
        ]); 

        $user->assignRole('super-admin');
    }
}
