<?php

namespace Tests\Feature;

use App\Http\Livewire\Task\Index\TaskView;
use App\Models\User;
use Tests\TestCase;

class NextWeekTasksListTest extends TestCase
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
        $next_week_tasks = $component->next_week_tasks;

        $this->assertIsObject($next_week_tasks);
    }
}
