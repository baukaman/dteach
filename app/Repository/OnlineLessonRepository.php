<?php


namespace App\Repository;

use App\Models\TeacherOnline;
use App\Models\TeacherPage;
use Illuminate\Support\Facades\DB;

class OnlineLessonRepository
{

    public function onlineTeachers($subject, $level){
        $users = Db::table('t_teacher_online')
            ->whereNotExists(function($query) {
                $query -> select(DB::raw(1))
                    -> from('t_live_lesson')
                    -> whereRaw('t_teacher_online.teacher_id = t_live_lesson.teacher_Id');
            })
            ->whereNotExists(function($query){
                $query -> select(DB::raw(1))
                    -> from('t_teacher_accept')
                    -> whereRaw('t_teacher_online.teacher_id = t_teacher_accept.teacher_Id');
            })
            ->where(['subject' => $subject, 'level' => $level])
            ->get();

        return $users;
    }

    /**
     * @param $teacherOnline TeacherOnline
     */
    public function addAcceptQueue($teacherOnline)
    {
        factory(\App\Models\TeacherAccept::class)->make([
            'teacher_id' => $teacherOnline->teacher_id
        ])->save();
    }

    public function connectTeacher($teacher_id, $uuid)
    {
        factory(TeacherPage::class)->make([
            'teacher_id' => $teacher_id,
            'page_id' => $uuid
        ])->save();
    }

    public function disconnectTeacher($teacher_id, $uuid)
    {
        TeacherPage::where([['teacher_id', '=', $teacher_id], ['page_id', '=', $uuid]])->delete();
    }
}
