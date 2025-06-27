@extends('dashboards.templates.base')

@section('title', 'Dashboard')

@if (Auth::user()->role == 'admin')
    @section('chart')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                function grafikSkorTotalperBulan() {
                    const categories = @json($bulan);
                    const bookingData = @json($bookingCounts);



                    let options = {
                        series: [{
                            name: 'Jumlah Booking',
                            data: bookingData
                        }],
                        chart: {
                            type: 'bar',
                            height: 350
                        },
                        plotOptions: {
                            bar: {
                                horizontal: false,
                                columnWidth: '55%',
                                endingShape: 'rounded'
                            },
                        },
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            show: true,
                            width: 2,
                            colors: ['transparent']
                        },
                        xaxis: {
                            title: {
                                text: 'Bulan di Tahun {{ now()->year }}'
                            },
                            categories: categories,
                        },
                        yaxis: {
                            title: {
                                text: 'Jumlah Booking'
                            }
                        },
                        fill: {
                            opacity: 1
                        },
                        tooltip: {
                            y: {
                                formatter: function(val) {
                                    return val + " Booking"
                                }
                            }
                        }
                    };

                    let chart = new ApexCharts(document.querySelector("#transaksiBulanan"), options);
                    chart.render();
                }

                function grafikSkorTotalperHari() {
                    const hariLabels = @json($tanggalHarian);
                    const hariData = @json($jumlahHarian);



                    let options = {
                        series: [{
                            name: 'Jumlah Booking',
                            data: hariData
                        }],
                        chart: {
                            type: 'line',
                            height: 350
                        },

                        xaxis: {
                            title: {
                                text: 'Tanggal di Bulan {{ now()->month }}'
                            },
                            categories: hariLabels,
                        },
                        yaxis: {
                            title: {
                                text: 'Jumlah Booking'
                            }
                        },
                        tooltip: {
                            y: {
                                formatter: function(val) {
                                    return val + " Booking"
                                }
                            }
                        }
                    };

                    let chart = new ApexCharts(document.querySelector("#transaksiHarian"), options);
                    chart.render();
                }

                function grafikSkorTotalperMinggu() {
                    const mingguLabels = @json($minggu);
                    const mingguData = @json($jumlahMingguan);



                    let options = {
                        series: [{
                            name: 'Jumlah Booking',
                            data: mingguData
                        }],
                        chart: {
                            type: 'bar',
                            height: 350
                        },
                        plotOptions: {
                            bar: {
                                horizontal: false,
                                columnWidth: '55%',
                                endingShape: 'rounded'
                            },
                        },
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            show: true,
                            width: 2,
                            colors: ['transparent']
                        },
                        xaxis: {
                            title: {
                                text: 'Minggu di Bulan {{ now()->month }}'
                            },
                            categories: mingguLabels,
                        },
                        yaxis: {
                            title: {
                                text: 'Jumlah Booking'
                            }
                        },
                        fill: {
                            opacity: 1
                        },
                        tooltip: {
                            y: {
                                formatter: function(val) {
                                    return val + " Booking"
                                }
                            }
                        }
                    };

                    let chart = new ApexCharts(document.querySelector("#transaksiPerminggu"), options);
                    chart.render();
                }






                grafikSkorTotalperBulan();
                grafikSkorTotalperHari();
                grafikSkorTotalperMinggu();

            });
        </script>
    @endsection
@endif


@section('content')
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session('error') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif


    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">

            <div class="col-lg-4 col-md-4 order-1">
                <div class="row">
                    {{-- auth role admin dan worker --}}

                    @if (Auth::user()->role == 'admin')
                        <div class="col-lg-6 col-md-12 col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <i class='bx bx-user' style="font-size: 50px;"></i>
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                                <a class="dropdown-item" href="#">View
                                                    More</a>
                                            </div>
                                        </div>
                                    </div>
                                    <span>Pelanggan</span>
                                    <h3 class="card-title text-nowrap mb-1">
                                        {{ $users }}
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <i class='bx bxs-spreadsheet' style="font-size: 50px;"></i>
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">


                                                <a class="dropdown-item" href="#">View More</a>


                                            </div>
                                        </div>
                                    </div>
                                    <span>Layanan</span>
                                    <h3 class="card-title text-nowrap mb-1">
                                        {{ $services }}
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <i class='bx bx-briefcase-alt' style="font-size: 50px;"></i>
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">


                                                <a class="dropdown-item" href="#">View More</a>


                                            </div>
                                        </div>
                                    </div>
                                    <span>Pekerja</span>
                                    <h3 class="card-title text-nowrap mb-1">
                                        {{ $workers }}</h3>
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <i class='bx bx-money' style="font-size: 50px;"></i>
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">


                                                <a class="dropdown-item" href="#">View More</a>


                                            </div>
                                        </div>
                                    </div>
                                    <span>Booking</span>
                                    <h3 class="card-title text-nowrap mb-1">
                                        {{ $bookings }}</h3>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (Auth::user()->role == 'user')
                        <div class="col-lg-6 col-md-12 col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <i class='bx bx-money' style="font-size: 50px;"></i>
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn p-0" type="button" id="cardOpt6"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">


                                                <a class="dropdown-item" href="#">View More</a>


                                            </div>
                                        </div>
                                    </div>
                                    <span>Booking</span>
                                    <h3 class="card-title text-nowrap mb-1">
                                        {{ $bookings }}</h3>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if (Auth::user()->role == 'worker')
                        <div class="col-lg-6 col-md-12 col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <i class='bx bx-money' style="font-size: 50px;"></i>
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn p-0" type="button" id="cardOpt6"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">


                                                <a class="dropdown-item" href="#">View More</a>


                                            </div>
                                        </div>
                                    </div>
                                    <span>Kerja</span>
                                    <h3 class="card-title text-nowrap mb-1">
                                        {{ $histories }}</h3>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    @endif





                </div>
            </div>


            @if (Auth::user()->role == 'admin')
                <!-- Total Revenue -->
                <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
                    <div class="card">
                        <div class="row row-bordered g-0">
                            <div class="col-md-12">
                                <h5 class="card-header m-0 me-2 pb-3">Grafik Transaksi Bulanan</h5>
                                <div id="transaksiBulanan" class="px-2"></div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
                    <div class="card">
                        <div class="row row-bordered g-0">
                            <div class="col-md-12">
                                <h5 class="card-header m-0 me-2 pb-3">Grafik Transaksi Harian</h5>
                                <div id="transaksiHarian" class="px-2"></div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
                    <div class="card">
                        <div class="row row-bordered g-0">
                            <div class="col-md-12">
                                <h5 class="card-header m-0 me-2 pb-3">Grafik Transaksi Minggu</h5>
                                <div id="transaksiPerminggu" class="px-2"></div>
                            </div>

                        </div>
                    </div>
                </div>
            @endif

        </div>

    </div>

@endsection
