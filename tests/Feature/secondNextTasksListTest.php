<?php

namespace Tests\Feature;

use App\Http\Livewire\Task\Index\TaskView;
use App\Models\Task;
use App\Models\User;
use Tests\TestCase;

class secondNextTasksListTest extends TestCase
{
    public function testListNextWeekTask()
    {
        $component = new TaskView();
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post(route('user.login'), [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $this->assertAuthenticated();
        $component->getDBData();
        $second_next_tasks = $component->second_next_tasks;

        $this->assertIsObject($second_next_tasks);
    }
}
