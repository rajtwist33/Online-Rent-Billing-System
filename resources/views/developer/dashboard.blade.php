@extends('developer.layouts.app')
@section('style')
@section('main-body')
      <div class="row">
      <div class="col-12 col-sm-6 col-md-3">
       <a href="{{ route('developer.tenantowner.index')}}" class="text-dark">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">New Members</span>
              <span class="info-box-number">{{ $renter }}</span>
            </div>
          </div>
        </a>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Likes</span>
              <span class="info-box-number">41,410</span>
            </div>
          </div>
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
          <a href="{{ route('developer.setting.index')}}"  class="text-dark">
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

@endsection