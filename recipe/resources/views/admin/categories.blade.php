@extends('base')

@section('content')
<div class="app-title">
    <div>
      <h1><i class="fa fa-dashboard"></i> Categories</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="#">Menu</a></li>
      <li class="breadcrumb-item"><a href="#">Categories</a></li>
    </ul>
  </div>

  {{-- card --}}
  <div class="card">
    <div class="card-header bg-primary" style="color:white">
      All Categories
    </div>
    <div class="card-body">
        <a href="#" id="category" class="btn btn-primary mt-3 mb-2">Add New Category</a><hr>
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Category Name</th>
                    <th>Action</th>
                   
                </tr>
            </thead>
            <tbody>
              @foreach ($categories as $item)
                <tr>
                  <td>{{ $item->id }}</td>
                  <td>{{ $item->name }}</td>
                  <td><a href="#" class="btn btn-primary btn-sm edit" data-id="{{ $item->id }}"><i class="fa fa-pencil mr-4 "></i></a>
                      <a href="#" class="btn btn-danger btn-sm delete" data-id="{{ $item->id }}" data-token="{{ csrf_token() }}" ><i class="fa fa-trash-o"></i></a>
                  </td>
                   
                </tr>
                @endforeach
            
        </table>
    </div>
  </div>
 

  {{-- modals --}}
  <!-- Button trigger modal -->
  
  <!-- Modal -->
  <div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="form-category">
              @csrf
              <div class="row">
                  <div class="col-md-8 form-group" id="dynamic">
                      <label for="name">Category Name</label>
                      {{-- <input type="text" name="category" class="form-control" required id="category"> --}}
                      <div class="input-group mb-3" >
                        <input type="text" name="addmore[0][category]" class="form-control" required id="category">
                        <div class="input-group-append">
                          <span class="input-group-text btn btn-primary bg-primary" id="add"><i class="fa fa-plus"></i></span>
                        </div>
                      </div>
                  </div>
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
    
  <!-- Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="edit-category">
              @csrf
              <div class="row">
                <div class="col-md-4">
                  <label for="id">Category Id:</label>
                  <input type="text" name="id" id="id" readonly class="form-control">
                </div>
                  <div class="col-md-8 form-group" id="dynamic">
                      <label for="name">Category Name:</label>
                      {{-- <input type="text" name="category" class="form-control" required id="category"> --}}
                      <div class="input-group mb-3" >
                        <input type="text" name="editCategory" class="form-control" required id="editCategory">
                        {{-- <div class="input-group-append">
                          <span class="input-group-text btn btn-primary bg-primary" id="add"><i class="fa fa-plus"></i></span>
                        </div> --}}
                      </div>
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
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
    $('#example').DataTable();

    $("#category").click(function(){
        $("#categoryModal").modal("show")
    })

    var i = 0;

       

$("#add").click(function(){
    ++i;
    $("#dynamic").append(
                      
                      '<div class="input-group mb-3 " id="p" >'+
                        '<input type="text" name="addmore['+i+'][category]" data-id="'+i+'" class="form-control" required id="category">'+
                        '<div class="input-group-append">'+
                        '  <span class="input-group-text btn btn-danger bg-danger remove" id="remove"><i class="fa fa-minus"></i></span>'+
                        '</div>'+
                     '</div>');

});



$(document).on('click', '.remove', function(){  

     $(this).parents('#p').remove();

});  

$("#form-category").submit(function(e) {
  e.preventDefault();
  setTimeout(() => {
    toastr.info("saving....", "info")
  }, 500);
  var data = $(this).serialize();
  $.ajax({
    url:"{{ route('add_category') }}",
    type:"post",
    data:data,
    success:function (resp) {
      if (resp.status == 1) {
        toastr.success("Category added successfully", "success")

        setTimeout(() => {
          location.reload()
        }, 1000);
      }
      
    },
    error:function(err){
      toastr.error("there was an error adding category","error");
    }
  })
  })

  $(".edit").click(function(){
    var id = $(this).data("id");
    $("#editModal").modal("show");

    $.ajax({
      url:"{{ 'edit_cat' }}",
      type:"get",
      data:{'id':id},
      success:function(res){
        var res_data = res.cat;
        console.log(res);
        
        $("#id").val(res_data.id);
        $("#editCategory").val(res_data.name);
      },
      error:function(){
        toastr.error("an error occured", "error")
      }
    })
  })

  $("#edit-category").submit(function(e){
    e.preventDefault();
    var data = $(this).serialize();
    setTimeout(() => {
            toastr.info("updating...", "info")
          }, 500)
    $.ajax({
      url:"{{ route('update_cat') }}",
      type:"post",
      data:data,
      success:function(res){
        if(res.status == 1){
          toastr.success("category updated successfully", "success")
          setTimeout(() => {
            location.reload()
          }, 1000);
        }
        
      },
      error:function(err){
          toastr.error("an error occured", "error");
        }
    })
  })
  $(".delete").click(function(){
    var id = $(this).data("id");
    var token = $(this).data("token");
    if(confirm("are you sure you want to delete?!!")){
      $.ajax({
        url:"delete_cat/"+id,
        data:{'id':id, "_token": token,},
        type:"post",
        success:function(res){
          if (res.status == 1) {
            toastr.success("category deleted successfully", "success");
            setTimeout(() => {
              location.reload()
            }, 1000);
          }
        },
        error:function(err){
          toastr.error("error occured", "error");
        }
      })
    }else{
      return false;
    }
  })
})     
</script>   
@endpush