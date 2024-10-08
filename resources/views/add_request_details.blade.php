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
    {{-- add new detaisl .... --}}
    @if ($req->status == 1)
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Add for Request: {{ $req->nb }}</h3>
            </div>
            <div class="card-body">
                <div class="row g-2 align-items-center">
                    <div class="col">

                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal"
                            data-name="{{ $materials }}" data-request_id="{{ $req->id }}">

                            + Add More Materials..
                        </button>
                    </div>
                    <!-- Page title actions -->
                    <div class="col-auto ms-auto d-print-none">
                        <div class="btn-list">
                            <form action="{{route('changeRequestStatus',$req->id)}}"
                                method="GET" style="display:inline;">
                                @csrf
                            <span class="d-none d-sm-inline">
                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Are you sure you want to change  this status?')">Change Request Status</button>



                            <select name="request_status"  value="{{ $req->status }}"  class="btn">
                                @foreach($requestStatus as $key => $status)
                                    <option value="{{ $key }}" {{$key ==$req->status?'selected':''}}>{{ $status }}</option>
                                @endforeach
                            </select>
</span></form>
                        </div>
                    </div>
                </div>

            </div>
    @endif
    {{-- List all materials --}}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Details for Request: {{ $req->nb }}</h3>
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
                        @foreach ($details as $item)
                            <tr>
                                <td>{{ $item->material->name }}</td>
                                <td class="text-secondary">{{ $item->quantity }}</td>
                                @if ($req->status == 1)
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#editModal" data-name="{{ $item->material->name }}"
                                                data-quantity="{{ $item->quantity }}" data-id="{{ $item->id }}">
                                                Edit
                                            </button>
                                            &nbsp;
                                            <form action="{{ route('requestDetails.destroy', [$item->id]) }}"
                                                method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                @endif
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


        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modifyModalLabel">Modify Item Quantity</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="" method="POST" id="modalModifyForm">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" id="modalModifyName" name="name" readonly>
                            </div>
                            <div class="form-group">
                                <label for="quantity">Quantity:</label>
                                <input type="number" class="form-control" id="modalModifyQuantity" name="quantity"
                                    required>
                            </div>
                            <input type="hidden" id="modal_id" name="id">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- modal for add new details --}}

        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModal"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Add Item Quantity to the request {{ $req->nb }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('requestDetails.save') }}" method="POST" id="modalAddForm">
                        @csrf

                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <select class="form-select" name="material_id" id="Addmaterial"
                                    value="{{ old('material_id') }}"
                                    class="form-control @error('material_id') is-invalid @enderror">
                                    @foreach ($materials as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="quantity">Quantity:</label>
                                <input type="number" class="form-control" id="modalAddQuantity" name="quantity" required>
                            </div>
                            <input type="hidden" id="modalRequest_id" name="request_id" value="{{ $req->id }}">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- this for load data into modal --}}
        <script>
            $(document).ready(function() {
                $('#editModal').on('show.bs.modal', function(event) {
                    var button = $(event.relatedTarget); // Button that triggered the modal
                    var name = button.data('name'); // Extract info from data-* attributes
                    var quantity = button.data('quantity');
                    var id = button.data('id');


                    // Update the modal's content
                    var modal = $(this);
                    modal.find('#modalModifyName').val(name);
                    modal.find('#modalModifyQuantity').val(quantity);
                    modal.find('#modal_id').val(id);


                    // Update the form action to point to the correct route
                    modal.find('#modalModifyForm').attr('action', '/admin/materialsRequestUpdate/' + id);
                });
            });
        </script>
    @endpush
@endsection
