document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.status-select').forEach(select => {
        select.addEventListener('change', function() {
            const taskId = this.dataset.taskId;
            const newStatus = this.value;
            const statusBadge = document.querySelector(`.status-badge-${taskId}`);
            
            // Update UI immediately for better UX
            statusBadge.className = `status-badge-${taskId} px-2 py-1 rounded text-xs ${
                newStatus === 'Pending' ? 'bg-yellow-100 text-yellow-800' :
                newStatus === 'In Progress' ? 'bg-blue-100 text-blue-800' :
                'bg-green-100 text-green-800'
            }`;
            statusBadge.textContent = newStatus;
            
            // Send request to server
            fetch(`/tasks/${taskId}/status`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ status: newStatus })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (!data.success) {
                    // Revert UI if update failed
                    const originalStatus = statusBadge.dataset.originalStatus;
                    select.value = originalStatus;
                    statusBadge.className = `status-badge-${taskId} px-2 py-1 rounded text-xs ${
                        originalStatus === 'Pending' ? 'bg-yellow-100 text-yellow-800' :
                        originalStatus === 'In Progress' ? 'bg-blue-100 text-blue-800' :
                        'bg-green-100 text-green-800'
                    }`;
                    statusBadge.textContent = originalStatus;
                    alert('Failed to update task status');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while updating the task status');
            });
        });
    });
});