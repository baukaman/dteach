<?php

use App\Models\TeacherOnline;
use App\User;
use Illuminate\Database\Seeder;

class OnlineTeacher extends Seeder
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
            ->make(['teacher_id' => $teacher->id])
            ->save();
    }
}
