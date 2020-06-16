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

    return response()->json($users);
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
