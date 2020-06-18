<?php

namespace App\Http\Controllers;

use App\Models\TeacherOnline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function lessonRequest(Request $request){
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
            ->where(['subject' => $request->subject, 'level' => $request->level])
            ->get();

        if($users->count() < 1) {
            throw new \Exception('no.teachers.available');
        } else {
            $cConstraint = $users->filter(function($value, $key) use($request) {
                return $value->city != $request->city;
            });

            if($cConstraint->count() < 1)
                $cConstraint = $users;

            $lhsConstraint = $cConstraint->sortBy(function($a) {
                return $a->lhs;
            });

            $baseLhs = $lhsConstraint->values() -> get(0) -> lhs;
            $lhsConstraint = $lhsConstraint->filter(function($teacher) use ($baseLhs) {
               return  $teacher->lhs == $baseLhs;
            });

            $baseRating = $request->rating ?? 0.0;
            $rConstraint = $lhsConstraint -> filter(function($t) use ($baseRating) {
                return $t->rating >= $baseRating;
            });

            if($rConstraint -> count() > 0 ) {
                $rConstraint = $rConstraint->sortBy(function($t) { return $t->rating; });
            } else {
                $rConstraint = $lhsConstraint->sortByDesc(function($t) {return $t->rating;});
            }

            return response()->json($rConstraint->values()->get(0));
        }
    }

/**
* Store a newly created resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @return \Illuminate\Http\Response
*/
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
