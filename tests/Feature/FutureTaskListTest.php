<?php

namespace Tests\Feature;

use App\Http\Livewire\Task\Index\TaskView;
use App\Models\User;
use Tests\TestCase;

class FutureTaskListTest extends TestCase
{
    public function testListFutureTask()
    {
        $component = new TaskView();

        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('user.login'), [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();

        $component->getDBData();

        $future_tasks = $component->future_tasks;

        $this->assertIsObject($future_tasks);
    }
}
