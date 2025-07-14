@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="p-6">
                <h1 class="text-2xl font-bold mb-6">My Profile</h1>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Name</h3>
                        <p class="mt-1 text-lg">{{ $user->name }}</p>
                    </div>
                    
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Email</h3>
                        <p class="mt-1 text-lg">{{ $user->email }}</p>
                    </div>
                </div>

                <h2 class="text-xl font-semibold mb-4">My Tasks</h2>
                @if($tasks->count() > 0)
                    <div class="space-y-4">
                        @foreach($tasks as $task)
                        <div class="border rounded-lg p-4">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <h3 class="font-medium">{{ $task->title }}</h3>
                                    <p class="text-sm text-gray-500 mt-1">Due: {{ $task->deadline->format('M d, Y') }}</p>
                                    
                                    @if($task->description)
                                    <div class="mt-3 p-3 bg-gray-50 rounded">
                                        <p class="text-gray-700 whitespace-pre-line">{{ $task->description }}</p>
                                    </div>
                                    @endif
                                </div>
                                
                                <form action="{{ route('tasks.update-status', $task) }}" method="POST" class="ml-4">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" onchange="this.form.submit()" 
                                        class="text-xs rounded border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                        <option value="Pending" {{ $task->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="In Progress" {{ $task->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                        <option value="Completed" {{ $task->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                    </select>
                                </form>
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
@endsection