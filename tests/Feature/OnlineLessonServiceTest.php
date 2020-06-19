<?php

namespace Tests\Feature;

use App\Repository\OnlineLessonRepository;
use App\Service\OnlineLessonService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OnlineLessonServiceTest extends TestCase
{
    /**
     * @var OnlineLessonService
     */
    private $service;

    protected function setUp():void
    {
        parent::setUp();

        $this->partialMock(OnlineLessonRepository::class, function($mock){
            $mock -> shouldReceive('addAcceptQueue')->once();
        });

        $this->service = $this->app->make('App\Service\OnlineLessonService');
    }

    public function testWhereLHSWins()
    {
        $teacherOnline = $this->service->getOnlineTeacher(['subject' => 'math', 'level' => 8, 'city'=>'Almaty']);
        $this->assertNotEquals('teacher@buginsoft.kz', $teacherOnline->teacher_email);
        $this->assertNotEquals('keanu.reevs@buginsoft.kz', $teacherOnline->teacher_email);
    }

    public function testWhereRatingWins()
    {
        $teacherOnline = $this->service->getOnlineTeacher(['subject' => 'math', 'level' => 8, 'city'=>'Almaty', 'rating' => 4.5]);
        $this->assertNotEquals('matt.daemon@buginsoft.kz', $teacherOnline->teacher_email);
        $this->assertEquals('orlando.bloom@buginsoft.kz', $teacherOnline->teacher_email);
    }

    public function testWhereTooHighRatingIsRequested()
    {
        $teacherOnline = $this->service->getOnlineTeacher(['subject' => 'math', 'level' => 8, 'city'=>'Almaty', 'rating' => 5.1]);
        $this->assertNotEquals('matt.daemon@buginsoft.kz', $teacherOnline->teacher_email);
        $this->assertEquals('orlando.bloom@buginsoft.kz', $teacherOnline->teacher_email);
    }
}
