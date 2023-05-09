<?php

namespace Tests\Feature;

use App\Models\Task;
use Carbon\Carbon;
use Tests\TestCase;

class CreateNewTaskTest extends TestCase
{
    /**
     * A basic test to create task.
     */
    public function testCreateNewTask()
    {
        $task = Task::create([
            'name' => 'Task 1',
            'type' => 1,
            'nature' => 1,
            'iteration' => '30',
            'description' => 'This is Test tak',
            'user_id' => 1
        ]);

        $this->assertNotNull($task->id);
        $this->assertIsObject($task);

    }
}
