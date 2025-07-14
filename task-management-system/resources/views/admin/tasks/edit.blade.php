@extends('layouts.app')

@section('content')
<div style="max-width: 800px; margin: 0 auto; padding: 20px;">
    <h1 style="color: #333; margin-bottom: 30px; font-size: 2.5rem; font-weight: bold;">Edit Task</h1>
    
    <div style="background-color: white; border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); padding: 30px;">
        <form action="{{ route('admin.tasks.update', $task) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div style="margin-bottom: 20px;">
                <label for="title" style="display: block; margin-bottom: 5px; font-weight: 500; color: #495057;">Title</label>
                <input type="text" 
                       id="title" 
                       name="title" 
                       value="{{ old('title', $task->title) }}" 
                       required
                       style="width: 100%; padding: 10px; border: 1px solid #ced4da; border-radius: 4px; font-size: 16px; transition: border-color 0.3s ease, box-shadow 0.3s ease;">
            </div>
            
            <div style="margin-bottom: 20px;">
                <label for="description" style="display: block; margin-bottom: 5px; font-weight: 500; color: #495057;">Description</label>
                <textarea id="description" 
                          name="description" 
                          rows="3"
                          style="width: 100%; padding: 10px; border: 1px solid #ced4da; border-radius: 4px; font-size: 16px; resize: vertical; transition: border-color 0.3s ease, box-shadow 0.3s ease; font-family: inherit;">{{ old('description', $task->description) }}</textarea>
            </div>
            
            <div style="margin-bottom: 20px;">
                <label for="deadline" style="display: block; margin-bottom: 5px; font-weight: 500; color: #495057;">Deadline</label>
                <input type="date" 
                       id="deadline" 
                       name="deadline" 
                       value="{{ old('deadline', $task->deadline->format('Y-m-d')) }}" 
                       required
                       style="width: 100%; padding: 10px; border: 1px solid #ced4da; border-radius: 4px; font-size: 16px; transition: border-color 0.3s ease, box-shadow 0.3s ease;">
            </div>
            
            <div style="margin-bottom: 20px;">
                <label for="user_id" style="display: block; margin-bottom: 5px; font-weight: 500; color: #495057;">Assign To</label>
                <select id="user_id" 
                        name="user_id" 
                        required
                        style="width: 100%; padding: 10px; border: 1px solid #ced4da; border-radius: 4px; font-size: 16px; background-color: white; transition: border-color 0.3s ease, box-shadow 0.3s ease;">
                    @foreach($users as $user)
                    <option value="{{ $user->id }}" 
                        {{ $user->id == old('user_id', $task->user_id) ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            
            <div style="margin-bottom: 20px;">
                <label for="status" style="display: block; margin-bottom: 5px; font-weight: 500; color: #495057;">Status</label>
                <select id="status" 
                        name="status" 
                        required
                        style="width: 100%; padding: 10px; border: 1px solid #ced4da; border-radius: 4px; font-size: 16px; background-color: white; transition: border-color 0.3s ease, box-shadow 0.3s ease;">
                    <option value="Pending" {{ old('status', $task->status) == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="In Progress" {{ old('status', $task->status) == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="Completed" {{ old('status', $task->status) == 'Completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </div>
            
            <div style="margin-top: 30px;">
                <button type="submit" 
                        style="background-color: #007bff; color: white; padding: 12px 24px; border: none; border-radius: 5px; font-size: 16px; font-weight: 500; cursor: pointer; transition: background-color 0.3s ease;">
                    Update Task
                </button>
                <a href="{{ route('admin.tasks.index') }}" 
                   style="display: inline-block; background-color: #6c757d; color: white; padding: 12px 24px; text-decoration: none; border-radius: 5px; font-size: 16px; font-weight: 500; margin-left: 10px; transition: background-color 0.3s ease;">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>

<style>
/* Input focus effects */
input:focus, textarea:focus, select:focus {
    outline: none !important;
    border-color: #007bff !important;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25) !important;
}

/* Button hover effects */
button[type="submit"]:hover {
    background-color: #0056b3 !important;
}

a[href*="tasks.index"]:hover {
    background-color: #545b62 !important;
}

/* Select dropdown styling */
select option {
    padding: 8px;
}

/* Status-specific option styling */
option[value="Pending"] {
    color: #856404;
}

option[value="In Progress"] {
    color: #0c5460;
}

option[value="Completed"] {
    color: #155724;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .container {
        padding: 10px !important;
    }
    
    input, textarea, select {
        font-size: 14px !important;
    }
    
    button, a {
        font-size: 14px !important;
        padding: 10px 20px !important;
    }
    
    h1 {
        font-size: 2rem !important;
    }
    
    .form-container {
        padding: 20px !important;
    }
}

/* Form validation styling */
input:invalid, textarea:invalid, select:invalid {
    border-color: #dc3545;
}

input:valid, textarea:valid, select:valid {
    border-color: #28a745;
}
</style>
@endsection