<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insertOrIgnore([
            'name' => 'Бәйдібек Нұрланұлы',
            'email' => 'teacher@buginsoft.kz',
            'password' => Hash::make('12345678'),
        ]);

        DB::table('users')->insertOrIgnore([
            'name' => 'Тұран Мұрал',
            'email' => 'student@buginsoft.kz',
            'password' => Hash::make('12345678'),
            'is_teacher' => false
        ]);

        DB::table('users')->insertOrIgnore([
            'name' => 'Keanu Reevs',
            'email' => 'keanu.reevs@buginsoft.kz',
            'password' => Hash::make('12345678')
        ]);

        DB::table('users')->insertOrIgnore([
            'name' => 'Matt Daemon',
            'email' => 'matt.daemon@buginsoft.kz',
            'password' => Hash::make('12345678')
        ]);

        DB::table('users')->insertOrIgnore([
            'name' => 'Orlando Bloom',
            'email' => 'orlando.bloom@buginsoft.kz',
            'password' => Hash::make('12345678')
        ]);
    }
}
