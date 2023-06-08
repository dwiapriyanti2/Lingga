@extends('template.master')
@section('title', 'Dashboard')
@section('content')
    <div class="row">
        <div class="col-lg-4 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $totalSuratMasuk != null ? $totalSuratMasuk : '0' }}</h3>
                    <p>Total Surat Masuk</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                @if (Auth::user()->level == 0)
                    <a href="{{ url('laporan-surat-masuk') }}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                @else
                    <a href="{{ url('surat-masuk') }}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                @endif
            </div>
        </div>

        <div class="col-lg-4 col-6">

            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $totalSuratKeluar != null ? $totalSuratKeluar : '0' }}</h3>
                    <p>Total Surat Keluar</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                @if (Auth::user()->level == 0)
                    <a href="{{ url('laporan-surat-keluar') }}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                @else
                    <a href="{{ url('surat-keluar') }}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                @endif
            </div>
        </div>

        <div class="col-lg-4 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $totalUser != null ? $totalUser : '0' }}</h3>
                    <p>Total User</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                @if (Auth::user()->level != '1')
                    <a href="{{ url('users') }}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                @endif
            </div>
        </div>
    </div>

    <!-- PIE CHART -->
    <div class="card card-danger">
        <div class="card-header">
            <h3 class="card-title">Pie Chart</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <canvas id="pieChart" style="min-height: 400px; height: 400px; max-height: 400px; max-width: 100%;"></canvas>
        </div>
    </div>

    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
    <script>
        $(function() {
            /* ChartJS
             * -------
             * Here we will create a few charts using ChartJS
             */

            var donutData = {
                labels: [
                    'Surat Masuk',
                    'Surat Keluar',
                ],
                datasets: [{
                    data: [{{ $totalSuratMasuk }}, {{ $totalSuratKeluar }}],
                    backgroundColor: ['#f56954', '#00a65a'],
                }]
            }

            //-------------
            //- PIE CHART -
            //-------------
            // Get context with jQuery - using jQuery's .get() method.
            var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
            var pieData = donutData;
            var pieOptions = {
                maintainAspectRatio: false,
                responsive: true,
            }
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            new Chart(pieChartCanvas, {
                type: 'pie',
                data: pieData,
                options: pieOptions
            })
        })
    </script>
    <!-- Page specific script -->
@endsection
