@extends('layouts.app')

@section('content')


<div class="container-fluid">
    <h2 class="text-center my-4">Báo Cáo Thống Kê Điểm</h2>
    <div class="text-end mb-3">
        <a href="{{ route('export.scores') }}" class="btn btn-success" id="export-btn">
            Export Excel
        </a>
    </div>
    <div class="row">
        <div class="col-12 col-md-10 col-lg-8">
            <canvas id="scoreChart"></canvas>
        </div>
        
        <!-- Danh sách top 10 học sinh nhóm A -->
        <div class="col-md-4">
            <h4>Top 10 Học Sinh Nhóm A</h4>
            <div style="max-height: 400px; overflow-y: auto;" class="border rounded p-2">
                <ul class="list-group">
                    @foreach($students as $student)
                    <li class="list-group-item">
                        <strong>{{ $student->name }} (ID: {{ $student->registration_number }})</strong> | 
                        Math: <strong>{{ $student->math }}</strong> |  
                        Physics: <strong>{{ $student->physics }}</strong> |  
                        Chemistry: <strong>{{ $student->chemistry }}</strong> |  
                        <strong>Average Score:</strong> {{ round(($student->math + $student->physics + $student->chemistry) / 3, 2) }} points
                    </li>
                    @endforeach
                </ul>
            </div>
            
        </div>
    </div>
</div>

<!-- Thêm Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var ctx = document.getElementById("scoreChart").getContext("2d");
        var scoreChart = new Chart(ctx, {
            type: "bar",
            data: {
                labels: {!! json_encode(array_keys($scoreStatistics)) !!},
                datasets: [
                    {
                        label: "excellent (>=8)",
                        backgroundColor: "#4caf50",
                        data: {!! json_encode(array_column($scoreStatistics, 'excellent')) !!}
                    },
                    {
                        label: "good (6-8)",
                        backgroundColor: "#2196f3",
                        data: {!! json_encode(array_column($scoreStatistics, 'good')) !!}
                    },
                    {
                        label: "average (4-6)",
                        backgroundColor: "#ffeb3b",
                        data: {!! json_encode(array_column($scoreStatistics, 'average')) !!}
                    },
                    {
                        label: "weak (<4)",
                        backgroundColor: "#f44336",
                        data: {!! json_encode(array_column($scoreStatistics, 'weak')) !!}
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    });
</script>
@endsection