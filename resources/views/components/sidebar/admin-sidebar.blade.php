<!-- resources/views/components/sidebar/admin-sidebar.blade.php -->
<x-sidebar-dashboard>
    <ul class="space-y-2">
        <!-- Dropdown Manajemen Stok -->
        <li>
            <button type="button"
                class="flex items-center w-full p-2 text-gray-900 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 transition duration-75"
                aria-controls="dropdown-stock" data-collapse-toggle="dropdown-stock">
                <!-- Icon -->
                <svg class="w-6 h-6 text-gray-500 group-hover:text-gray-900 dark:group-hover:text-white"
                     fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 2a8 8 0 100 16 8 8 0 000-16zM8 9V5h4v4H8zm0 2h4v4H8v-4z"></path>
                </svg>
                <span class="flex-1 ml-3 text-left whitespace-nowrap">Manajemen Stok</span>
                <!-- Arrow Icon -->
                <svg aria-hidden="true" class="w-6 h-6 transition-transform duration-300" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                          d="M5.23 7.21a.75.75 0 011.06.02L10 11.293l3.71-4.06a.75.75 0 111.08 1.04l-4.25 4.65a.75.75 0 01-1.08 0l-4.25-4.65a.75.75 0 01.02-1.06z"
                          clip-rule="evenodd"></path>
                </svg>
            </button>

            <ul id="dropdown-stock" class="hidden py-2 space-y-2">
                <!-- Produk -->
                <li>
                    <a href="{{ route('products.index') }}"
                       class="flex items-center w-full p-2 rounded-lg pl-11 text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700
                              {{ request()->routeIs('products.index') ? 'bg-gray-200 dark:bg-gray-600 font-semibold' : '' }}">
                        Produk
                    </a>
                </li>
                <li>
                    <a href="{{ route('products.create') }}"
                       class="flex items-center w-full p-2 rounded-lg pl-11 text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700
                              {{ request()->routeIs('products.create') ? 'bg-gray-200 dark:bg-gray-600 font-semibold' : '' }}">
                        Tambah Produk
                    </a>
                </li>

                <!-- Transaksi Stok -->
                <li>
                    <a href="{{ route('transactions.index') }}"
                       class="flex items-center w-full p-2 rounded-lg pl-11 text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700
                              {{ request()->routeIs('transactions.index') ? 'bg-gray-200 dark:bg-gray-600 font-semibold' : '' }}">
                        Transaksi Stok
                    </a>
                </li>
                <li>
                    <a href="{{ route('transactions.create') }}"
                       class="flex items-center w-full p-2 rounded-lg pl-11 text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700
                              {{ request()->routeIs('transactions.create') ? 'bg-gray-200 dark:bg-gray-600 font-semibold' : '' }}">
                        Tambah Transaksi
                    </a>
                </li>

                <!-- Stock Opname -->
                <li>
                    <a href="{{ route('opname.index') }}"
                       class="flex items-center w-full p-2 rounded-lg pl-11 text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700
                              {{ request()->routeIs('opname.index') ? 'bg-gray-200 dark:bg-gray-600 font-semibold' : '' }}">
                        Stock Opname
                    </a>
                </li>

                <!-- Laporan -->
                <li>
                    <a href="{{ route('reports.index') }}"
                       class="flex items-center w-full p-2 rounded-lg pl-11 text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700
                              {{ request()->routeIs('reports.index') ? 'bg-gray-200 dark:bg-gray-600 font-semibold' : '' }}">
                        Laporan
                    </a>
                </li>
            </ul>
        </li>
        <!-- Menu Manajemen Pengguna -->
        <li>
            <a href="{{ route('users.index') }}"
            class="flex items-center w-full p-2 text-gray-900 rounded-lg hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700
                    {{ request()->routeIs('users.*') ? 'bg-gray-200 dark:bg-gray-600 font-semibold' : '' }}">
                <!-- Icon -->
                <svg class="w-6 h-6 text-gray-500 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path d="M10 2a8 8 0 100 16 8 8 0 000-16zM8 9V5h4v4H8zm0 2h4v4H8v-4z"></path>
                </svg>
                <span class="ml-3">Manajemen Pengguna</span>
            </a>
        </li>

    </ul>
</x-sidebar-dashboard>
