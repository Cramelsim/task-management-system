@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Task</h1>
    
    <form action="{{ route('admin.tasks.update', $task) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" 
                   value="{{ old('title', $task->title) }}" required>
        </div>
        
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3">
                {{ old('description', $task->description) }}
            </textarea>
        </div>
        
        <div class="mb-3">
            <label for="deadline" class="form-label">Deadline</label>
            <input type="date" class="form-control" id="deadline" name="deadline" 
                   value="{{ old('deadline', $task->deadline->format('Y-m-d')) }}" required>
        </div>
        
        <div class="mb-3">
            <label for="user_id" class="form-label">Assign To</label>
            <select class="form-select" id="user_id" name="user_id" required>
                @foreach($users as $user)
                <option value="{{ $user->id }}" 
                    {{ $user->id == old('user_id', $task->user_id) ? 'selected' : '' }}>
                    {{ $user->name }}
                </option>
                @endforeach
            </select>
        </div>
        
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" id="status" name="status" required>
                <option value="Pending" {{ old('status', $task->status) == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="In Progress" {{ old('status', $task->status) == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                <option value="Completed" {{ old('status', $task->status) == 'Completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary">Update Task</button>
        <a href="{{ route('admin.tasks.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection