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
        <a href="{{route('renter.payment.index')}}" class="text-dark">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-arrow-up"></i></span>
          @php
            $total_sum = ($total_collected + $total_advance);
          @endphp
            <div class="info-box-content">
              <span class="info-box-text">Total Collected</span>
              <span class="info-box-number">Rs. {{$total_sum}}</span>
            </div>
          </div>
        </a>
        </div>
       
        <div class="col-12 col-sm-6 col-md-3">
          <a href="{{route('renter.payment.index')}}"  class="text-dark">
          <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-arrow-down"></i></span>
            <div class="info-box-content">
              <span class="info-box-text ">Dues</span>
              <span class="info-box-number">
                    Rs. {{ $total_dues }}
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