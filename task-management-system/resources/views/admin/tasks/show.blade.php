@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>{{ $task->title }}</h2>
            <span class="badge 
                @if($task->status == 'Pending') bg-warning
                @elseif($task->status == 'In Progress') bg-info
                @else bg-success @endif">
                {{ $task->status }}
            </span>
        </div>
        
        <div class="card-body">
            <p><strong>Description:</strong> {{ $task->description }}</p>
            <p><strong>Deadline:</strong> {{ $task->deadline->format('M d, Y') }}</p>
            <p><strong>Assigned by:</strong> {{ $task->creator->name }}</p>
            
            <form action="{{ route('tasks.update-status', $task) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="mb-3">
                    <label for="status" class="form-label">Update Status</label>
                    <select name="status" id="status" class="form-select">
                        <option value="Pending" {{ $task->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="In Progress" {{ $task->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="Completed" {{ $task->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update Status</button>
            </form>
        </div>
    </div>
</div>
@endsection