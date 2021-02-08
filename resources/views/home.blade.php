@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <br>
                    <table id="cargo-table" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>cargo_code</th>
                                <th>Description</th>
                                <th>Address</th>
                                <th>Contact Person</th>
                                <th>Date of entry</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                    @foreach ($cargos as $cargo)
                    <tr>
                        <td>{{$cargo->name}}</td>
                        <td>{{$cargo->cargo_code}}</td>
                        <td>{{$cargo->cargo_description}}</td>
                        <td>{{$cargo->official_address}}</td>
                        <td>{{$cargo->contact_person}}</td>
                        <td>{{$cargo->created_at}}</td>
                        <td><button class="edit-modal btn btn-info"
                            data-info="{{$cargo->name}},{{$cargo->cargo_code}},{{$cargo->cargo_description}},{{$cargo->official_address}},{{$cargo->contact_person}},{{$cargo->created_at}}">
                                            <span class="glyphicon glyphicon-edit"></span> Edit
                        </button>
                        <button class="delete-modal btn btn-danger"
                            data-info="{{$cargo->name}},{{$cargo->cargo_code}}">
                            <span class="glyphicon glyphicon-trash"></span> Delete
                        </button></td>
                    </tr>
                    @endforeach
                        </tbody>

                    </table>
                    <a href="add_cargo" class="btn btn-info" >Add Cargo</a>
                </div>
            </div>
        </div>
    </div>
    {{-- edit --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Edit</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                            <label>Name</label><span><input type="text"  class="form-control" id="name" placeholder=""/>
                            <label>Cargo Code</label>
                            <input type="text"  class="form-control" id="cargo_code" placeholder=""/>
                            <label>Description</label>
                            <input type="text"  class="form-control" id="cargo_description" placeholder=""/>
                            <label>Address</label>
                            <input type="text"  class="form-control" id="official_address" placeholder=""/>
                            <label>Contact Person</label>
                            <input type="text"  class="form-control" id="contact_person" placeholder=""/>
              </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>
</div>

<script>
    $(document).ready(function() {
      $('#cargo-table').DataTable();
        $(document).on('click','.edit-modal', function(){
            var stuff = $(this).data('info').split(',');
            fillmodalData(stuff);
            $('#exampleModal').modal('show');
        });
        function fillmodalData(details){
            $('#name').val(details[0]);
            $('#cargo_code').val(details[1]);
            $('#cargo_description').val(details[2]);
            $('#official_address').val(details[3]);
            $('#contact_person').val(details[4]);
        }
    });
</script>
@endsection
