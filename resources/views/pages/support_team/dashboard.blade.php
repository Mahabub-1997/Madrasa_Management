@extends('layouts.master')
@section('page_title', 'আমার ড্যাশবোর্ড')
@section('content')

    @if(Qs::userIsTeamSA())
        <div class="row">
            {{-- Existing Statistic Cards --}}
            <div class="col-sm-6 col-xl-4 mb-3">
                <div class="card card-body has-bg-image" style="background: linear-gradient(360deg, #1a202c, #3b82f6)">
                    <div class="media">
                        <div class="media-body">
                            <h3 class="mb-0">{{ $users->where('user_type', 'student')->count() }}</h3>
                            <span class="text-uppercase font-size-xs font-weight-bold">মোট শিক্ষার্থী</span>
                        </div>
                        <div class="ml-3 align-self-center">
                            <i class="icon-users4 icon-3x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-xl-4 mb-3">
                <div class="card card-body has-bg-image" style="background: linear-gradient(360deg, #1a202c, #3b82f6)">
                    <div class="media">
                        <div class="media-body">
                            <h3 class="mb-0">{{ $users->where('user_type', 'teacher')->count() }}</h3>
                            <span class="text-uppercase font-size-xs">মোট শিক্ষক</span>
                        </div>
                        <div class="ml-3 align-self-center">
                            <i class="icon-user icon-3x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-xl-4 mb-3">
                <div class="card card-body has-bg-image" style="background: linear-gradient(360deg, #1a202c, #3b82f6)">
                    <div class="media">
                        <div class="media-body">
                            <h3 class="mb-0">{{ $countClass }}</h3>
                            <span class="text-uppercase font-size-xs font-weight-bold">সর্বমোট ক্লাস</span>
                        </div>
                        <div class="ml-3 align-self-center">
                            <i class="icon-books icon-3x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-xl-4 mb-3">
                <div class="card card-body has-bg-image" style="background: linear-gradient(360deg, #1a202c, #3b82f6)">
                    <div class="media">
                        <div class="media-body">
                            <h3 class="mb-0">{{ $users->where('user_type', 'admin')->count() }}</h3>
                            <span class="text-uppercase font-size-xs font-weight-bold">প্রশাসকগণ</span>
                        </div>
                        <div class="ml-3 align-self-center">
                            <i class="icon-pointer icon-3x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-xl-4 mb-3">
                <div class="card card-body has-bg-image" style="background: linear-gradient(360deg, #1a202c, #3b82f6)">
                    <div class="media">
                        <div class="media-body">
                            <h3 class="mb-0">{{ number_format($report['total_income'], 2) }} ৳</h3>
                            <span class="text-uppercase font-size-xs font-weight-bold">মোট আয়</span>
                        </div>
                        <div class="ml-3 align-self-center">
                            <i class="icon-coin-dollar icon-3x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-xl-4 mb-3">
                <div class="card card-body has-bg-image" style="background: linear-gradient(360deg, #1a202c, #3b82f6)">
                    <div class="media">
                        <div class="media-body">
                            <h3 class="mb-0">{{ number_format($report['total_expenses'], 2) }} ৳</h3>
                            <span class="text-uppercase font-size-xs font-weight-bold">মোট খরচ</span>
                        </div>
                        <div class="ml-3 align-self-center">
                            <i class="icon-cash3 icon-3x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Bar + Line Chart --}}
            <div class="col-12 mt-4">
                <div class="card card-body has-bg-image"
                     style="background: linear-gradient(360deg, #1a202c, #3b82f6); color: #fff; height: 300px; width: 100%;">
                    <h5 class="mb-3">ড্যাশবোর্ড সংক্ষিপ্ত চিত্র</h5>
                    <canvas id="dashboardChart" style="width: 100%; height: 100%;"></canvas>
                </div>
            </div>
        </div>
    @endif

    {{-- Calendar and Pie Chart side by side --}}
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card border-success h-100">
                <div class="card-header header-elements-inline bg-blue-400" style="background-color: #a3d7a5">
                    <h5 class="card-title" style="font-weight: bold;">বিদ্যালয়ের কার্যক্রমের পঞ্জিকা</h5>
                    {!! Qs::getPanelOptions() !!}
                </div>
                <div class="card-body" style="min-height: 400px;">
                    <div class="fullcalendar-basic"></div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card card-body has-bg-image h-100" style="background: linear-gradient(360deg, #1a202c, #3b82f6); color: #fff; height: 400px;">
                <h5 class="mb-3">আয়ের ও খরচের শতাংশ</h5>
                <canvas id="pieChart" style="width: 100%; height: 320px;"></canvas>
            </div>
        </div>
    </div>

    {{-- Chart JS CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    {{-- Charts Script --}}
    <script>
        // Bar + Line Chart
        const ctxBarLine = document.getElementById('dashboardChart').getContext('2d');
        new Chart(ctxBarLine, {
            type: 'bar',
            data: {
                labels: [
                    'শিক্ষার্থী',
                    'শিক্ষক',
                    'ক্লাস',
                    'প্রশাসক',
                    'মোট আয় (৳)',
                    'মোট খরচ (৳)'
                ],
                datasets: [
                    {
                        label: 'পরিসংখ্যান (বার)',
                        type: 'bar',
                        data: [
                            {{ $users->where('user_type', 'student')->count() }},
                            {{ $users->where('user_type', 'teacher')->count() }},
                            {{ $countClass }},
                            {{ $users->where('user_type', 'admin')->count() }},
                            {{ number_format($report['total_income'], 2, '.', '') }},
                            {{ number_format($report['total_expenses'], 2, '.', '') }}
                        ],
                        backgroundColor: [
                            '#60a5fa',
                            '#34d399',
                            '#fbbf24',
                            '#f87171',
                            '#4ade80',
                            '#facc15'
                        ],
                        borderColor: '#1e3a8a',
                        borderWidth: 1
                    },
                    {
                        label: 'পরিসংখ্যান (লাইন)',
                        type: 'line',
                        data: [
                            {{ $users->where('user_type', 'student')->count() }},
                            {{ $users->where('user_type', 'teacher')->count() }},
                            {{ $countClass }},
                            {{ $users->where('user_type', 'admin')->count() }},
                            {{ number_format($report['total_income'], 2, '.', '') }},
                            {{ number_format($report['total_expenses'], 2, '.', '') }}
                        ],
                        borderColor: '#f43f5e',
                        backgroundColor: 'rgba(244, 63, 94, 0.2)',
                        fill: true,
                        tension: 0.3,
                        pointBackgroundColor: '#f43f5e',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: '#f43f5e'
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { color: '#fff' },
                        grid: { color: 'rgba(255, 255, 255, 0.1)' }
                    },
                    x: {
                        ticks: { color: '#fff' },
                        grid: { color: 'rgba(255, 255, 255, 0.1)' }
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            color: '#fff'
                        }
                    }
                }
            }
        });

        // Pie Chart for Income vs Expenses
        const ctxPie = document.getElementById('pieChart').getContext('2d');
        new Chart(ctxPie, {
            type: 'pie',
            data: {
                labels: ['মোট আয়', 'মোট খরচ'],
                datasets: [{
                    data: [
                        {{ $report['total_income'] }},
                        {{ $report['total_expenses'] }}
                    ],
                    backgroundColor: ['#4ade80', '#f87171'],
                    hoverOffset: 30
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#fff',
                            font: { size: 14 }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.label || '';
                                let value = context.parsed || 0;
                                return label + ': ' + value.toLocaleString() + ' ৳';
                            }
                        }
                    }
                }
            }
        });
    </script>
@endsection
