<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('students')->insert([
            [
            'name' => 'Ian Belarmino',
            'email' => '0322-2070@lspu.edu.ph',
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now(),
         ],
            [
                'name' => 'Gideon Alcantanga',
                'email' => '0322-2071@lspu.edu.ph',
                'password' => Hash::make('bigboss'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                 'name' => 'Andrew Cauyan',
                'email' => '0322-2076@lspu.edu.ph',
                'password' => Hash::make('andrewpogi'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kasandra Habagat',
                'email' => '0322-2082@lspu.edu.ph',
                'password' => Hash::make('jeanroxanne'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hart Lawrence Binay',
                'email' => '0322-2069@lspu.edu.ph',
                'password' => Hash::make('bignanay'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
    ]);
        
    }
}
