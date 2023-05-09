<?php

namespace Tests\Feature;

use App\Http\Livewire\Task\Index\TaskView;
use App\Models\User;
use Tests\TestCase;

class TodayTaskListTest extends TestCase
{
    public function testListTodayTask()
    {
        $component = new TaskView();

        $user = User::factory()->create();
        $response = $this->actingAs($user)->post(route('user.login'), [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $this->assertAuthenticated();
        $component->getDBData();
        $today_tasks = $component->today_tasks;

        $this->assertIsObject($today_tasks);
    }
}
