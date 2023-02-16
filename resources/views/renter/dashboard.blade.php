@extends('renter.layouts.app')
@section('style')
@section('main-body')
      @include('renter.layouts.error')
      @include('renter.layouts.success')
      <div class="row">
      <div class="col-12 col-sm-6 col-md-3">
       <a href="{{route('renter.tenant.index')}}" class="text-dark">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">New Members</span>
              <span class="info-box-number">{{ $tenant }}</span>
            </div>
          </div>
        </a>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
        <a href="{{route('renter.room.index')}}" class="text-dark">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-danger elevation-1"> <i class="nav-icon fas fa-bed"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Rooms</span>
              <span class="info-box-number">{{ $room }}</span>
            </div>
          </div>
        </a>
        </div>
        <div class="clearfix hidden-md-up"></div>
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Sales</span>
              <span class="info-box-number">760</span>
            </div>
          </div>
        </div>
       
        <div class="col-12 col-sm-6 col-md-3">
          <a href="#"  class="text-dark">
          <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>
            <div class="info-box-content">
              <span class="info-box-text ">Setting</span>
              <span class="info-box-number">
           
              </span>
            </div>
          </div>
          </a>
        </div>
      </div>
@endsection
@section('script')
<script>
  setTimeout(function() {
    $('#errorhide').hide(); 
},8000);
  setTimeout(function() {
    $('#success').hide(); 
},4000);
  setTimeout(function() {
    $('#delete').hide(); 
},4000);
</script>
@endsection