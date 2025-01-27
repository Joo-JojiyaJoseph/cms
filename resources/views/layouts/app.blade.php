<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    @livewireStyles
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col">
        {{-- Header --}}
        <header class="bg-white shadow-md">
            <div class="flex justify-between items-center px-6 py-4">
                {{-- Left Section --}}
                <div class="flex items-center space-x-4">
                    <img src="https://via.placeholder.com/40" alt="User Avatar"
                            class="w-10 h-10 rounded-full border border-gray-300" />
                    <h1 class="text-lg font-bold">{{ Auth::user()->name }}</h1>
                </div>
                {{-- Right Section --}}
                <div class="flex items-center space-x-6">
                    {{-- Search Bar --}}
                    <div class="relative">
                        <input type="text" placeholder="Search..."
                            class="pl-10 pr-4 py-2 bg-gray-100 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500" />
                        <svg class="absolute left-3 top-2.5 w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-4.35-4.35m-3.65.85A7.5 7.5 0 1118 7.5a7.5 7.5 0 01-4.35 9.35z" />
                        </svg>
                    </div>
                    {{-- User Profile --}}
                    {{-- <button class="flex items-center space-x-2 focus:outline-none">
                        <img src="https://via.placeholder.com/40" alt="User Avatar"
                            class="w-10 h-10 rounded-full border border-gray-300" />
                        <span class="hidden md:inline-block font-medium">{{ Auth::user()->name }}</span>
                    </button> --}}
                </div>
            </div>
        </header>

        <div class="flex flex-1">
            {{-- Sidebar --}}
            <aside class="w-64 bg-white shadow-md">
                <div class="p-6">
                    <nav class="mt-6">
                        <a href="#" class="block px-4 py-2 text-gray-600 hover:bg-gray-200 rounded">Dashboard</a>
                        <a href="#" class="block px-4 py-2 text-gray-600 hover:bg-gray-200 rounded">User
                            Profile</a>
                        <a href="#" class="block px-4 py-2 text-gray-600 hover:bg-gray-200 rounded">User
                            Management</a>
                    </nav>
                </div>
            </aside>
            <!-- Page Content -->
            <main class="p-10">
                {{ $slot }}
            </main>
        </div>
</body>
@livewireScripts
</html>
