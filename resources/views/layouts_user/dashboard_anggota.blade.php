@extends('admin.layouts.main')
@section('title', 'Dashboard')

@section('content')
    <div class="page-content">
        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
            <div>
                <h4 class="mb-3 mb-md-0">Welcome to Dashboard</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-xl-12 stretch-card">
                <div class="row flex-grow-1">
                    <div class="col-md-4 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-baseline">
                                    <h6 class="card-title mb-0">Buku</h6>
                                </div>

                                <div class="row">
                                    <div class="col-6 col-md-12 col-xl-5">
                                        <h3 class="mb-2">{{ $ebook_count ?? '' }}</h3>
                                        <div class="d-flex align-items-baseline">
                                            <p class="text-success">
                                                <span></span>
                                                <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-12 col-xl-7">
                                        <div class="mt-md-3 mt-xl-0">
                                            <canvas id="ebookDateChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-baseline">
                                    <h6 class="card-title mb-0">Mading</h6>
                                </div>

                                <div class="row">
                                    <div class="col-6 col-md-12 col-xl-5">
                                        <h3 class="mb-2">{{ $mading_count ?? '' }}</h3>
                                        <div class="d-flex align-items-baseline">
                                            <p class="text-success">
                                                <span></span>
                                                <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-12 col-xl-7">
                                        <div class="mt-md-3 mt-xl-0">
                                            <canvas id="madingDateChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div> <!-- row -->

        <div class="row">
            <div class="col-12 col-xl-12 grid-margin stretch-card">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <h5>Selamat datang dihalaman Dashboard, {{ Auth::user()->name }}!</h5>
                    </div>
                </div>
            </div>
        </div> <!-- row -->
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h4>Ebook yang Paling Banyak Dibaca:</h4>
                    <ul class="list-group">
                        @foreach ($ebooks as $ebookId => $ebookTitle)
                            <li class="list-group-item">{{ $ebookTitle }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-6">
                    <h4>Grafik Jumlah Akses Ebook:</h4>
                    <div class="chart-container">
                        <canvas id="ebookChart"></canvas>
                    </div>
                </div>
            </div>
        </div>



    @endsection


    @push('javascript')
        <script src="{{ asset('assets/admin/vendors/datatables.net/jquery.dataTables.js') }}"></script>
        <script src="{{ asset('assets/admin/vendors/datatables.net-bs5/dataTables.bootstrap5.js') }}"></script>
        <script src="{{ asset('assets/admin/js/data-table.js') }}"></script>

        <!-- Tambahkan kode berikut di dalam <head> -->
        <script src="{{ url('https://cdn.jsdelivr.net/npm/chart.js') }}"></script>
        <!-- Tambahkan script chart -->
        <script>
            var ebookData = @json($ebookData);
            var ebookTitles = @json(array_values($ebooks));

            var ctx = document.getElementById('ebookChart').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ebookTitles,
                    datasets: [{
                        label: 'Jumlah Akses',
                        data: ebookData,
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            stepSize: 1
                        }
                    }
                }
            });
        </script>


        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var ebookData = @json($ebookData ?? []);
                var ebookDates = @json($ebookDates ?? []);
                var ebookCreationCounts = @json($ebookCreationCounts ?? []);

                // Membuat chart dengan menggunakan Chart.js
                var ctx = document.getElementById('ebookDateChart').getContext('2d');
                new Chart(ctx, {
                    type: 'line', // Menggunakan jenis chart garis
                    data: {
                        labels: ebookDates,
                        datasets: [{
                            label: 'Jumlah Buku Dibaca',
                            data: ebookData,
                            backgroundColor: 'rgba(75, 192, 192, 0.5)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }, {
                            label: 'Jumlah Buku Dibuat',
                            data: ebookCreationCounts,
                            backgroundColor: 'rgba(255, 99, 132, 0.5)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true,
                                precision: 0,
                                stepSize: 1
                            }
                        }
                    }
                });
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var usersData = @json($usersData ?? []);

                // Mendapatkan label dan data dari variabel usersData
                var labels = Object.keys(usersData);
                var data = Object.values(usersData);

                // Membuat chart dengan menggunakan Chart.js
                var ctx = document.getElementById('userChart').getContext('2d');
                new Chart(ctx, {
                    type: 'line', // Menggunakan jenis chart garis
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Jumlah Pengguna',
                            data: data,
                            backgroundColor: 'rgba(75, 192, 192, 0.5)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true,
                                precision: 0,
                                stepSize: 1
                            }
                        }
                    }
                });
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var madingDates = @json($madingDates ?? []);
                var madingCreationCounts = @json($madingCreationCounts ?? []);

                // Membuat chart dengan menggunakan Chart.js
                var ctx = document.getElementById('madingDateChart').getContext('2d');
                new Chart(ctx, {
                    type: 'line', // Menggunakan jenis chart garis
                    data: {
                        labels: madingDates,
                        datasets: [{
                            label: 'Jumlah Mading Dibuat',
                            data: madingCreationCounts,
                            backgroundColor: 'rgba(255, 99, 132, 0.5)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true,
                                precision: 0,
                                stepSize: 1
                            }
                        }
                    }
                });
            });
        </script>
    @endpush
