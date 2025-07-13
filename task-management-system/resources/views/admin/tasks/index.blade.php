@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Manage Tasks</h1>
    <a href="{{ route('admin.tasks.create') }}" class="btn btn-primary mb-3">Create Task</a>

    <div class="card">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Assigned To</th>
                        <th>Deadline</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                    <tr>
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->user->name }}</td>
                        <td>{{ $task->deadline->format('M d, Y') }}</td>
                        <td>
                            <span class="badge 
                                @if($task->status == 'Pending') bg-warning
                                @elseif($task->status == 'In Progress') bg-info
                                @else bg-success @endif">
                                {{ $task->status }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.tasks.edit', $task) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('admin.tasks.destroy', $task) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $tasks->links() }}
        </div>
    </div>
</div>
@endsection