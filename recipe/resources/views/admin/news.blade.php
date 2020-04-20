@extends('base')

@section('content')
<div class="app-title">
    <div>
      <h1><i class="fa fa-dashboard"></i> Newslatter</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="#">Newslatter</a></li>
    </ul>
  </div>


  <div class="card">
    <div class="card-header bg-primary">
      All Newsletters
    </div>
    <div class="card-body">
      <a href="#" class="btn btn-primary mt-3 mb-2" id="add-news">Add Newsletter</a><hr>
        <table id="news" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Subject</th>
                    <th>Action</th>
                   
                </tr>
            </thead>
            <tbody>
              @foreach ($news as $item)
              <tr>
              <td>{{ $item->id }}</td>
              <td>{{ $item->title }}</td>
              <td>{{ $item->subject }}</td>
              <td>
                <a href="#" class="btn btn-primary send" data-id="{{ $item->id }}">Send<i class="fa fa-paper-plane"></i></a>
              </td>
            </tr>
              @endforeach
                
            
        </table>
    </div>
  </div>


<!-- Modal -->
<div class="modal fade" id="newsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Newsletter</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="news-form">
          @csrf
          <div class="row">
            <div class="col-md-6 mb-4">
              <label for="title">Title:</label>
              <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label for="title">Subject:</label>
              <input type="text" name="subject" id="subject" class="form-control" required>
            </div>
            <div class="col-md-12 mb-4">
              <label for="title">Description:</label>
              <textarea name="desc" id="desc" cols="40" rows="10" class="form-control" required></textarea>
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
<div class="modal fade" id="emailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Newsletter</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="news-form">
          @csrf
          <div class="row">

            <div class="col-md-6"></div>
            <div class="col-md-4">
              Select All <input type="checkbox" name="all" id="all" class="ml-2"><hr>
            </div>
            <div class="col-md-3"></div>
           <div class="col-md-6">
             @foreach ($emails as $new)
                 <a href="#" class="mr-5">{{ $new->email }}</a><input type="checkbox" name="email" value="{{ $new->email }}" id="email"> <br><br><hr>
             @endforeach
           </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Send</button>
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
          $("#news").DataTable();

          $("#add-news").click(function(){
            $("#newsModal").modal("show")
          })


          $("#news-form").submit(function(e) {
  e.preventDefault();
  setTimeout(() => {
    toastr.info("saving....", "info")
  }, 500);
  var data = $(this).serialize();
  $.ajax({
    url:"{{ route('add_news') }}",
    type:"post",
    data:data,
    success:function (resp) {
      if (resp.status == 1) {
        toastr.success("newsletter added successfully", "success")

        setTimeout(() => {
          location.reload()
        }, 1000);
      }
      
    },
    error:function(err){
      toastr.error("there was an error adding newsletter","error");
    }
  })
  })

  $(".send").click(function(){
    $("#emailModal").modal("show")
  })

  $("#all").click(function(){
    $('input:checkbox').not(this).prop('checked', this.checked);
});
        })
    </script>
@endpush