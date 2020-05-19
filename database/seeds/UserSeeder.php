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
        DB::table('users')->insert([
            'name' => 'Бәйдібек Нұрланұлы',
            'email' => 'teacher@buginsoft.kz',
            'password' => Hash::make('12345678'),
        ]);

        DB::table('users')->insert([
            'name' => 'Тұран Мұрал',
            'email' => 'student@buginsoft.kz',
            'password' => Hash::make('12345678'),
            'is_teacher' => false
        ]);
    }
}
