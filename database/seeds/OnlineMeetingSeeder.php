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
        $teacher = User::where('email', 'teacher@buginsoft.kz')->first();
        factory(TeacherOnline::class)
            ->make(['teacher_id' => $teacher->id, 'lhs'=>11, 'teacher_email' => $teacher->email])
            ->save();

        $keanu = User::where('email', 'keanu.reevs@buginsoft.kz')->first();
        factory(TeacherOnline::class)
            ->make(['teacher_id' => $keanu->id, 'level' => 8, 'teacher_email' => $keanu->email])
            ->saveOrFail();

        //keanu is in live lesson
        DB::table('t_live_lesson')->insert([
            'name' => 'daryn-001',
            'teacher_id' => $keanu->id,
            'student_id' => 100,
            'start_date' => now()
        ]);

        //matt with lhs 10
        $matt = User::where('email', 'matt.daemon@buginsoft.kz')->first();
        factory(TeacherOnline::class)
            ->make(['teacher_id' => $matt->id, 'lhs'=>10, 'teacher_email' => $matt->email])
            ->save();

        //orlando lhs 10, rating  5
        $matt = User::where('email', 'orlando.bloom@buginsoft.kz')->first();
        factory(TeacherOnline::class)
            ->make(['teacher_id' => $matt->id, 'lhs'=>10, 'teacher_email' => $matt->email, 'rating' => 4.8])
            ->save();
    }
}
