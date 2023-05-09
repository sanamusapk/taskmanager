<?php

namespace Tests\Feature;

use App\Http\Livewire\Task\Index\TaskView;
use App\Models\User;
use Tests\TestCase;

class TommorrowTaskListTest extends TestCase
{
    public function testListTommorrowTask()
    {
        $component = new TaskView();
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post(route('user.login'), [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $this->assertAuthenticated();
        $component->getDBData();
        $tommorrow_tasks = $component->tommorrow_tasks;

        $this->assertIsObject($tommorrow_tasks);
    }
}
