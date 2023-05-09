<?php

namespace App\Http\Livewire\Task\Index;

use App\Helpers\TaskHelpers;
use App\Models\Task;
use Livewire\Component;

class TaskView extends Component
{

    public $today_tasks = [];

    public $tommorrow_tasks = [];

    public $next_week_tasks = [];

    public $second_next_tasks = [];

    public $future_tasks = [];

    public $tab = 'today';

    protected TaskHelpers $taskHelpers;

    public function render()
    {
        return view('livewire.task.index.task-view');
    }

    public function mount()
    {
        $this->getDBData();
    }

    public function getDBData()
    {
        $this->taskHelpers = new TaskHelpers();
        $this->today_tasks =  $this->taskHelpers->todayTasks();
        $this->tommorrow_tasks =  $this->taskHelpers->tommorrowTasks();
        $this->next_week_tasks =  $this->taskHelpers->nextWeekTasks();
        $this->second_next_tasks =  $this->taskHelpers->secondNextTasks();
        $this->future_tasks =  $this->taskHelpers->futureTasks();
    }
    
    public function updateTask($task_id,$status)
    {
        $this->taskHelpers = new TaskHelpers();
        $this->taskHelpers->update($task_id,$status);
        $this->getDBData();
    }

    public function moveTab($tab)
    {
        $this->tab = $tab;
    }

}
