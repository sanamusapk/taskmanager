<?php

namespace App\Http\Livewire\Task\Create;

use App\Helpers\TaskHelpers;
use Livewire\Component;

class TaskCreate extends Component
{

    public $types = [
        ['id' => 1 , 'name' => 'Daily'],
        ['id' => 2 , 'name' => 'Weekly'],
        ['id' => 3 , 'name' => 'Monthly'],
        ['id' => 4 , 'name' => 'Yearly'],
    ];

    public $week_days = [
        ['id' => 1, 'name' => 'Monday'],
        ['id' => 2, 'name' => 'Tuesday'],
        ['id' => 3, 'name' => 'Wednesday'],
        ['id' => 4, 'name' => 'Thursday'],
        ['id' => 5, 'name' => 'Friday'],
        ['id' => 6, 'name' => 'Saturday'],
        ['id' => 7, 'name' => 'Sunday'],
    ];


    public $natures= [
        ['id' => 1 , 'name' => 'Iteration'],
        ['id' => 2 , 'name' => 'Dates']
    ];

    public $inputs = [
        'name' => null,
        'type' => null,
        'weekly_days' => [],
        'day' => null,
        'month' => null,
        'nature' => null,
        'iteration' => null,
        'start_date' => null,
        'end_date' => null,
        'description' => ''
    ];

    protected TaskHelpers $taskHelpers;

    public function render()
    {
        return view('livewire.task.create.task-create');
    }

    public function saveTask()
    {

        $this->taskHelpers = new TaskHelpers();
        $this->taskHelpers->store($this->inputs);
        
        return redirect()->route('task.index');
    }

}
