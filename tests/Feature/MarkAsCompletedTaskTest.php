<?php

namespace Tests\Feature;

use App\Http\Livewire\Task\Index\TaskView;
use App\Models\Task;
use App\Models\User;
use Tests\TestCase;

class MarkAsCompletedTaskTest extends TestCase
{
    public function testMarkAsCompleteTask()
    {
        $task = Task::factory()->create();
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('user.login'), [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $component = new TaskView();

        $component->updateTask($task->id,true);

        $this->assertTrue($task->fresh()->status ? true : false);
    }
}
