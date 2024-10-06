@extends(backpack_view('blank'))


@section('content')


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
