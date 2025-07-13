@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Task</h1>
    
    <form action="{{ route('admin.tasks.store') }}" method="POST">
        @csrf
        
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
        </div>
        
        <div class="mb-3">
            <label for="deadline" class="form-label">Deadline</label>
            <input type="date" class="form-control" id="deadline" name="deadline" required min="{{ date('Y-m-d') }}">
        </div>
        
        <div class="mb-3">
            <label for="user_id" class="form-label">Assign To</label>
            <select class="form-select" id="user_id" name="user_id" required>
                <option value="">Select User</option>
                @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary">Create Task</button>
    </form>
</div>
@endsection