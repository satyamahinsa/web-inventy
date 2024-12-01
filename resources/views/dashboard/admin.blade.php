<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
        <div class="flex items-center">
            <div class="mr-6 flex items-center gap-2">
                <i class="fas fa-sun text-yellow-400 text-lg"></i>
                <input type="checkbox" id="toggleMode" class="hidden">
                <label for="toggleMode">
                    <div class="flex items-center w-9 h-5 bg-slate-500 rounded-full p-1 cursor-pointer">
                        <div class="w-4 h-4 bg-white rounded-full toggleCircle"></div>
                    </div>
                </label>
                <i class="fas fa-moon text-white text-lg"></i>
            </div>
            <button class="mr-6">
                <i class="fas fa-bell text-white"></i>
            </button>
            <div class="flex items-center space-x-3">
                <img class="w-10 h-10 rounded-full" src="https://via.placeholder.com/150" alt="User Avatar">
                <span class="text-white font-medium">{{ Auth::user()->name }}</span>
            </div>
        </div>
    </x-slot>

    <div class="container mx-auto my-5 px-4">
        <div class="p-6 text-gray-800 dark:text-white bg-amber-200 dark:bg-red-500 rounded-lg shadow mb-6">
            @auth
                <div class="text-2xl font-bold">
                    {{ __('Selamat Datang, ') }}
                    <span class="welcome-message font-bold uppercase">{{ Auth::user()->name }}</span>
                </div>
            @else
                <div>{{ __("You're not logged in!") }}</div>
            @endauth
        </div>

        {{-- KPI Section --}}
        <div class="grid grid-cols-4 gap-6 mb-6">
            <div class="bg-red-500 dark:bg-amber-200 dark:text-gray-800 text-white p-4 rounded-lg shadow text-center">
                <h3 class="text-lg font-semibold">Total Profit</h3>
                <p class="text-3xl font-bold">Rp. {{ number_format($totalProfit) }}</p>
                <p class="text-gray-800 dark:text-red-500">+10% dari bulan lalu</p>
            </div>
            <div class="bg-red-500 dark:bg-amber-200 dark:text-gray-800 text-white p-4 rounded-lg shadow text-center">
                <h3 class="text-lg font-semibold">Total Transaksi</h3>
                <p class="text-3xl font-bold">{{ $totalTransactions }}</p>
                <p class="text-gray-800 dark:text-red-500">+8% dari bulan lalu</p>
            </div>
            <div class="bg-red-500 dark:bg-amber-200 dark:text-gray-800 text-white p-4 rounded-lg shadow text-center">
                <h3 class="text-lg font-semibold">Total Pelanggan</h3>
                <p class="text-3xl font-bold">{{ $totalCustomers }}</p>
                <p class="text-gray-800 dark:text-red-500">+5 pelanggan baru</p>
            </div>
            <div class="bg-red-500 dark:bg-amber-200 dark:text-gray-800 text-white p-4 rounded-lg shadow text-center ">
                <h3 class="text-lg font-semibold">Rata-rata Order</h3>
                <p class="text-3xl font-bold">Rp. {{ number_format($averageOrderValue) }}</p>
                <p class="text-gray-800 dark:text-red-500">+3% dari bulan lalu</p>
            </div>
        </div>

        {{-- Timeseries Chart --}}
        <div class="bg-white dark:bg-stone-600 text-gray-800 dark:text-white p-6 rounded-lg shadow-lg mb-6">
            <h3 class="text-xl font-semibold mb-4">Transaksi Per Bulan</h3>
            <div class="relative w-full h-auto max-h-80">
                <canvas id="timeseriesChart" class="block w-full h-full"></canvas>
            </div>
        </div>

        <div class="flex flex-wrap gap-6 mb-6">
            <div class="flex-[6] bg-white dark:bg-stone-600 text-gray-800 dark:text-white p-6 rounded-lg shadow-lg">
                <h3 class="text-xl font-semibold mb-4">Total Pendapatan per Kategori Produk</h3>
                <div class="relative w-full h-auto max-h-80">
                    <canvas id="revenueByCategoryBarChart" class="block w-full h-full"></canvas>
                </div>
            </div>
            
            <div class="flex-[6] bg-white dark:bg-stone-600 text-gray-800 dark:text-white p-6 rounded-lg shadow-lg">
                <h3 class="text-xl font-semibold mb-4">Pertumbuhan Pelanggan Baru per Bulan</h3>
                <div class="relative w-full h-auto max-h-80">
                    <canvas id="monthlyCustomerGrowthBarChart" class="block w-full h-full"></canvas>
                </div>
            </div>
        </div>

        <div class="flex flex-wrap gap-6">
            <div class="flex-[4] bg-white dark:bg-stone-600 text-gray-800 dark:text-white p-6 rounded-lg shadow-lg">
                <h3 class="text-xl font-semibold mb-4">Kategori Produk Terlaris</h3>
                <div class="relative w-full h-auto max-h-80">
                    <canvas id="categoryPieChart" class="block w-full h-full"></canvas>
                </div>
            </div>
        
            <div class="flex-[8] bg-white dark:bg-stone-600 text-gray-800 dark:text-white p-6 rounded-lg shadow-lg">
                <h3 class="text-xl font-semibold mb-4">Transaksi Terbaru</h3>
                <table class="table-auto w-full text-left border-collapse border border-gray-300 text-gray-800 dark:text-white">
                    <thead>
                        <tr class="bg-amber-200">
                            <th class="border border-gray-300 px-4 py-2">No.</th>
                            <th class="border border-gray-300 px-4 py-2">Pelanggan</th>
                            <th class="border border-gray-300 px-4 py-2">Total Harga</th>
                            <th class="border border-gray-300 px-4 py-2">Status</th>
                            <th class="border border-gray-300 px-4 py-2">Alamat Tujuan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recentTransactions as $transaction)
                            <tr>
                                <td class="border border-gray-300 px-4 py-2">{{ $transaction->id }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $transaction->user->name }}</td>
                                <td class="border border-gray-300 px-4 py-2">Rp. {{ number_format($transaction->total_amount) }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ ucfirst($transaction->status) }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $transaction->destination_address }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @if (session('loginstatus'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Success!',
                text: '{{ session('loginstatus') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        });
    </script>
@endif

    {{-- Include Charts JS --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Timeseries Chart
        const timeseriesCtx = document.getElementById('timeseriesChart').getContext('2d');
        new Chart(timeseriesCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($months) !!}, // Example labels for the months
                datasets: [{
                    label: 'Transaksi',
                    data: {!! json_encode($monthlyTransactions) !!}, // Example data for transactions
                    borderColor: '#4caf50',
                    backgroundColor: 'rgba(76, 175, 80, 0.2)',
                    borderWidth: 2,
                    fill: true,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false, // Allow responsive resizing without aspect ratio restrictions
                plugins: {
                    legend: {
                        labels: {
                            color: '#27272A', // Warna untuk label legend
                            font: {
                                size: 14, // Ukuran font untuk legend
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            color: '#27272A', // Warna untuk label sumbu X
                            font: {
                                size: 12, // Ukuran font label sumbu X
                            }
                        },
                        grid: {
                            color: 'rgba(255, 255, 255, 0.2)' // Warna garis grid pada sumbu X
                        }
                    },
                    y: {
                        ticks: {
                            color: '#27272A', // Warna untuk label sumbu Y
                            font: {
                                size: 12, // Ukuran font label sumbu Y
                            }
                        },
                        grid: {
                            color: 'rgba(255, 255, 255, 0.2)' // Warna garis grid pada sumbu Y
                        }
                    }
                }
            }
        });

        // Pie Chart
        const categoryPieCtx = document.getElementById('categoryPieChart').getContext('2d');
        new Chart(categoryPieCtx, {
            type: 'pie',
            data: {
                labels: {!! json_encode($categoryNames) !!}, // Example category names
                datasets: [{
                    data: {!! json_encode($categorySales) !!}, // Example sales data
                    backgroundColor: ['#4caf50', '#2196f3', '#ff9800', '#9c27b0', '#e91e63'],
                    borderColor: '#27272A',
                    borderWidth: 2,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false, // Consistent with Timeseries Chart
                plugins: {
                    legend: {
                        labels: {
                            color: '#27272A', // Ensure legends are styled properly
                            font: {
                                size: 14
                            }
                        }
                    }
                }
            }
        });

        const revenueByCategoryCtx = document.getElementById('revenueByCategoryBarChart').getContext('2d');
        new Chart(revenueByCategoryCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($categoryNames) !!}, // Example labels for product categories
                datasets: [{
                    label: 'Pendapatan (Rp)',
                    data: {!! json_encode($categoryRevenues) !!}, // Example data for category revenues
                    backgroundColor: 'rgba(76, 175, 80, 0.8)',
                    borderColor: 'rgba(76, 175, 80, 1)',
                    borderWidth: 2,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        labels: {
                            color: '#27272A',
                            font: {
                                size: 14
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            color: '#27272A',
                            font: {
                                size: 12
                            }
                        },
                        grid: {
                            color: 'rgba(255, 255, 255, 0.2)'
                        }
                    },
                    y: {
                        ticks: {
                            color: '#27272A',
                            font: {
                                size: 12
                            }
                        },
                        grid: {
                            color: 'rgba(255, 255, 255, 0.2)'
                        }
                    }
                }
            }
        });


        // Bar Chart for Monthly Growth of New Customers
        const monthlyCustomerGrowthCtx = document.getElementById('monthlyCustomerGrowthBarChart').getContext('2d');
        new Chart(monthlyCustomerGrowthCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($months) !!}, // Example labels for the months
                datasets: [{
                    label: 'Pelanggan Baru',
                    data: {!! json_encode($monthlyNewCustomers) !!}, // Example data for new customers per month
                    backgroundColor: 'rgba(33, 150, 243, 0.8)',
                    borderColor: 'rgba(33, 150, 243, 1)',
                    borderWidth: 2,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        labels: {
                            color: '#27272A',
                            font: {
                                size: 14
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            color: '#27272A',
                            font: {
                                size: 12
                            }
                        },
                        grid: {
                            color: 'rgba(255, 255, 255, 0.2)'
                        }
                    },
                    y: {
                        ticks: {
                            color: '#27272A',
                            font: {
                                size: 12
                            }
                        },
                        grid: {
                            color: 'rgba(255, 255, 255, 0.2)'
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>
