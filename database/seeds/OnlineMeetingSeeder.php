<?php

use App\Models\TeacherOnline;
use App\User;
use Illuminate\Database\Seeder;

class OnlineMeetingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(TeacherOnline::class)
            ->make(['teacher_id' => User::where('email', 'teacher@buginsoft.kz')->first()->id])
            ->save();

        $keanu = User::where('email', 'keanu.reevs@buginsoft.kz')->first();
        factory(TeacherOnline::class)
            ->make(['teacher_id' => $keanu->id, 'level' => 8])
            ->save();

        //keanu is in live lesson
        DB::table('t_live_lesson')->insert([
            'name' => 'daryn-001',
            'teacher_id' => $keanu->id,
            'student_id' => 100,
            'start_date' => now()
        ]);
    }
}
