@extends('renter.layouts.app')
@section('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <link rel="stylesheet" href="{{asset('layouts/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('layouts/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('layouts/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection
@section('main-body')
@include('renter.layouts.success')
@include('renter.layouts.delete')
<div class="card card-primary">
@include('renter.layouts.error')
        <div class="card-header">
        <h3 class="card-title">Room ID : {{$room->name}}</h3>
        </div>
        <form action="#" method="post" enctype="multipart/form-data">
            @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tenant Name</label>
                        <input type="text" name="name" class="form-control" value="" id="exampleInputEmail1" placeholder="Enter Name">
                    </div>
                </div>   
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tenant Occupation</label>
                        <input type="text" name="occupation" class="form-control" value="" id="exampleInputEmail1" placeholder="Enter Name">
                    </div>
                </div>   
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tenant Phone</label>
                        <input type="text" name="phone" class="form-control" value="" id="exampleInputEmail1" placeholder="Enter Name">
                    </div>
                </div>   
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tenant Address</label>
                        <input type="text" name="address" class="form-control" value="" id="exampleInputEmail1" placeholder="Enter Name">
                    </div>
                </div>   
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tenant Parent Name</label>
                        <input type="text" name="parent_name" class="form-control" value="" id="exampleInputEmail1" placeholder="Enter Name">
                    </div>
                </div>   
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tenant Parent Nnumber</label>
                        <input type="text" name="parent_number" class="form-control" value="" id="exampleInputEmail1" placeholder="Enter Name">
                    </div>
                </div>   
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Total Resident</label>
                        <input type="text" name="resident" class="form-control" value="" id="exampleInputEmail1" placeholder="Enter Name">
                    </div>
                </div>   
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tenant Fee</label>
                        <input type="text" name="fee" class="form-control" value="" id="exampleInputEmail1" placeholder="Enter Name">
                    </div>
                </div>   
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tenant Image</label>
                        <input type="text" name="image" class="form-control" value="" id="exampleInputEmail1" placeholder="Enter Name">
                    </div>
                </div>   
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tenant Description</label>
                        <input type="text" name="description" class="form-control" value="" id="exampleInputEmail1" placeholder="Enter Name">
                    </div>
                </div>   
                <div class="form-group">
                    <input type="hidden" class="form-control" name="data_id" value="{{$room->id}}" id="exampleInputPassword1" placeholder="">
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script type="text/javascript">
 
     $('.show_confirm').click(function(event) {
          var form =  $(this).closest("form");
          var name = $(this).data("name");
          event.preventDefault();
          swal({
              title: `Are you sure you want to delete this record?`,
              text: "If you delete this, it will be gone forever.",
              icon: "warning",
              buttons: true,
              dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              form.submit();
            }
          });
      });
  
</script>
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