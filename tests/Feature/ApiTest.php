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
    public function testExample()
    {
        $response = $this->call('GET', route('lesson.request', ['subject' => 'math', 'level' => 8]))
            ->assertJsonFragment(['teacher_id'=>10])
            ->assertJsonMissing(['teacher_id'=>12])
            ->assertStatus(200);
    }
}
