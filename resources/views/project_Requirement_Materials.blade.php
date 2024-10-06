@extends(backpack_view('blank'))


@section('content')
    <div class="card">


        <div class="card-header">

            <h3 class="pag-title">Material for project: {{ $project->name }}</h3>



            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <span class="d-none d-sm-inline">

                    </span>
                    <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                        data-bs-target="#modal-report">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="icon">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 5l0 14"></path>
                            <path d="M5 12l14 0"></path>
                        </svg>
                        Add new Material
                    </a>

                </div>
            </div>



        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-vcenter card-table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Quantity</th>

                            <th class="w-1"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($project->materials as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td class="text-secondary">
                                    {{ $item->pivot->quantity }}
                                </td>

                                <td>
                                    <a href="#">Edit</a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

{{-- list all materials..... --}}

    <div class="card">


        <div class="card-header">

            <h3 class="card-title">Material for project:  {{$project->name}}</h3>

        </div>
        <div class="card-body">
            <div class="table-responsive">
              <table class="table table-vcenter card-table table-striped">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Quantity</th>

                    <th class="w-1"></th>
                  </tr>
                </thead>
                <tbody>
        @foreach ($project->materials as $item)


                  <tr>
                    <td>{{$item->name}}</td>
                    <td class="text-secondary">
        {{$item->pivot->quantity}}
                    </td>

                    <td>
                      <a href="#">Edit</a>
                    </td>
                  </tr>

                  @endforeach

                </tbody>
              </table>
            </div>
        </div>
          </div>

@endsection
