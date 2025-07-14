<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Welcome back, ') . Auth::user()->name . '!' }}
        </h2>
    </x-slot>

    <div class="py-12 space-y-6">
        <!-- Logged In Notification -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm">
                <p class="font-bold">Dashboard Loaded</p>
                <p>You're successfully logged in 🎉</p>
            </div>
        </div>

        <!-- Motivational Quote -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow-sm">
                <h3 class="text-lg font-semibold mb-2 text-indigo-600">💡 Daily Inspiration</h3>
                <p class="text-gray-700 italic">"Success is not final, failure is not fatal: it is the courage to continue that counts." – Winston Churchill</p>
            </div>
        </div>

        <!-- Sample Quick Stats -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-blue-100 p-4 rounded shadow-sm">
                <h4 class="font-bold text-blue-800">Tasks Assigned</h4>
                <p class="text-2xl">12</p>
            </div>
            <div class="bg-yellow-100 p-4 rounded shadow-sm">
                <h4 class="font-bold text-yellow-800">Tasks Completed</h4>
                <p class="text-2xl">7</p>
            </div>
            <div class="bg-pink-100 p-4 rounded shadow-sm">
                <h4 class="font-bold text-pink-800">Upcoming Pig Farrowing</h4>
                <p class="text-lg">Next: <strong>11th August 2025</strong></p>
            </div>
        </div>
    </div>
</x-app-layout>
