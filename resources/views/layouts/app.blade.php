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
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

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


                    {{-- User Profile --}}
                    <button class="flex items-center space-x-2 focus:outline-none">
                        {{-- <span class="hidden md:inline-block font-medium">{{ Auth::user()->name }}</span> --}}
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        {{-- <form method="POST" action="{{ route('logout') }}" class="mt-4">
                            @csrf
                            <button type="submit" class="block px-4 py-2 text-gray-600 hover:bg-gray-200 rounded">
                                Logout
                            </button>
                        </form> --}}
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>

                    </button>
                </div>
            </div>

            <!-- Settings Dropdown -->
            {{-- <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div> --}}
        </header>

        <div class="flex flex-1">
            {{-- Sidebar --}}
            <aside class="w-64 bg-white shadow-md lg:block hidden">
                <div class="p-6">
                    <nav class="mt-6">
                        <!-- <a href="#" class="block px-4 py-2 text-gray-600 hover:bg-gray-200 bg-gray-200 rounded">Dashboard</a> -->
                        {{-- <div x-data="{ open: false }">
                            <button @click="open = !open" class="w-full text-left px-4 py-2 text-gray-600 hover:bg-gray-200 rounded flex justify-between">
                                Report
                                <span x-show="!open">▼</span>
                                <span x-show="open">▲</span>
                            </button>
                            <div x-show="open" class="ml-4 mt-2 space-y-2">
                                <a href="#" class="block px-4 py-2 text-gray-600 hover:bg-gray-200 rounded">ward List</a>
                                <a href="#" class="block px-4 py-2 text-gray-600 hover:bg-gray-200 rounded">family List</a>
                                <a href="{{ route('familyMemberReport') }}" class="block px-4 py-2 text-gray-600 hover:bg-gray-200 rounded">Family member</a>
                            </div>
                        </div> --}}
                        <!-- <form method="POST" action="{{ route('logout') }}" class="mt-4">
                @csrf
                <button type="submit" class="block px-4 py-2 text-gray-600 hover:bg-gray-200 rounded">
                    Logout
                </button>
            </form> -->

                        <!-- <a href="#" class="block px-4 py-2 text-gray-600 hover:bg-gray-200 rounded">User
                            Profile</a>
                        <a href="#" class="block px-4 py-2 text-gray-600 hover:bg-gray-200 rounded">User
                            Management</a> -->
                    </nav>
                </div>
            </aside>
            <!-- Page Content -->
            <main class="py-10 w-full">
                {{ $slot }}
            </main>
        </div>
        @livewireScripts
</body>

</html>
