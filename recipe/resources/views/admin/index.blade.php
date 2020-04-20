@extends('base')

@section('content')
<div class="app-title">
    <div>
      <h1><i class="fa fa-dashboard"></i> Recipes</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="#">Recipes</a></li>
      {{-- <li class="breadcrumb-item"><a href="#">Categories</a></li> --}}
    </ul>
  </div>

<div class="card">
    <div class="card-header bg-primary" style="color:white">
      All Recipes
    </div>
    <div class="card-body">
      <a href="#" id="new-recipe" class="btn btn-primary mt-3 mb-2">Add New Recipe</a>
      <table id="recipe" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Recipe Name</th>
                <th>Image</th>
                <th>Category</th>
                <th>Date Created</th>
                <th>Created By</th>
                <th>Action</th>
               
            </tr>
        </thead>
        <tbody>
          @foreach ($recipes as $recipe)
          <tr>
            <th>{{ $recipe->id }}</th>
            <th>{{ $recipe->name }}</th>
            <th><img src="/storage/img/{{ $recipe->image }}" style="height:50px;"  class="img img-responsive" alt=""></th>
            <th>{{ $recipe->category['name'] }}</th>
            <th>{{ $recipe->date_created }}</th>
            <th>{{ $recipe->created_by }}</th>
            <th>
              <a href="#" class="btn btn-primary btn-sm edit" data-id="{{ $recipe->id }}"><i class="fa fa-pencil"></i></a>
              <a href="#" class="btn btn-danger btn-sm delete" data-id="{{ $recipe->id }}" data-token="{{ csrf_token() }}"><i class="fa fa-trash-o"></i></a>
            </th>
          </tr>
          @endforeach
     
        
    </table>
    </div>
  </div>

<!-- Modal -->
<div class="modal fade" id="recipeModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Recipe</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form-recipe" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-6 mb-2">
              <label for="category">Recipe Category</label>
              <select name="category" id="category" class="form-control chosen" required>
                <option value="">--select category--</option>
                @foreach ($categories as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-6 mb-2">
              <label for="name">Recipe Name</label>
              <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="col-md-6 mb-2">
              <label for="name">Recipe Image:</label>
              <input type="file" name="image" id="image" class="form-control" required>
            </div>
            <div class="col-md-6"></div>
            <div class="col-md-6 mb-2">
              <label for="name">Recipe Ingredients:</label>
              <textarea name="ing" id="ing" cols="40" class="form-control" rows="6"></textarea>
              {{-- <script>
                CKEDITOR.replace( 'ing' );
            </script> --}}
            </div>
            <div class="col-md-6 mb-2">
              <label for="name">Recipe Method:</label>
              <textarea name="meth" id="meth" cols="40" class="form-control" rows="6"></textarea>
              {{-- <script>
                     CKEDITOR.replace( 'meth' );
                 </script> --}}
            </div>
            <div class="col-md-12">
              <label for="decs">Description</label>
              <textarea name="desc" class="form-control editor" rows="8" id="desc"></textarea>
              {{-- <script>
                     CKEDITOR.replace( 'desc' );
                 </script> --}}
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
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Recipe</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="edit-recipe" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="id" id="id">
          <div class="row">
            <div class="col-md-6 mb-2">
              <label for="category">Recipe Category</label>
              <select name="editcategory" id="editcategory" class="form-control chosen">
                <option value="">--select category--</option>
                @foreach ($categories as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-6 mb-2">
              <label for="name">Recipe Name</label>
              <input type="text" name="editname" id="editname" class="form-control">
            </div>
            {{-- <div class="col-md-6 mb-2">
              <label for="name">Recipe Image:</label>
              <input type="file" name="image" id="image" class="form-control">
            </div> --}}
            <div class="col-md-6"></div>
            <div class="col-md-6"></div>
            <div class="col-md-6 mb-2">
              <label for="name">Recipe Ingredients:</label>
              <textarea name="editing" id="editing" cols="40" class="form-control" rows="6"></textarea>
              {{-- <script>
                CKEDITOR.replace( 'editing' );
            </script> --}}
            </div>
            <div class="col-md-6 mb-2">
              <label for="name">Recipe Method:</label>
              <textarea name="editmeth" id="editmeth" cols="40" class="form-control " rows="6"></textarea>
              {{-- <script>
                     CKEDITOR.replace( 'editmeth' );
                 </script> --}}
            </div>
            <div class="col-md-12">
              <label for="decs">Description</label>
              <textarea name="editdesc" class=" form-control" rows="8" id="editdesc"></textarea>
              {{-- <script>
                     CKEDITOR.replace( 'editdesc' );
                 </script> --}}
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save Changes</button>
          </div>
        </form>
      </div>
    
    </div>
  </div>
</div>
@endsection
@push('scripts')
  <script>
    $(document).ready(function () {
      $("#recipe").DataTable();

      $("#new-recipe").click(function(){
        $("#recipeModal").modal("show");
      })

      $("#form-recipe").submit(function(e) {
        CKEDITOR.instances['desc'].updateElement();
        CKEDITOR.instances['ing'].updateElement();
        CKEDITOR.instances['meth'].updateElement();
  e.preventDefault();
  setTimeout(() => {
    toastr.info("saving recipe....", "info")
  }, 500);
  // var data = $(this).serialize();
  var data = new FormData(this);
  $.ajax({
    url:"{{ route('add_recipe') }}",
    type:"post",
    data:data,
    cache:false,
    contentType: false,
    processData: false,
    success:function (resp) {
      if (resp.status == 1) {
        toastr.success("recipe added successfully", "success")
        $('.chosen').trigger('chosen:updated');
        setTimeout(() => {
          location.reload()
        }, 1000);
      }
      
    },
    error:function(err){
      toastr.error("there was an error adding recipe","error");
    }
  })
  })


var recipe = '{!!$categories !!}';
var recipe_obj =JSON.parse(recipe);

  $(".edit").click(function(){
    var id = $(this).data("id");
    $("#editModal").modal("show");

    $.ajax({
      url:"{{ 'edit_rec' }}",
      type:"get",
      data:{'id':id},
      success:function(res){
        var res_data = res.cat;
      
        // $('.chosen').trigger('chosen:updated');
      $.each(recipe_obj, function(key, value){
        
        if (res_data.category_id == value.id) {
          $('#editcategory option[value='+value.id+']').prop('selected','selected')

        }
      })
      $('.chosen').trigger('chosen:updated');



      $("#editname").val(res_data.name);
      $("#editing").val(res_data.ingredients);
      $("#editmeth").val(res_data.method);
      $("#editdesc").val(res_data.description);
      $("#id").val(res_data.id);
      },
      error:function(){
        toastr.error("an error occured", "error")
      }
    })
  })

  $("#edit-recipe").submit(function(e){
    e.preventDefault();
    var data = $(this).serialize();
    setTimeout(() => {
            toastr.info("updating recipe...", "info")
          }, 500)
    $.ajax({
      url:"{{ route('update_rec') }}",
      type:"post",
      data:data,
      success:function(res){
        if(res.status == 1){
          toastr.success("recipe updated successfully", "success")
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
      setTimeout(() => {
        toastr.warning("deleting recipe...", "warning")
      }, 500);
      $.ajax({
        url:"delete_rec/"+id,
        data:{'id':id, "_token": token,},
        type:"post",
        success:function(res){
          if (res.status == 1) {
            toastr.success("recipe deleted successfully", "success");
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