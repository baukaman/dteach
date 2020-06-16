<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\TeacherOnline;
use Faker\Generator as Faker;

$factory->define(TeacherOnline::class, function (Faker $faker) {
    return [
        'name' => 'mr. nobody',
        'teacher_id' => 0,
        'subject' => 'math',
        'level' => 8,
        'city' => 'Almaty',
        'lhs' => 0
    ];
});
