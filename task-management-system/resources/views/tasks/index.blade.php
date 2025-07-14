@extends('layouts.app')

@section('content')
<style>
    /* Custom CSS for Task Management */
    .task-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem 1rem;
        min-height: 100vh;
        background-color: #f8fafc;
    }
    
    .task-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        flex-wrap: wrap;
        gap: 1rem;
    }
    
    .task-header h1 {
        font-size: 2rem;
        font-weight: 700;
        color: #1f2937;
        margin: 0;
    }
    
    .task-header p {
        color: #6b7280;
        margin: 0.5rem 0 0 0;
        font-size: 0.95rem;
    }
    
    .add-task-btn {
        display: inline-flex;
        align-items: center;
        padding: 0.75rem 1.5rem;
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        color: white;
        text-decoration: none;
        border-radius: 0.5rem;
        font-weight: 600;
        transition: all 0.2s ease;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }
    
    .add-task-btn:hover {
        background: linear-gradient(135deg, #1d4ed8 0%, #1e40af 100%);
        transform: translateY(-2px);
        box-shadow: 0 8px 15px -3px rgba(0, 0, 0, 0.2);
        color: white;
        text-decoration: none;
    }
    
    .add-task-btn svg {
        margin-right: 0.5rem;
        width: 20px;
        height: 20px;
    }
    
    .table-container {
        background: white;
        border-radius: 0.75rem;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        border: 1px solid #e5e7eb;
    }
    
    .table-wrapper {
        overflow-x: auto;
    }
    
    .tasks-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .tasks-table thead {
        background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
    }
    
    .tasks-table th {
        padding: 1rem 1.5rem;
        text-align: left;
        font-size: 0.75rem;
        font-weight: 600;
        color: #374151;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        border-bottom: 1px solid #e5e7eb;
    }
    
    .tasks-table th:last-child {
        text-align: right;
    }
    
    .tasks-table tbody tr {
        border-bottom: 1px solid #f3f4f6;
        transition: all 0.2s ease;
    }
    
    .tasks-table tbody tr:hover {
        background-color: #eff6ff;
    }
    
    .tasks-table td {
        padding: 1.25rem 1.5rem;
        vertical-align: middle;
    }
    
    .task-title {
        font-size: 0.875rem;
        font-weight: 600;
        color: #111827;
        transition: color 0.2s ease;
    }
    
    .tasks-table tbody tr:hover .task-title {
        color: #1e40af;
    }
    
    .user-info {
        display: flex;
        align-items: center;
    }
    
    .user-avatar {
        width: 2rem;
        height: 2rem;
        border-radius: 50%;
        background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 0.875rem;
        font-weight: 500;
        margin-right: 0.75rem;
    }
    
    .user-name {
        font-size: 0.875rem;
        font-weight: 500;
        color: #374151;
    }
    
    .deadline-info {
        display: flex;
        align-items: center;
    }
    
    .deadline-icon {
        width: 2rem;
        height: 2rem;
        border-radius: 50%;
        background-color: #f3f4f6;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 0.75rem;
    }
    
    .deadline-icon svg {
        width: 1rem;
        height: 1rem;
        color: #6b7280;
    }
    
    .deadline-date {
        font-weight: 500;
        color: #374151;
        font-size: 0.875rem;
        margin-bottom: 0.125rem;
    }
    
    .deadline-relative {
        font-size: 0.75rem;
        color: #6b7280;
    }
    
    .status-badge {
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
        border: 1px solid;
        display: inline-block;
    }
    
    .status-pending {
        background-color: #fef3c7;
        color: #92400e;
        border-color: #fbbf24;
    }
    
    .status-progress {
        background-color: #dbeafe;
        color: #1e40af;
        border-color: #3b82f6;
    }
    
    .status-completed {
        background-color: #d1fae5;
        color: #065f46;
        border-color: #10b981;
    }
    
    .actions-container {
        display: flex;
        justify-content: flex-end;
        gap: 0.75rem;
    }
    
    .action-btn {
        display: inline-flex;
        align-items: center;
        padding: 0.5rem 0.75rem;
        font-size: 0.875rem;
        font-weight: 500;
        border-radius: 0.375rem;
        text-decoration: none;
        transition: all 0.2s ease;
        border: 1px solid;
    }
    
    .edit-btn {
        color: #4f46e5;
        border-color: #4f46e5;
        background-color: transparent;
    }
    
    .edit-btn:hover {
        background-color: #4f46e5;
        color: white;
        text-decoration: none;
    }
    
    .delete-btn {
        color: #dc2626;
        border-color: #dc2626;
        background-color: transparent;
        cursor: pointer;
    }
    
    .delete-btn:hover {
        background-color: #dc2626;
        color: white;
    }
    
    .action-btn svg {
        width: 1rem;
        height: 1rem;
        margin-right: 0.25rem;
    }
    
    .empty-state {
        text-align: center;
        padding: 4rem 1.5rem;
    }
    
    .empty-icon {
        width: 4rem;
        height: 4rem;
        border-radius: 50%;
        background-color: #f3f4f6;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
    }
    
    .empty-icon svg {
        width: 2rem;
        height: 2rem;
        color: #9ca3af;
    }
    
    .empty-title {
        font-size: 1.125rem;
        font-weight: 600;
        color: #4b5563;
        margin-bottom: 0.5rem;
    }
    
    .empty-description {
        color: #6b7280;
        margin-bottom: 1rem;
    }
    
    .pagination-container {
        margin-top: 2rem;
        display: flex;
        justify-content: center;
    }
    
    .pagination-wrapper {
        background: white;
        padding: 1rem 1.5rem;
        border-radius: 0.5rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        border: 1px solid #e5e7eb;
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
        .task-header {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .task-header h1 {
            font-size: 1.5rem;
        }
        
        .add-task-btn {
            width: 100%;
            justify-content: center;
        }
        
        .actions-container {
            flex-direction: column;
            gap: 0.5rem;
        }
        
        .action-btn {
            justify-content: center;
        }
    }
    
    /* Custom scrollbar */
    .table-wrapper::-webkit-scrollbar {
        height: 8px;
    }
    
    .table-wrapper::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 4px;
    }
    
    .table-wrapper::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 4px;
    }
    
    .table-wrapper::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
