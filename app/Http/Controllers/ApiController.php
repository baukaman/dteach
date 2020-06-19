<?php

namespace App\Http\Controllers;

use App\Models\TeacherOnline;
use App\Repository\OnlineLessonRepository;
use App\Service\OnlineLessonService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{

    /**
     * @var OnlineLessonRepository
     */
    private $repository;
    /**
     * @var OnlineLessonService
     */
    private $service;

    public function __construct(OnlineLessonRepository $repository, OnlineLessonService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

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
        $onlineTeacher = $this->service->getOnlineTeacher($request->all());
        $page = $this->repository->getTeacherPage($onlineTeacher);
        return response()->json($page);
    }

    public function connectTeacher(Request $request){
        $this->repository->connectTeacher($request->teacher_id, $request->page_id);
    }

    public function disconnectTeacher(Request $request) {
        $this->repository->disconnectTeacher($request->teacher_id, $request->page_id);
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
