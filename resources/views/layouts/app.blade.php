<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-gray-100">
    <div x-data="{ sidebarOpen: true }" class="flex h-screen">
        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'w-64' : 'w-20'"
               class="bg-blue-800 text-white h-full transition-all duration-300 p-5">
            <h1 class="text-xl font-bold mb-5">Sijati Dashboard</h1>

            <button @click="sidebarOpen = !sidebarOpen" class="md:hidden p-2 bg-blue-600 text-white rounded">
                ☰
            </button>

            <nav>
                <ul>
                    <li class="mb-2">
                        <a href="{{ route('dashboard.index') }}" class="block p-2 rounded hover:bg-blue-600">Dashboard</a>
                    </li>

                    <!-- Dropdown Manufacturing -->
                    <li class="mb-2" x-data="{ open: false }">
                        <button @click="open = !open" class="w-full flex items-center justify-between p-2 rounded hover:bg-blue-600">
                            Manufacturing
                            <span x-show="!open">▼</span>
                            <span x-show="open">▲</span>
                        </button>
                        <ul x-show="open" x-transition class="pl-4 mt-2 space-y-1">
                            <li><a href="{{ route('dashboard.manufacturing') }}" class="block p-2 rounded hover:bg-blue-500">Manufacturing</a></li>
                            <li><a href="{{ route('dashboard.vendor') }}" class="block p-2 rounded hover:bg-blue-500">Vendor</a></li>
                            <li><a href="{{ route('dashboard.material') }}" class="block p-2 rounded hover:bg-blue-500">Material</a></li>
                        </ul>
                    </li>

                    <li class="mb-2"><a href="{{ route('dashboard.products') }}" class="block p-2 rounded hover:bg-blue-600">Products</a></li>
                    <li class="mb-2"><a href="{{ route('dashboard.purchasing') }}" class="block p-2 rounded hover:bg-blue-600">Purchasing</a></li>
                    <li class="mb-2"><a href="{{ route('dashboard.sales') }}" class="block p-2 rounded hover:bg-blue-600">Sales</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Content -->
        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>
</body>
