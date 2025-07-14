@extends('layouts.app')

@section('content')
<div style="max-width: 1200px; margin: 0 auto; padding: 20px;">
    <h1 style="color: #333; margin-bottom: 30px; font-size: 2.5rem; font-weight: bold;">Manage Tasks</h1>
    
    <a href="{{ route('admin.tasks.create') }}" 
       style="display: inline-block; background-color: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; margin-bottom: 20px; font-weight: 500; transition: background-color 0.3s ease;">
        Create Task
    </a>

    <div style="background-color: white; border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        <div style="padding: 20px;">
            <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
                <thead>
                    <tr style="background-color: #f8f9fa; border-bottom: 2px solid #dee2e6;">
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: #495057;">Title</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: #495057;">Assigned To</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: #495057;">Deadline</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: #495057;">Status</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: #495057;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                    <tr style="border-bottom: 1px solid #dee2e6;">
                        <td style="padding: 12px; color: #495057;">{{ $task->title }}</td>
                        <td style="padding: 12px; color: #495057;">{{ $task->user->name }}</td>
                        <td style="padding: 12px; color: #495057;">{{ $task->deadline->format('M d, Y') }}</td>
                        <td style="padding: 12px;">
                            <span style="padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 500; color: white;
                                @if($task->status == 'Pending') background-color: #ffc107;
                                @elseif($task->status == 'In Progress') background-color: #17a2b8;
                                @else background-color: #28a745; @endif">
                                {{ $task->status }}
                            </span>
                        </td>
                        <td style="padding: 12px;">
                            <a href="{{ route('admin.tasks.edit', $task) }}" 
                               style="display: inline-block; background-color: #007bff; color: white; padding: 6px 12px; text-decoration: none; border-radius: 4px; font-size: 14px; margin-right: 8px; transition: background-color 0.3s ease;">
                                Edit
                            </a>
                            <form action="{{ route('admin.tasks.destroy', $task) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        style="background-color: #dc3545; color: white; padding: 6px 12px; border: none; border-radius: 4px; font-size: 14px; cursor: pointer; transition: background-color 0.3s ease;"
                                        onclick="return confirm('Are you sure you want to delete this task?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            <div style="margin-top: 20px;">
                {{ $tasks->links() }}
            </div>
        </div>
    </div>
</div>

<style>
/* Hover effects for buttons */
a[href*="tasks.create"]:hover {
    background-color: #0056b3 !important;
}

a[href*="tasks.edit"]:hover {
    background-color: #0056b3 !important;
}

button[type="submit"]:hover {
    background-color: #c82333 !important;
}

/* Table row hover effect */
tbody tr:hover {
    background-color: #f8f9fa;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    table {
        font-size: 14px;
    }
    
    th, td {
        padding: 8px !important;
    }
    
    .container {
        padding: 10px !important;
    }
}
</style>
@endsection