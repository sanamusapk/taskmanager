<div class="relative overflow-x-auto">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Type
                </th>
                <th scope="col" class="px-6 py-3">
                    Nature
                </th>
                <th scope="col" class="px-6 py-3">
                    Status
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($future_tasks as $future_task)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{$future_task->name}}
                </th>
                <td class="px-6 py-4">
                    {{$future_task->getType()}}
                </td>
                <td class="px-6 py-4">
                    {{$future_task->getNature()}}
                </td>
                <td class="px-6 py-4">
                    @if ($future_task->status)
                        <span class="badge badge-success">Completed</span>      
                    @else
                        <span class="badge badge-danger">Pending</span>                                                      
                    @endif
                </td>
                <td class="px-6 py-4">
                    @if($future_task->status)
                        <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" wire:click="updateTask({{$future_task->id}},'0')">Mark as Pending</button>
                    @else
                        <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" wire:click="updateTask({{$future_task->id}},'1')">Mark as Complete</button>
                    @endif  
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>