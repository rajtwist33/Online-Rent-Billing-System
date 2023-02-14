@extends('developer.layouts.app')
@section('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <link rel="stylesheet" href="{{asset('layouts/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('layouts/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('layouts/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection
@section('main-body')
@include('developer.layouts.success')
@include('developer.layouts.delete')
<div class="card">
      @include('developer.layouts.error')
    <div class="card-body">
        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModal">
        Add Renter
        </button>
    <table id="table1" class="table table-bordered table-striped">
            <thead>
                <tr>
                <th>#</th>
                <th>Profile</th>
                <th>Name</th>
                <th>Renter Id</th>
                <th>Renter Password</th>
                <th>Created Date</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data )
                    <tr>
                        <td>{{ $loop->iteration}}</td>
                        @if($data->renterimage != '' )
                        <td><img src="{{asset('rentowner/uploads/'.$data->renterimage->image_path)}}" width="100rem" height="100rem" alt="image not found"></td>
                        @else
                        <td><img src="{{asset('rentowner/default/dumy.png')}}" width="100rem" height="100rem" alt="image not found"></td>
                        @endif
                        <td>{{ $data->name }} </td>
                        <td>{{ $data->account }} </td>
                        <td>{{ $data->password_name }} </td>
                        <td class="text-success">{{ $data->created_at->format('Y-M-d') }} </td>
                        <td>
                        <div class="row justify-contnet-evenly">
                        <div class="col-md-3 m-2"><a href="{{route('developer.tenantowner.edit',$data->id)}}" class="btn btn-sm btn-warning">Update</a>
                        </div>    
                        <div class="col-md-3 m-2">
                        <form action="{{route('developer.tenantowner.create')}}" method="get">
                            @csrf
                            <input type="hidden" name="id" value="{{$data->id}}">
                            <button type="submit" class="btn btn-sm btn-danger show_confirm" data-toggle="tooltip" title='Delete'>Delete</button>
                        </form>
                           </div>
                         </div>
                        </td>
                    </tr>    
                @endforeach
            </tbody>
        </table>
    </div>
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