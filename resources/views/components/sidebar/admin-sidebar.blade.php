<x-sidebar-dashboard>
    <x-sidebar-menu-dashboard routeName="index-practice" title="Index" />

    <x-sidebar-menu-dropdown-dashboard routeName="practice.*" title="Judul Dropdown">
        <x-sidebar-menu-dropdown-item-dashboard routeName="practice.first" title="Judul Item1" />
        <x-sidebar-menu-dropdown-item-dashboard routeName="practice.second" title="Judul Item2" />

        {{-- Menu Logout --}}
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button
                type="submit"
                class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100 focus:outline-none"
            >
                Logout
            </button>
        </form>
    </x-sidebar-menu-dropdown-dashboard>
</x-sidebar-dashboard>
