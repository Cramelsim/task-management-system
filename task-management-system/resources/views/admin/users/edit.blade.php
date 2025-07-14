@extends('layouts.app')

@section('content')
<div style="max-width: 800px; margin: 0 auto; padding: 20px;">
    <h1 style="color: #333; margin-bottom: 30px; font-size: 2.5rem; font-weight: bold;">Edit User</h1>
    
    <div style="background-color: white; border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        <div style="padding: 30px;">
            <form action="{{ route('admin.users.update', $user) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div style="margin-bottom: 20px;">
                    <label for="name" style="display: block; margin-bottom: 5px; font-weight: 500; color: #495057;">Name</label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           value="{{ old('name', $user->name) }}" 
                           required
                           style="width: 100%; padding: 10px; border: 1px solid #ced4da; border-radius: 4px; font-size: 16px; transition: border-color 0.3s ease, box-shadow 0.3s ease; @error('name') border-color: #dc3545; @enderror">
                    @error('name')
                        <div style="color: #dc3545; font-size: 14px; margin-top: 5px;">{{ $message }}</div>
                    @enderror
                </div>
                
                <div style="margin-bottom: 20px;">
                    <label for="email" style="display: block; margin-bottom: 5px; font-weight: 500; color: #495057;">Email</label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           value="{{ old('email', $user->email) }}" 
                           required
                           style="width: 100%; padding: 10px; border: 1px solid #ced4da; border-radius: 4px; font-size: 16px; transition: border-color 0.3s ease, box-shadow 0.3s ease; @error('email') border-color: #dc3545; @enderror">
                    @error('email')
                        <div style="color: #dc3545; font-size: 14px; margin-top: 5px;">{{ $message }}</div>
                    @enderror
                </div>
                
                <div style="margin-bottom: 20px;">
                    <label for="password" style="display: block; margin-bottom: 5px; font-weight: 500; color: #495057;">Password (Leave blank to keep current)</label>
                    <input type="password" 
                           id="password" 
                           name="password"
                           style="width: 100%; padding: 10px; border: 1px solid #ced4da; border-radius: 4px; font-size: 16px; transition: border-color 0.3s ease, box-shadow 0.3s ease; @error('password') border-color: #dc3545; @enderror">
                    @error('password')
                        <div style="color: #dc3545; font-size: 14px; margin-top: 5px;">{{ $message }}</div>
                    @enderror
                </div>
                
                <div style="margin-bottom: 20px;">
                    <label for="password_confirmation" style="display: block; margin-bottom: 5px; font-weight: 500; color: #495057;">Confirm Password</label>
                    <input type="password" 
                           id="password_confirmation" 
                           name="password_confirmation"
                           style="width: 100%; padding: 10px; border: 1px solid #ced4da; border-radius: 4px; font-size: 16px; transition: border-color 0.3s ease, box-shadow 0.3s ease;">
                </div>
                
                <!-- Add role selection if your system has roles -->
                @if($roles ?? false)
                <div style="margin-bottom: 20px;">
                    <label style="display: block; margin-bottom: 5px; font-weight: 500; color: #495057;">Role</label>
                    <select name="role" style="width: 100%; padding: 10px; border: 1px solid #ced4da; border-radius: 4px; font-size: 16px; background-color: white; transition: border-color 0.3s ease, box-shadow 0.3s ease;">
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @endif
                
                <div style="margin-top: 30px;">
                    <button type="submit" 
                            style="background-color: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 5px; font-size: 16px; font-weight: 500; cursor: pointer; margin-right: 10px; transition: background-color 0.3s ease;">
                        Update User
                    </button>
                    <a href="{{ route('admin.users.index') }}" 
                       style="display: inline-block; background-color: #6c757d; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-size: 16px; font-weight: 500; transition: background-color 0.3s ease;">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
/* Input focus effects */
input:focus, select:focus {
    outline: none !important;
    border-color: #007bff !important;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25) !important;
}

/* Button hover effects */
button[type="submit"]:hover {
    background-color: #0056b3 !important;
}

a[href*="users.index"]:hover {
    background-color: #545b62 !important;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .container {
        padding: 10px !important;
    }
    
    input, select {
        font-size: 14px !important;
    }
    
    button, a {
        font-size: 14px !important;
        padding: 8px 16px !important;
    }
    
    h1 {
        font-size: 2rem !important;
    }
}

/* Form validation styling */
.form-group input.is-invalid {
    border-color: #dc3545;
}

.form-group input.is-valid {
    border-color: #28a745;
}
</style>
@endsection