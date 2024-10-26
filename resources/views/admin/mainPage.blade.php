@extends(backpack_view('blank'))

@section('content')
    <div class="row">
        <div class="col-md-12 bold-labels">
            @if ($errors->any())
                <div class="alert alert-danger pb-0">
                    <ul class="list-unstyled">
                        @foreach ($errors->all() as $error)
                            <li><i class="la la-info-circle"></i> {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif


        </div>
    </div>
    {{-- show projects detaisl .... --}}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Project by Months </h3>
        </div>
        <div class="card-body">

            <div class="row justify-content-center">
                <div class="col-md-8">
            <canvas id="projectsChart" class="img-fluid"></canvas>
        </div>
    </div>
        </div>
    </div>
 {{-- show projects counts by status .... --}}
 <div class="card">
    <div class="card-header">
        <h3 class="card-title">Project by Status </h3>
    </div>
    <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-md-8">

        <canvas id="projectsStatusChart" class="img-fluid"></canvas>
    </div>
</div>
    </div>
</div>
        @push('after_scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            var ctx = document.getElementById('projectsChart').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($months),
                    datasets: [{
                        label: 'Number of Projects',
                        data: @json($projectCounts),
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>

{{-- for projects count bys tatus --}}


<script>
    var ctx = document.getElementById('projectsStatusChart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: @json($statuses),
            datasets: [{
                label: 'Number of Projects by Status',
                data: @json($projectCountsByStatus),
                backgroundColor: [
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(54, 162, 235, 0.2)'
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(54, 162, 235, 1)'
                ],
                borderWidth: 1
            }]
        }
    });
</script>
        @endpush
    @endsection
