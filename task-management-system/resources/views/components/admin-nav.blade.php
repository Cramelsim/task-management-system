@if(auth()->check() && auth()->user()->isAdmin())
    <div class="mt-4">
        <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider">
            Admin Panel
        </h3>
        <div class="mt-2 space-y-1">
            <x-nav-link href="{{ route('admin.users.index') }}" :active="request()->routeIs('admin.users.*')">
                {{ __('User Management') }}
            </x-nav-link>
            <x-nav-link href="{{ route('admin.tasks.index') }}" :active="request()->routeIs('admin.tasks.*')">
                {{ __('Task Management') }}
            </x-nav-link>
        </div>
    </div>
@endif