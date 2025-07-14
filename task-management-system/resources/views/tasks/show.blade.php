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
                    <div class="space-y-6">
                        @foreach($tasks as $task)
                        <div class="border rounded-lg p-6 bg-gray-50">
                            <div class="flex justify-between items-start mb-4">
                                <div class="flex-1">
                                    <h3 class="text-lg font-semibold text-gray-900">{{ $task->title }}</h3>
                                    <div class="flex items-center gap-4 mt-2">
                                        <span class="text-sm text-gray-600">
                                            <strong>Due:</strong> {{ $task->deadline->format('M d, Y') }}
                                        </span>
                                        @if($task->created_at)
                                        <span class="text-sm text-gray-600">
                                            <strong>Created:</strong> {{ $task->created_at->format('M d, Y') }}
                                        </span>
                                        @endif
                                    </div>
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
                            
                            @if($task->description)
                            <div class="mt-4">
                                <h4 class="text-sm font-medium text-gray-700 mb-2">Description:</h4>
                                <div class="bg-white p-4 rounded border">
                                    <p class="text-gray-700 whitespace-pre-line">{{ $task->description }}</p>
                                </div>
                            </div>
                            @endif
                            
                            {{-- Additional task details you might want to show --}}
                            @if($task->priority)
                            <div class="mt-3">
                                <span class="text-sm font-medium text-gray-700">Priority: </span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ $task->priority == 'High' ? 'bg-red-100 text-red-800' : 
                                       ($task->priority == 'Medium' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800') }}">
                                    {{ $task->priority }}
                                </span>
                            </div>
                            @endif
                            
                            @if($task->assigned_by)
                            <div class="mt-2">
                                <span class="text-sm text-gray-600">
                                    <strong>Assigned by:</strong> {{ $task->assignedBy->name ?? 'Unknown' }}
                                </span>
                            </div>
                            @endif
                            
                            @if($task->category)
                            <div class="mt-2">
                                <span class="text-sm text-gray-600">
                                    <strong>Category:</strong> {{ $task->category }}
                                </span>
                            </div>
                            @endif
                            
                            <div class="mt-3 pt-3 border-t border-gray-200">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ $task->status == 'Completed' ? 'bg-green-100 text-green-800' : 
                                       ($task->status == 'In Progress' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800') }}">
                                    {{ $task->status }}
                                </span>
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