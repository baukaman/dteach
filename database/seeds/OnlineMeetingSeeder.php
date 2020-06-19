<?php

use App\Models\TeacherOnline;
use App\Models\TeacherPage;
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

        factory(TeacherPage::class)
            ->make(['teacher_id'=>$teacher->id, 'page_id' => '423kf-3kld'])
            ->save();

        $keanu = User::where('email', 'keanu.reevs@buginsoft.kz')->first();
        factory(TeacherOnline::class)
            ->make(['teacher_id' => $keanu->id, 'level' => 8, 'teacher_email' => $keanu->email])
            ->saveOrFail();

        factory(TeacherPage::class)
            ->make(['teacher_id'=>$keanu->id, 'page_id' => 'rf42e-993f'])
            ->save();

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

        factory(TeacherPage::class)
            ->make(['teacher_id'=>$matt->id, 'page_id' => 'fe678f-r42fu'])
            ->save();

        //orlando lhs 10, with relatively high rating
        $orlando = User::where('email', 'orlando.bloom@buginsoft.kz')->first();
        factory(TeacherOnline::class)
            ->make(['teacher_id' => $orlando->id, 'lhs'=>10, 'teacher_email' => $orlando->email, 'rating' => 4.8])
            ->save();

        factory(TeacherPage::class)
            ->make(['teacher_id'=>$orlando->id, 'page_id' => 'gl421-3fsx'])
            ->save();
    }
}
