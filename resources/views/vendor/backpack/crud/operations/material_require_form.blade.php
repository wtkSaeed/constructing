@extends(backpack_view('blank'))

@php
$defaultBreadcrumbs = [
    trans('backpack::crud.admin') => url(config('backpack.base.route_prefix'), 'dashboard'),
    $crud->entity_name_plural => url($crud->route),
    'Require Material' => false,
];
// if breadcrumbs aren't defined in the CrudController, use the default breadcrumbs
$breadcrumbs = $breadcrumbs ?? $defaultBreadcrumbs;
@endphp




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

            <form method="post" action="">
                @csrf
                <div class="card">
                    <div class="card-body row">

                        <section class="container-fluid">
                            <h2>
                                <span class="text-capitalize">Add Materials</span>
                                <small>Manage Require Material to: {!! $entry->name !!}.</small>

                            </h2>
                        </section>

                        <div class="form-group col-md-8">
                            <label>Material</label>


                            <select class="form-select" name="material_id" id="material" value="{{ old('material_id')}}" class="form-control @error('material_id') is-invalid @enderror">

                                @foreach ($materials as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>


                            @error('material_id')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                        </div>
                        <div class="form-group col-md-4">
                             <label>Quantity</label>
                             <input type="number" name="quantity" value="{{ old('quantity') }}"  class="form-control @error('subject') is-invalid @enderror">
                               @error('quantity')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                               @enderror
                        </div>
                        <input type="hidden" name="project_id" value="{{$entry->id}}">
                    </div>

                <div class="d-none" id="parentLoadedAssets">[]</div>
                <div id="saveActions" class="form-group">
                    <input type="hidden" name="_save_action" value="save_material">
                    &nbsp; &nbsp; &nbsp; &nbsp;<button type="submit" class="btn btn-success">
                        <span class="la la-save" role="presentation" aria-hidden="true"></span> &nbsp;
                        <span data-value="save_material">Save Material</span>
                    </button>
                    <div class="btn-group" role="group">
                    </div>
                    <a href="{{ url($crud->route) }}" class="btn btn-default"><span class="la la-ban"></span>
                        &nbsp;Cancel</a>
                </div>
            </form>


        </div>
        </div>
    </div>


{{-- list all materials... --}}

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
