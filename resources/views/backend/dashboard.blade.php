@extends('layouts.admin')

@section('content')
<div id="dashboard" class="px-3 py-3">
    <div>
        <h5 class="page-title">Dashboard</h5>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-shadow mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="mb-3">Customers</div>
                                    <div>
                                        <h4><strong>36,254</strong></h4>
                                    </div>
                                </div>
                                <div class="grey lighten-4 rounded p-2">
                                    <span class="text-ink"><i class="fas fa-user-friends fa-lg"></i></span>
                                </div>
                            </div>
                            <div class="small py-3">
                                <span class="text-green font-weight-bold"><i class="fas fa-arrow-up"></i> 5.56 %</span>
                                Since last month
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-shadow mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="mb-3">Orders</div>
                                    <div>
                                        <h4><strong>5,432</strong></h4>
                                    </div>
                                </div>
                                <div class="grey lighten-4 rounded p-2">
                                    <span class="text-ink"><i class="fas fa-luggage-cart fa-lg"></i></span>
                                </div>
                            </div>
                            <div class="small py-3">
                                <span class="text-red font-weight-bold"><i class="fas fa-arrow-down"></i> 1.04 %</span>
                                Since last month
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-shadow mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="mb-3">Revenue</div>
                                    <div>
                                        <h4><strong>$ 6,254</strong></h4>
                                    </div>
                                </div>
                                <div class="grey lighten-4 rounded p-2">
                                    <span class="text-ink"><i class="fas fa-dollar-sign fa-lg"></i></span>
                                </div>
                            </div>
                            <div class="small py-3">
                                <span class="text-red font-weight-bold"><i class="fas fa-arrow-up"></i> 7 %</span>
                                Since last month
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-shadow mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="mb-3">Growth</div>
                                    <div>
                                        <h4><strong>+ 30.56 %</strong></h4>
                                    </div>
                                </div>
                                <div class="grey lighten-4 rounded p-2">
                                    <span class="text-ink"><i class="fas fa-chart-line fa-lg"></i></span>
                                </div>
                            </div>
                            <div class="small py-3">
                                <span class="text-green font-weight-bold"><i class="fas fa-arrow-up"></i> 4.86 %</span>
                                Since last month
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-shadow">
                <div class="p-2">
                    <canvas id="bubbleChart" class=""></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="card card-shadow">
                <div class="card-body">
                    <div class="d-flex mb-2">
                        <div><strong>Revenue</strong></div>
                        <div class="ml-auto"><i class="fas fa-ellipsis-v"></i></div>
                    </div>
                    <div class="grey lighten-5 p-3">
                        <div class="row">
                            <div class="col-md-6 text-center">
                                <div><small>Current Week</small></div>
                                <i class="fas fa-circle fa-sm text-green mr-2"></i><strong>$ 5,248</strong>
                            </div>
                            <div class="col-md-6 text-center">
                                <div><small>Previous Week</small></div>
                                <i class="fas fa-circle fa-sm text-ink mr-2"></i><strong>$ 6,122</strong>
                            </div>
                        </div>
                    </div>
                    <div class="my-3"></div>
                    <canvas id="lineChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-shadow">
                <div class="card-body">
                    <div class="d-flex mb-2">
                        <div><strong>Total Sales</strong></div>
                        <div class="ml-auto"><i class="fas fa-ellipsis-v"></i></div>
                    </div>
                    <div class="grey lighten-5 p-3">
                        <div class="row">
                            <div class="col-md-6 text-center">
                                <div><small>Current Week</small></div>
                                <i class="fas fa-circle fa-sm text-green mr-2"></i><strong>$ 55,248</strong>
                            </div>
                            <div class="col-md-6 text-center">
                                <div><small>Previous Week</small></div>
                                <i class="fas fa-circle fa-sm text-ink mr-2"></i><strong>$ 68,122</strong>
                            </div>
                        </div>
                    </div>
                    <div class="my-3"></div>
                    <canvas id="doughnutChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    var ctxBc = document.getElementById('bubbleChart').getContext('2d');
    var bubbleChart = new Chart(ctxBc, {
        type: 'bubble',
        data: {
            datasets: [{
                label: 'Green',
                data: [{
                    x: 3,
                    y: 7,
                    r: 10
                }],
                backgroundColor: "#24e873",
                hoverBackgroundColor: "#ff6384"
            }, {
                label: 'Red',
                data: [{
                    x: 4,
                    y: 7,
                    r: 15
                }],
                backgroundColor: "#fc5d51",
                hoverBackgroundColor: "#44e4ee"
            }, {
                label: 'Ink',
                data: [{
                    x: 5,
                    y: 7,
                    r: 10
                }],
                backgroundColor: "#667bf1",
                hoverBackgroundColor: "#62088A"
            }]
        },
    })
    
    // Line Chart
    var ctxL = document.getElementById("lineChart").getContext('2d');
    var myLineChart = new Chart(ctxL, {
        type: 'line',
        data: {
            labels: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
            datasets: [{
                label: "Current Weak",
                data: [65, 59, 70, 60, 56, 57, 62],
                backgroundColor: [
                'transparent'
                ],
                borderColor: [
                'rgba(200, 99, 132, .7)',
                ],
                borderWidth: 2
            },
            {
                label: "Previous Week",
                data: [59, 55, 74, 61, 53, 54, 67],
                // data: [65, 59, 80, 81, 56, 55, 40],
                backgroundColor: [
                'transparent',
                ],
                borderColor: [
                'rgba(0, 10, 130, .7)',
                ],
                borderWidth: 2
            }
            ]
        },
        options: {
            responsive: true,
            legend: {
                display: false,
                position: "bottom",
            },
            animation: {
                duration: 1000,
                easing: "linear",
            }
        }
    });
    
    // Doughnut Chart
    //doughnut
    var ctxD = document.getElementById("doughnutChart").getContext('2d');
    var myLineChart = new Chart(ctxD, {
        type: 'doughnut',
        data: {
            labels: ["Red", "Green", "Yellow", "Grey", "Dark Grey"],
            datasets: [{
                data: [300, 50, 100, 40, 120],
                backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360"],
                hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774"]
            }],
        },
        
        options: {
            responsive: true,
            legend: {
                display: false,
                position: "bottom",
            },
            animation: {
                duration: 4000,
                easing: "easeOutElastic",
            }
        },
        
    });
</script>
@endpush