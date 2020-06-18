<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ApiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testLHS()
    {
        $response = $this->call('GET', route('lesson.request', ['subject' => 'math', 'level' => 8]))
            ->assertJsonMissing(['teacher_email'=> 'teacher@buginsoft.kz'])
            ->assertJsonMissing(['teacher_email'=>'keanu.reevs@buginsoft.kz'])
            ->assertJsonFragment(['teacher_email'=>'matt.daemon@buginsoft.kz'])
            ->assertStatus(200);
    }
}
