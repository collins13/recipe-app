@extends('index')

@section('content')
  <div class="row">

      <!-- Small Receipe Area -->
      @if(count($cat) > 0)
        @foreach($cat as $all)
      <div class="col-12 col-sm-6 col-lg-4">
          <div class="single-small-receipe-area d-flex">
              {{-- <div class="receipe-thumb"> --}}
                <a href="{{ route('single_recipe', $all->id) }}">  <img src="/storage/img/{{ $all->image }}" alt="" style="width:180px; height:140px;" ></a>
              {{-- </div> --}}
              <!-- Receipe Content -->
              <div class="receipe-content ml-2">
                  <span>{{ Carbon\Carbon::parse($all->date_created)->isoFormat('dddd, MMMM Do YYYY') }}</span>
                  <a href="{{ route('single_recipe', $all->id) }}">
                      <h5>{{ $all->name }}</h5>
                  </a>
                  <div class="ratings">
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star-o" aria-hidden="true"></i>
                  </div>
                  <p></p> <a href="#" class="btn btn-outline-success col-md-4 btn-sm" style="margin-left:8em;">view</a>
              </div>
          </div><hr>
      </div>
    @endforeach
  @else
    <div class="alert alert-danger alert-dismissible fade show col-md-12" role="alert">
      <strong>we are Sorry!</strong> No recipes available at the moment.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  @endif


  </div>
  <hr />
@endsection
