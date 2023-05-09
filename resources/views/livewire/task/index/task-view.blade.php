
<div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
    <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
            <li class="mr-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg {{$tab != 'today'?'border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300':''}}" wire:click="moveTab('today')" id="profile-tab" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Today Task</button>
            </li>
            <li class="mr-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg {{$tab != 'tommorrow'?'border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300':''}}" wire:click="moveTab('tommorrow')"  id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">Tommorrow Task</button>
            </li>
            <li class="mr-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg {{$tab != 'next_week'?'border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300':''}}" wire:click="moveTab('next_week')" id="settings-tab" data-tabs-target="#settings" type="button" role="tab" aria-controls="settings" aria-selected="false">Next Week Task</button>
            </li>
            <li role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg {{$tab != 'second_next'?'border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300':''}}" wire:click="moveTab('second_next')" id="contacts-tab" data-tabs-target="#contacts" type="button" role="tab" aria-controls="contacts" aria-selected="false">Second Next Task</button>
            </li>
            <li role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg {{$tab != 'future'?'border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300':''}}" id="future-tab"  wire:click="moveTab('future')" data-tabs-target="#future" type="button" role="tab" aria-controls="future" aria-selected="false">Future Task</button>
            </li>
        </ul>
    </div>
    <div id="myTabContent">
        <div class="{{$tab == 'today'?'': 'hidden'}} p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            @include('livewire.task.index.partials.today_tasks')
        </div>
        <div class="{{$tab == 'tommorrow'?'': 'hidden'}}  p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
            @include('livewire.task.index.partials.tommorrow_tasks')
        </div>
        <div class="{{$tab == 'next_week'?'': 'hidden'}} p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="settings" role="tabpanel" aria-labelledby="settings-tab">
            @include('livewire.task.index.partials.next_week_tasks')
        </div>
        <div class="{{$tab == 'second_next'?'': 'hidden'}} p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="contacts" role="tabpanel" aria-labelledby="contacts-tab">
            @include('livewire.task.index.partials.second_next_tasks')
        </div>
        <div class="{{$tab == 'future'?'': 'hidden'}} p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="future" role="tabpanel" aria-labelledby="future-tab">
            @include('livewire.task.index.partials.future_tasks')
        </div>
    </div>
</div>