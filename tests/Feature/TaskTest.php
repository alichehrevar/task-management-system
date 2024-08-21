<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Morilog\Jalali\Jalalian;
use Tests\TestCase;

class TaskTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testTaskCreation()
    {
        $response = $this->post('/tasks', [
            'title' => 'Test Task',
            'description' => 'Test Description',
            'due_date' => '1402/06/31', // Persian date
            'priority' => 'high',
            'status' => 'pending',
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('tasks', [
            'title' => 'Test Task',
            'due_date' => Jalalian::fromFormat('Y/m/d', '1402/06/31')->toCarbon(),
        ]);
    }
}
