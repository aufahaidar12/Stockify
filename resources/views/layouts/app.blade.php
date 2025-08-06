<!DOCTYPE html>
<html>
<head>
    <title>Stockify Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flowbite@1.6.0/dist/flowbite.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flowbite@1.6.0/dist/flowbite.min.js"></script>
</head>
<body class="bg-gray-100">

<nav class="bg-blue-600 text-white p-4 flex justify-between">
    <div class="text-xl font-bold">Stockify</div>
    <div class="flex space-x-4 items-center">

        <a href="{{ route('dashboard') }}" class="px-3 hover:underline">Dashboard</a>

        <!-- Dropdown untuk Manajemen Stok -->
        <div class="relative inline-block">
            <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar"
                class="px-3 py-2 flex items-center hover:underline">
                Manajemen Stok 
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <!-- Dropdown menu -->
            <div id="dropdownNavbar" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow">
                <ul class="py-1 text-sm text-gray-700" aria-labelledby="dropdownNavbarLink">
                    <li>
                        <a href="{{ route('transactions.index') }}" class="block px-4 py-2 hover:bg-gray-100">Transaksi Stok</a>
                    </li>
                    <li>
                        <a href="{{ route('transactions.create') }}" class="block px-4 py-2 hover:bg-gray-100">Tambah Transaksi</a>
                    </li>
                    <li>
                        <a href="{{ url('/stock-opname') }}" class="block px-4 py-2 hover:bg-gray-100">Stock Opname</a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Menu lain -->
        <a href="{{ route('products.index') }}" class="px-3 hover:underline">Produk</a>
        <a href="{{ route('categories.index') }}" class="px-3 hover:underline">Kategori</a>
        <a href="{{ route('suppliers.index') }}" class="px-3 hover:underline">Supplier</a>

    </div>
</nav>

<div class="p-6">
    @yield('content')
</div>

</body>
</html>
