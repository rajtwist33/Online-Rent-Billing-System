@extends('Renter.layouts.app')
@section('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <link rel="stylesheet" href="{{asset('layouts/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('layouts/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('layouts/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection
@section('main-body')
      @include('Renter.layouts.error')
      @include('Renter.layouts.success')
      <div class="card card-primary">
        <div class="card-header">
        <h3 class="card-title">Update  Password</h3>
        </div>
        <form action="{{route('renter.change_password.store')}}" method="post" enctype="multipart/form-data">
            @csrf
        <div class="card-body">
            <div class="row">
                
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleInputPassword1">User Id</label>
                        <input type="text" class="form-control" name="account" value="{{$demo->account}}" id="exampleInputPassword1" placeholder="Enter User Id">
                    </div>
                   
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Current Password</label>
                        <input type="text" class="form-control" name="current_password" value="{{old('current_password')}}"  id="exampleInputPassword1" placeholder="Enter Current Password">
                    </div>
                   
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputPassword1">New Password</label>
                        <input type="text" class="form-control" name="new_pass" value="{{old('new_pass')}}" id="exampleInputPassword1" placeholder="Enter New Password">
                    </div>
                   
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Conform Password</label>
                        <input type="text" class="form-control" name="conf_pass" value="{{old('conf_pass')}}" id="exampleInputPassword1" placeholder="Conform New Password">
                    </div>
                   
                </div>
                <div class="form-group">
                        <input type="hidden" class="form-control" name="data_id" value="{{$demo->id}}" id="exampleInputPassword1" placeholder="Enter User Id">
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