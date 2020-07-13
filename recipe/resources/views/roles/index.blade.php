@extends('base')

@section('content')
<div class="app-title">
    <div>
      <h1><i class="fa fa-lock"></i> Roles</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="#">Roles</a></li>
      {{-- <li class="breadcrumb-item"><a href="#">Categories</a></li> --}}
    </ul>
  </div>

<div class="card">
    <div class="card-header bg-primary" style="color:white">
      All Roles
    </div>
    <div class="card-body">
      <a href="#" id="new-role" class="btn btn-primary mt-3 mb-2">Add New Role</a>
      <table id="roles" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>guard name</th>
                <th>Action</th>
                
            </tr>
        </thead>
        <tbody>
          @foreach ($roles as $role)
          <tr>
           <td>{{ $role->id }}</td>
           <td>{{ $role->name }}</td>
           <td>{{ $role->guard_name }}</td>
           <td></td>
          </tr>
          @endforeach
     
        
    </table>
    </div>
  </div>

  
  <!-- Modal -->
  <div class="modal fade" id="roleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New Role</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('roles.store') }}" method="POST">
                @csrf
          <div class="row">
              <div class="col-md-6 form-group">
                  <label for="name">Name</label>
                  <input type="text" name="name" required class="form-control" id="name">
              </div>
              {{-- <div class="col-md-6 form-group">
                <label for="email">Guard Name</label>
                <input type="text" required name="g_name" class="form-control" id="email">
            </div> --}}
          </div>
          <div>
            <input type="checkbox" name="all" id="all">
            <label for="">Select All</label><hr>
          </div>
          @foreach($permissions as $permission)
          <div class="col-md-6 form-group">
              <input type="checkbox" class="form-check-input form-control" name="permission[]" value="{{ $permission->id }}" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">{{ $permission->name }}</label>
            </select>
        </div>
        @endforeach

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
        </div>
   
      </div>
    </div>
  </div>
@endsection
@push('scripts')
  <script>
      $(document).ready(function(){
          $("#roles").DataTable();


          $("#new-role").click(function(){
              $("#roleModal").modal("show")
          })

          $("#all").click(function(){
            $('input:checkbox').not(this).prop('checked', this.checked);
          })
      })

  </script>
@endpush