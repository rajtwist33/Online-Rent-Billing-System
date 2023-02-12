@extends('developer.layouts.app')
@section('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <link rel="stylesheet" href="{{asset('layouts/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('layouts/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('layouts/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection
@section('main-body')
      @include('developer.layouts.error')
      @include('developer.layouts.success')
      <div class="card card-primary">
        <div class="card-header">
        <h3 class="card-title">Update Renter</h3>
        </div>
        <form action="{{route('developer.updaterenter')}}" method="post"enctype="multipart/form-data">
            @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" name="renter_name" class="form-control" value="{{$datas[0]->name}}" id="exampleInputEmail1" placeholder="Enter Name">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" name="renter_email" value="{{$datas[0]->email}}" id="exampleInputEmail1" placeholder="Enter email">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Phone</label>
                        <input type="text" class="form-control" name="renter_phone" value="{{$datas[0]->renterdetail != null ? $datas[0]->renterdetail->phone : old('renter_phone') }}" id="exampleInputEmail1" placeholder="Enter Phone">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Address</label>
                        <input type="text" class="form-control" name="renter_address" value="{{$datas[0]->renterdetail != null ? $datas[0]->renterdetail->address : old('renter_address') }}" id="exampleInputEmail1" placeholder="Enter Address">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputPassword1">User Id</label>
                        <input type="text" class="form-control" name="renter_useraccount" value="{{$datas[0]->account}}" id="exampleInputPassword1" placeholder="Enter User Id">
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="data_id" value="{{$datas[0]->id}}" id="exampleInputPassword1" placeholder="Enter User Id">
                    </div>
                </div>
                <div class="col-md-6">     
                <label for="formFile" class="form-label">Upload Image</label>
                    <input class="form-control" name="image" type="file" id="formFile">  
                    
                </div>
                </div>
                <div class="col-md-6">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        </form>
     </div>
   
@include('developer.pages.renter.create_renter_modal')
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
<script src="{{asset('layouts/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('layouts/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('layouts/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('layouts/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('layouts/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('layouts/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('layouts/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('layouts/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('layouts/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('layouts/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('layouts/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('layouts/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<script>
  $(function () {
    $("#table1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
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