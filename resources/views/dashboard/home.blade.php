
    @extends('layouts.master')
    @section('content')

        {{-- message --}}
        {!! Toastr::message() !!}
        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="page-sub-header">
                                <h3 class="page-title">Selamat  Datang {{ Session::get('name') }}</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                    <li class="breadcrumb-item active">{{ Session::get('name') }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-3 col-sm-6 col-12 d-flex">
                        <div class="card bg-comman w-100">
                            <div class="card-body">
                                <div class="db-widgets d-flex justify-content-between align-items-center">
                                    <div class="db-info">
                                        <h6>Total Siswa</h6>
                                        <h3>{{ $jumlahSiswa }}</h3>
                                    </div>
                                    <div class="db-icon">
                                        <img src="{{ URL::to('assets/img/icons/dash-icon-01.svg') }}" alt="Dashboard Icon">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12 d-flex">
                        <div class="card bg-comman w-100">
                            <div class="card-body">
                                <div class="db-widgets d-flex justify-content-between align-items-center">
                                    <div class="db-info">
                                        <h6>Penghargaan</h6>
                                        <h3>42</h3>
                                    </div>
                                    <div class="db-icon">
                                        <img src="{{ URL::to('assets/img/icons/dash-icon-02.svg') }}" alt="Dashboard Icon">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12 d-flex">
                        <div class="card bg-comman w-100">
                            <div class="card-body">
                                <div class="db-widgets d-flex justify-content-between align-items-center">
                                    <div class="db-info">
                                        <h6>Jurusan</h6>
                                        <h3>{{ $jumlahJurusan }}</h3> <!-- dari controller -->
                                    </div>
                                    <div class="db-icon">
                                        <img src="{{ URL::to('assets/img/icons/dash-icon-03.svg') }}" alt="Dashboard Icon">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="col-xl-3 col-sm-6 col-12 d-flex">
                        <div class="card bg-comman w-100">
                            <div class="card-body">
                                <div class="db-widgets d-flex justify-content-between align-items-center">
                                    <div class="db-info">
                                        <h6>Reputasi</h6>
                                        <h3></h3>
                                    </div>
                                    <div class="db-icon">
                                        <img src="{{ URL::to('assets/img/icons/dash-icon-04.svg') }}" alt="Dashboard Icon">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                {{-- Chart Section --}}
                <div class="row mt-4">
                    {{-- Overview Guru dan Siswa --}}
                    <div class="col-md-12 col-lg-6">
                        <div class="card card-chart">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Overview Guru dan Siswa</h5>
                            </div>
                            <div class="card-body d-flex justify-content-center align-items-center" style="height: 300px;">
                                <div style="width: 80%; max-width: 240px;">
                                    <canvas id="overviewChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Jumlah Siswa per Jurusan --}}
                    <div class="col-md-12 col-lg-6">
                        <div class="card card-chart">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Jumlah Siswa per Jurusan</h5>
                            </div>
                            <div class="card-body d-flex justify-content-center align-items-center" style="height: 300px;">
                                <div style="width: 100%; max-width: 100%;">
                                    <canvas id="studentsByMajorChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                    @push('scripts')
                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                        <script>
                            // Pie Chart - Overview Guru dan Siswa
                            const overviewCtx = document.getElementById('overviewChart').getContext('2d');
                            const overviewChart = new Chart(overviewCtx, {
                                type: 'doughnut',
                                data: {
                                    labels: ['Guru', 'Siswa'],
                                    datasets: [{
                                        label: 'Total',
                                        data: [{{ $jumlahGuru }}, {{ $jumlahSiswaLaki + $jumlahSiswaPerempuan }}],
                                        backgroundColor: [
                                            'rgba(75, 192, 192, 0.7)', // biru toska
                                            'rgba(255, 99, 132, 0.7)'  // pink merah
                                        ],
                                        borderColor: ['#ffffff', '#ffffff'],
                                        borderWidth: 2,
                                        hoverOffset: 8
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    cutout: '60%',
                                    plugins: {
                                        legend: {
                                            position: 'bottom',
                                            labels: {
                                                color: '#333',
                                                font: {
                                                    size: 14
                                                }
                                            }
                                        },
                                        tooltip: {
                                            backgroundColor: '#fff',
                                            titleColor: '#000',
                                            bodyColor: '#333',
                                            borderColor: '#ddd',
                                            borderWidth: 1
                                        }
                                    }
                                }
                            });

                            // Bar Chart - Number of Students
                            const barCtx = document.getElementById('numberOfStudentsChart').getContext('2d');
                            const gradientBoys = barCtx.createLinearGradient(0, 0, 0, 300);
                            gradientBoys.addColorStop(0, '#36A2EB');
                            gradientBoys.addColorStop(1, '#A0D8F1');

                            const gradientGirls = barCtx.createLinearGradient(0, 0, 0, 300);
                            gradientGirls.addColorStop(0, '#FF6384');
                            gradientGirls.addColorStop(1, '#FDC6C6');

                            const numberOfStudentsChart = new Chart(barCtx, {
                                type: 'bar',
                                data: {
                                    labels: ['Laki-laki', 'Perempuan'],
                                    datasets: [{
                                        label: 'Jumlah',
                                        data: [{{ $jumlahSiswaLaki }}, {{ $jumlahSiswaPerempuan }}],
                                        backgroundColor: [gradientBoys, gradientGirls],
                                        borderRadius: 10,
                                        barPercentage: 0.6,
                                        categoryPercentage: 0.5
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    scales: {
                                        y: {
                                            beginAtZero: true,
                                            ticks: {
                                                color: '#555',
                                                stepSize: 1
                                            },
                                            grid: {
                                                color: '#eee'
                                            }
                                        },
                                        x: {
                                            ticks: {
                                                color: '#555'
                                            },
                                            grid: {
                                                display: false
                                            }
                                        }
                                    },
                                    plugins: {
                                        legend: {
                                            display: false
                                        },
                                        tooltip: {
                                            backgroundColor: '#fff',
                                            titleColor: '#000',
                                            bodyColor: '#333',
                                            borderColor: '#ddd',
                                            borderWidth: 1
                                        }
                                    }
                                }
                            });
                        </script>
                    @endpush

                    <script>
                        const ctxMajor = document.getElementById('studentsByMajorChart').getContext('2d');

                        const dataJurusan = {
                            labels: {!! json_encode($jurusanLabels) !!},
                            datasets: [
                                {
                                    label: 'Laki-Laki',
                                    data: {!! json_encode($jumlahLaki) !!},
                                    backgroundColor: 'rgba(54, 162, 235, 0.7)'
                                },
                                {
                                    label: 'Perempuan',
                                    data: {!! json_encode($jumlahPerempuan) !!},
                                    backgroundColor: 'rgba(255, 99, 132, 0.7)'
                                }
                            ]
                        };

                        const configJurusan = {
                            type: 'bar',
                            data: dataJurusan,
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: {
                                        position: 'top',
                                        labels: {
                                            font: {
                                                size: 12
                                            }
                                        }
                                    },
                                    tooltip: {
                                        backgroundColor: '#fff',
                                        titleColor: '#000',
                                        bodyColor: '#333',
                                        borderColor: '#ddd',
                                        borderWidth: 1
                                    }
                                },
                                scales: {
                                    x: {
                                        ticks: {
                                            color: '#555',
                                            font: {
                                                size: 11
                                            }
                                        }
                                    },
                                    y: {
                                        beginAtZero: true,
                                        ticks: {
                                            stepSize: 1,
                                            color: '#555'
                                        },
                                        grid: {
                                            color: '#eee'
                                        }
                                    }
                                }
                            }
                        };

                        new Chart(ctxMajor, configJurusan);
                    </script>


    @endsection