@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="p-6">
                <div class="mb-6">
                    <h1 class="text-2xl font-bold">User Profile</h1>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Name</h3>
                        <p class="mt-1 text-lg">{{ $user->name }}</p>
                    </div>
                    
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Email</h3>
                        <p class="mt-1 text-lg">{{ $user->email }}</p>
                    </div>
                    
                    @if($user->is_admin)
                    <div class="md:col-span-2">
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            Administrator
                        </span>
                    </div>
                    @endif
                </div>
                
                <div class="mt-8">
                    <h2 class="text-xl font-semibold mb-4">Your Tasks</h2>
                    @if($tasks->count() > 0)
                        <div class="space-y-4">
                            @foreach($tasks as $task)
                            <div class="border rounded-lg p-4">
                                <div class="flex justify-between items-start">
                                    <div class="flex-1">
                                        <h3 class="font-medium">{{ $task->title }}</h3>
                                        <p class="text-sm text-gray-500 mt-1">Due: {{ $task->deadline->format('M d, Y') }}</p>
                                        
                                        <!-- Display task details directly -->
                                        <div class="mt-2 text-sm text-gray-600">
                                            <p><strong>Description:</strong> {{ $task->description }}</p>
                                            <p class="mt-1"><strong>Status:</strong> 
                                                <span class="px-2 py-1 rounded text-xs
                                                    @if($task->status === 'Pending') bg-yellow-100 text-yellow-800
                                                    @elseif($task->status === 'In Progress') bg-blue-100 text-blue-800
                                                    @else bg-green-100 text-green-800 @endif">
                                                    {{ $task->status }}
                                                </span>
                                            <!-- </p>
                                            @if($task->priority)
                                            <p class="mt-1"><strong>Priority:</strong> {{ $task->priority }}</p>
                                            @endif -->
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <!-- Status dropdown for updating -->
                                        <form action="{{ route('tasks.updateStatus', $task) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <select name="status" onchange="this.form.submit()" class="px-2 py-1 rounded text-xs border
                                                @if($task->status === 'Pending') bg-yellow-100 text-yellow-800 border-yellow-300
                                                @elseif($task->status === 'In Progress') bg-blue-100 text-blue-800 border-blue-300
                                                @else bg-green-100 text-green-800 border-green-300 @endif">
                                                <option value="Pending" {{ $task->status === 'Pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="In Progress" {{ $task->status === 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                                <option value="Completed" {{ $task->status === 'Completed' ? 'selected' : '' }}>Completed</option>
                                            </select>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500">No tasks assigned to you yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection