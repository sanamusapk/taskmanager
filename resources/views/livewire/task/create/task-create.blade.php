<form>
    <div class="grid grid-cols-3 gap-4 mt-2">
        <div class="form-group block w-full py-1.5">
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
            <input  wire:model="inputs.name"  value="{{$inputs['name']}}" type="text"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter Name" >
        </div>
        <div class="form-group block w-full py-1.5">
            <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type</label>
            <select  wire:model="inputs.type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected value="">Select Type</option>
                @foreach($types as $type)
                <option value="{{$type['id']}}">{{$type['name']}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group block w-full py-1.5" @if($inputs['type'] != 2) style="display:none;" @endif>
            <label for="weekly_days" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Choose Day</label>
            <select  wire:model="inputs.weekly_days" multiple class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected value="">Select Week Days</option>
                @foreach($week_days as $week_day)
                <option value="{{$week_day['id']}}">{{$week_day['name']}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group block w-full py-1.5" @if($inputs['type'] != 3 && $inputs['type'] != 4 ) style="display:none;" @endif>
            <label for="day" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Choose Day</label>
            <select  wire:model="inputs.day" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected value="">Select Day</option>
                <option value="">Select</option>
                @for($day = 1;$day<=31;$day++)
                <option value="{{$day}}">{{$day}}</option>
                @endfor
            </select>
        </div>
        <div class="form-group block w-full py-1.5" @if($inputs['type'] != 4 ) style="display:none;" @endif>
            <label for="month" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Choose Month</label>
            <select  wire:model="inputs.month" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected value="">Select Month</option>
                <option value="">Select</option>
                @for($month = 1;$month<=12;$month++)
                <option value="{{$month}}">{{$month}}</option>
                @endfor
            </select>
        </div>
        <div class="form-group block w-full py-1.5" >
            <label for="nature" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Choose Nature</label>
            <select  wire:model="inputs.nature" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected value="">Select Nature</option>
                <option value="">Select</option>
                @foreach($natures as $nature)
                <option value="{{$nature['id']}}">{{$nature['name']}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group block w-full py-1.5" @if($inputs['nature'] != 1 ) style="display:none;" @endif>
            <label for="iteration" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Iteration</label>
            <input  wire:model="inputs.iteration"  value="{{$inputs['iteration']}}" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter Iteration" >
        </div>
        <div class="form-group block w-full py-1.5" @if($inputs['nature'] != 2 )  style="display:none;" @endif>
            <label for="start_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Start Date</label>
            <input  wire:model="inputs.start_date"  type="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter Name" >
        </div>
        <div class="form-group block w-full py-1.5" @if($inputs['nature'] != 2 )  style="display:none;" @endif>
            <label for="end_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Start Date</label>
            <input  wire:model="inputs.end_date"  type="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter Name" >
        </div>
    </div>
    <div class="form-group block w-full py-1.5">
        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
        <textarea  wire:model="inputs.description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" cols="30" rows="10"></textarea>
        {{-- <input  wire:model="inputs.end_date"  type="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter Name" > --}}
    </div>
    <div class="flex">
        <button type="button"  wire:click="saveTask" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
    </div>
</form>