</style>

<div class="task-container">
    <!-- Header Section -->
    <div class="task-header">
        <div>
            <h1>Task Management</h1>
            <p>Manage and track your team's tasks efficiently</p>
        </div>
        
        <!-- Add Task Button -->
        <a href="{{ route('admin.tasks.create') }}" class="add-task-btn">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Assign New Task
        </a>
    </div>

    <!-- Tasks Table Container -->
    <div class="table-container">
        <div class="table-wrapper">
            <table class="tasks-table">
                <thead>
                    <tr>
                        <th>Task Title</th>
                        <th>Assigned To</th>
                        <th>Deadline</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tasks as $task)
                    <tr>
                        <td>
                            <div class="task-title">{{ $task->title }}</div>
                        </td>
                        <td>
                            <div class="user-info">
                                <div class="user-avatar">
                                    {{ substr($task->user->name ?? 'U', 0, 1) }}
                                </div>
                                <div class="user-name">{{ $task->user->name ?? 'Unassigned' }}</div>
                            </div>
                        </td>
                        <td>
                            <div class="deadline-info">
                                <div class="deadline-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="deadline-date">{{ \Carbon\Carbon::parse($task->deadline)->format('M d, Y') }}</div>
                                    <div class="deadline-relative">{{ \Carbon\Carbon::parse($task->deadline)->diffForHumans() }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="status-badge 
                                @if($task->status === 'Pending') status-pending
                                @elseif($task->status === 'In Progress') status-progress
                                @else status-completed @endif">
                                {{ $task->status }}
                            </span>
                        </td>
                        <td>
                            <div class="actions-container">
                                <a href="{{ route('admin.tasks.edit', $task) }}" class="action-btn edit-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Edit
                                </a>
                                <form action="{{ route('admin.tasks.destroy', $task) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn delete-btn" onclick="return confirm('Are you sure you want to delete this task?')">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="empty-state">
                            <div class="empty-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                            <div class="empty-title">No tasks found</div>
                            <div class="empty-description">Get started by assigning a new task to your team</div>
                            <a href="{{ route('admin.tasks.create') }}" class="add-task-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                                </svg>
                                Create First Task
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    @if($tasks->hasPages())
    <div class="pagination-container">
        <div class="pagination-wrapper">
            {{ $tasks->links() }}
        </div>
    </div>
    @endif
</div>
@endsection