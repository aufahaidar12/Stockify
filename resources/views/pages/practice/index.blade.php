@extends('layouts.dashboard')

@section('content')
<div class="p-4">
    <!-- Ringkasan -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <!-- Jumlah Produk -->
        <div class="p-4 rounded-lg shadow text-white bg-gradient-to-r from-blue-500 to-blue-600 flex items-center gap-4">
            <div class="bg-white bg-opacity-20 p-3 rounded-full text-2xl">📦</div>
            <div>
                <h3 class="text-sm font-medium">Jumlah Produk</h3>
                <p class="mt-1 text-3xl font-bold">{{ $jumlahProduk }}</p>
            </div>
        </div>

        <!-- Transaksi Masuk -->
        <div class="p-4 rounded-lg shadow text-white bg-gradient-to-r from-green-500 to-green-600 flex items-center gap-4">
            <div class="bg-white bg-opacity-20 p-3 rounded-full text-2xl">📥</div>
            <div>
                <h3 class="text-sm font-medium">Transaksi Masuk (30 Hari)</h3>
                <p class="mt-1 text-3xl font-bold">{{ $transaksiMasuk }}</p>
            </div>
        </div>

        <!-- Transaksi Keluar -->
        <div class="p-4 rounded-lg shadow text-white bg-gradient-to-r from-red-500 to-red-600 flex items-center gap-4">
            <div class="bg-white bg-opacity-20 p-3 rounded-full text-2xl">📤</div>
            <div>
                <h3 class="text-sm font-medium">Transaksi Keluar (30 Hari)</h3>
                <p class="mt-1 text-3xl font-bold">{{ $transaksiKeluar }}</p>
            </div>
        </div>
    </div>

    <!-- Grafik stok barang -->
    <div class="bg-white rounded-lg shadow dark:bg-gray-800 p-4 mb-6">
        <h3 class="text-lg font-bold mb-4 text-gray-900 dark:text-white">📊 Stok Barang Terendah</h3>
        <div class="relative h-72"> {{-- Tinggi dibatasi agar proporsional --}}
            <canvas id="stokChart"></canvas>
        </div>
    </div>

    <!-- Aktivitas Pengguna -->
    <div class="bg-white rounded-lg shadow dark:bg-gray-800 p-4">
        <h3 class="text-lg font-bold mb-4 text-gray-900 dark:text-white">👥 Aktivitas Pengguna Terbaru</h3>
        <ul>
            @foreach($aktivitasPengguna as $user)
                <li class="py-2 border-b border-gray-200 dark:border-gray-700 flex justify-between">
                    <span>{{ $user->name }}</span>
                    <span class="text-sm text-gray-500 dark:text-gray-400">
                        {{ $user->updated_at->diffForHumans() }}
                    </span>
                </li>
            @endforeach
        </ul>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('stokChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($grafikStok->pluck('name')),
            datasets: [{
                label: 'Stok Barang',
                data: @json($grafikStok->pluck('stock')),
                backgroundColor: 'rgba(59, 130, 246, 0.8)',
                borderRadius: 5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#1f2937',
                    titleColor: '#fff',
                    bodyColor: '#d1d5db'
                }
            },
            scales: {
                x: {
                    ticks: { color: '#6b7280' },
                    grid: { color: 'rgba(107, 114, 128, 0.1)' }
                },
                y: {
                    ticks: { color: '#6b7280', precision: 0 },
                    grid: { color: 'rgba(107, 114, 128, 0.1)' }
                }
            }
        }
    });
</script>
@endsection
