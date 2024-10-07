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
                            <select class="form-select" name="material_id" id="material" value="{{ old('material_id') }}" class="form-control @error('material_id') is-invalid @enderror">
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
                            <input type="number" name="quantity" value="{{ old('quantity') }}" class="form-control @error('subject') is-invalid @enderror">
                            @error('quantity')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <input type="hidden" name="project_id" value="{{ $entry->id }}">
                    </div>

                    <div id="saveActions" class="form-group">
                        <input type="hidden" name="_save_action" value="save_material">
                        <button type="submit" class="btn btn-success">
                            <span class="la la-save" role="presentation" aria-hidden="true"></span> &nbsp;
                            <span data-value="save_material">Save Material</span>
                        </button>
                        <a href="{{ url($crud->route) }}" class="btn btn-default"><span class="la la-ban"></span> &nbsp;Cancel</a>
                    </div>
            </form>
        </div>
    </div>

    {{-- List all materials --}}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Material for project: {{ $project->name }}</h3>
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
                                <td class="text-secondary">{{ $item->pivot->quantity }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modifyModal"
                                            data-name="{{ $item->name }}"
                                            data-quantity="{{ $item->pivot->quantity }}"
                                            data-project_id="{{ $project->id }}"
                                            data-material_id="{{ $item->id }}">
                                            Edit
                                        </button>
                                        <form action="{{ route('materialsRequire.destroy', [$project->id, $item->id]) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- The Modal -->


    @push('after_scripts')
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<div class="modal fade" id="modifyModal" tabindex="-1" role="dialog" aria-labelledby="modifyModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modifyModalLabel">Modify Item Quantity</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="POST" id="modalForm">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="modalName" name="name" readonly>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity:</label>
                            <input type="number" class="form-control" id="modalQuantity" name="quantity" required>
                        </div>
                        <input type="hidden" id="modalProject_id" name="project_id">
                        <input type="hidden" id="modalMaterial_id" name="material_id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
        <script>
            $(document).ready(function() {
                $('#modifyModal').on('show.bs.modal', function (event) {
                    var button = $(event.relatedTarget); // Button that triggered the modal
                    var name = button.data('name'); // Extract info from data-* attributes
                    var quantity = button.data('quantity');
                    var material_id = button.data('material_id');
                    var project_id = button.data('project_id');

                    // Update the modal's content
                    var modal = $(this);
                    modal.find('#modalName').val(name);
                    modal.find('#modalQuantity').val(quantity);
                    modal.find('#modalMaterial_id').val(material_id);
                    modal.find('#modalProject_id').val(project_id);

                    // Update the form action to point to the correct route
                    modal.find('#modalForm').attr('action', '/admin/materialsRequireUpdate/' + project_id + '/' + material_id);
                });
            });
        </script>
    @endpush
@endsection
