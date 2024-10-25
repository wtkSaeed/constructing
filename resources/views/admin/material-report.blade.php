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
            <h3 class="card-title">Material Report</h3>
        </div>
        <div class="card-body">

            <div class="box-header with-border">
                <h3 class="box-title">Material Report</h3>
            </div>
            <div class="box-body">
                <form id="project-select-form">
                    <div class="form-group">
                        <label for="project-select">Select Project</label>
                        <select id="project-select" class="form-control">
                            <option value="">--Select Project--</option>
                            @foreach ($projects as $project)
                                <option value="{{ $project->id }}">{{ $project->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>

                <table class="table table-bordered" id="materials-table" style="display: none;">
                    <thead>
                        <tr>
                            <th>Material Name</th>
                            <th>Available</th>
                            <th>Requested</th>
                            <th>diff</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Table rows will be populated by JavaScript -->
                    </tbody>
                </table>
            </div>

        </div>

        @push('after_scripts')
            <script>
                document.getElementById('project-select').addEventListener('change', function() {
                    var projectId = this.value;
                    if (projectId) {
                        fetch('/admin/material-report/' + projectId)
                            .then(response => response.json())
                            .then(data => {
                                var table = document.getElementById('materials-table');
                                var tbody = table.querySelector('tbody');
                                tbody.innerHTML = '';

                                data.materials.forEach(function(material) {
                                    var row = tbody.insertRow();
                                    row.insertCell(0).innerText = material.material_name;
                                    row.insertCell(1).innerText = material.available;
                                    row.insertCell(2).innerText = material.requested;
                                    var diffCell = row.insertCell(3);
                                    var diff = material.available - material.requested;
                                    diffCell.innerText = diff;
                                    if (diff < 0) {
                                        diffCell.style.color = 'red';
                                    }
                                });

                                table.style.display = 'table';
                            });
                    } else {
                        document.getElementById('materials-table').style.display = 'none';
                    }
                });
            </script>
        @endpush
    @endsection
