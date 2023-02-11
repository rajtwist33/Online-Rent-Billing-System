@extends('developer.layouts.app')
@section('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <link rel="stylesheet" href="{{asset('layouts/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('layouts/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('layouts/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection
@section('main-body')
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
                <th>Name</th>
                <th>User Id</th>
                <th>Created Date</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data )
                    <tr>
                        <td>{{ $loop->iteration}}</td>
                        <td>{{ $data->name }} </td>
                        <td>{{ $data->account }} </td>
                        <td class="text-success">{{ $data->created_at->format('Y-M-d') }} </td>
                        <td>
                        <div class="row justify-contnet-center">
                        <div class="col-md-3 mt-2"><a href="{{route('developer.tenantowner.edit',$data->id)}}" class="btn btn-sm btn-warning">Update</a>
                        </div>    
                        <div class="col-md-3 mt-2">
                        <form action="{{route('developer.tenantowner.create')}}" method="get">
                            @csrf
                            <input type="hidden" name="id" value="{{$data->id}}">
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
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
<script>
  $(function () {
    $("#table1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });

</script>
@endsection