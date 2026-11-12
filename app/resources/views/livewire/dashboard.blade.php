
<div>
    <h2 class="text-3xl font-semibold text-gray-800 cursor-default"> 
        Statistika postova
    </h2>
    <div class="flex gap-25 flex-col h-screen justify-center items-center mt-10">
        <div class="w-[900px] h-[400px]">
            <canvas width="900" height="400" id="chartLine"></canvas>
        </div>
        <div class="flex gap-12">
            <div class="w-[500px] h-[400px]">
                <canvas width="500" height="400" id="statusChartDoughnut"></canvas>
            </div>

            <div class="w-[500px] h-[400px]">
                <canvas width="500" height="400" id="statusChartBar"></canvas>
            </div>
        </div>
    </div>
</div>

 @script
    <script>
        new Chart($wire.$el.querySelector('#statusChartDoughnut'), {
            type: 'doughnut',
            data: {
                labels: @js($data['labels']),
                datasets: [{
                    label: 'Broj postova',
                    data: [
                        @js($data['status_complete_count']),
                        @js($data['status_pending_count'])
                    ],
                    backgroundColor: [
                        '#22c55e',
                        '#f59e0b'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                cutout: '65%',
                plugins: {
                    legend: {
                        position: 'bottom'
                    },
                        
                }
            }
        });
        new Chart($wire.$el.querySelector('#statusChartBar'), {
            type: 'bar',
            data: {
                labels: @js($data['labels']),
                datasets: [{
                    label: 'Broj postova',
                    data: [
                        @js($data['status_complete_count']),
                        @js($data['status_pending_count'])
                    ],
                    backgroundColor: [
                       '#22c55e',
                        '#f59e0b'
                    ],
                    borderRadius: 8
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });
        new Chart($wire.$el.querySelector('#chartLine'), {
            type: 'line',
            data: {
                labels: @js($labelForLastSevenDay),
                datasets: [{
                    label: 'Broj postova',
                    data: @js($dataForLastSevenDay),

                    borderColor: '#22c55e',
                    borderWidth: 3,

                    backgroundColor: (context) => {
                        const chart = context.chart;
                        const { ctx, chartArea } = chart;

                        if (!chartArea) return 'rgba(34, 197, 94, 0.15)';

                        const gradient = ctx.createLinearGradient(
                            0,
                            chartArea.top,
                            0,
                            chartArea.bottom
                        );

                        gradient.addColorStop(0, 'rgba(34, 197, 94, 0.30)');
                        gradient.addColorStop(1, 'rgba(34, 197, 94, 0.01)');

                        return gradient;
                    },

                    fill: true,
                    tension: 0.4,

                    pointRadius: 0,
                    pointHoverRadius: 6,
                    pointHoverBackgroundColor: '#22c55e',
                    pointHoverBorderColor: '#ffffff',
                    pointHoverBorderWidth: 3,

                    hitRadius: 12
                }]
            },

            options: {
                responsive: true,
                maintainAspectRatio: false,

                interaction: {
                    intersect: false,
                    mode: 'index'
                },

                plugins: {
                    legend: {
                        display: false
                    },

                    tooltip: {
                        backgroundColor: '#18181b',
                        titleColor: '#a1a1aa',
                        bodyColor: '#ffffff',
                        padding: 12,
                        cornerRadius: 10,
                        displayColors: false,

                        titleFont: {
                            size: 12
                        },

                        bodyFont: {
                            size: 14,
                            weight: 'bold'
                        },

                        callbacks: {
                            label: (context) => ` ${context.parsed.y} postova`
                        }
                    }
                },

                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        border: {
                            display: false
                        },
                        ticks: {
                            color: '#a1a1aa',
                            font: {
                                size: 11
                            },
                            maxRotation: 0
                        }
                    },

                    y: {
                        beginAtZero: true,
                        border: {
                            display: false,
                            dash: [4, 4]
                        },
                        grid: {
                            color: 'rgba(148, 163, 184, 0.15)',
                            drawTicks: false
                        },
                        ticks: {
                            precision: 0,
                            color: '#a1a1aa',
                            padding: 10
                        }
                    }
                }
            }
        });
    </script>
 @endscript