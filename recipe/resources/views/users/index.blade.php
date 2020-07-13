@extends('base')

@section('content')
<div class="app-title">
    <div>
      <h1><i class="fa fa-users"></i> Users</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="#">Users</a></li>
      {{-- <li class="breadcrumb-item"><a href="#">Categories</a></li> --}}
    </ul>
  </div>

<div class="card">
    <div class="card-header bg-primary" style="color:white">
      All Users
    </div>
    <div class="card-body">
      <a href="#" id="new-user" class="btn btn-primary mt-3 mb-2">Add New User</a>
      <table id="users" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
                
            </tr>
        </thead>
        <tbody>
          @foreach ($users as $user)
          <tr>
           <td>{{ $user->id }}</td>
           <td>{{ $user->name }}</td>
           <td>{{ $user->email }}</td>
           <td>
           @if(!empty($user->getRoleNames()))
           @foreach($user->getRoleNames() as $v)
           <label class="badge badge-success"> {{ $v }}</label>
          
           @endforeach
           @endif
           </td>
           <td></td>
          </tr>
          @endforeach
     
        
    </table>
    </div>
  </div>

  
  <!-- Modal -->
  <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
          <div class="row">
              <div class="col-md-6 form-group">
                  <label for="name">Name</label>
                  <input type="text" name="name" required class="form-control" id="name">
              </div>
              <div class="col-md-6 form-group">
                <label for="email">Email</label>
                <input type="email" required name="email" class="form-control" id="email">
            </div>
          </div>

          <div class="col-md-6 form-group">
            <label for="role">Role</label>
            <select name="role[]" id="role" required class="form-control chosen" multiple>
                <option value="">--select role--</option>
                @foreach($roles as $role )
                <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
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
          $("#users").DataTable();


          $("#new-user").click(function(){
              $("#userModal").modal("show")
          })
      })

  </script>
@endpush