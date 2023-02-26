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
<div class="card">
      @include('renter.layouts.error')
    <div class="card-body">
    <table id="table1" class="table table-bordered table-striped">
            <thead>
                <tr>
                <th>#</th>
                <th>Opening Unit</th>
                <th>Closing Unit </th>
                <th>Acquired Unit</th>
                <th>Amount to be Paid</th>
                <th>Paid Amount </th>
                <th>Dues Amount</th>
                <th>Adavance Amount</th>
                <th>Status</th>
                </tr>
            </thead>
            <tbody>
               @foreach ($bill_history as $data)
               <tr>
                 <td>{{$loop->iteration}}</td>
                <td>{{ $data->opening_unit }}</td>
                <td>{{ $data->closing_unit }}</td>
                <td>{{ $data->total_unit }}</td>
                <td>{{ $data->amount_tobe_paid }}</td>
                <td>{{ $data->paid_amount }}</td>
                <td>{{ $data->dues_amount == null ? '___' :  $data->dues_amount }}</td>
                <td>{{ $data->advance_amount == null ? '___' :  $data->advance_amount}}</td>
                 <td>
                    @if( $data->amount_tobe_paid > $data->paid_amount )
                    <a href="{{ route('renter.electricitybill_payment.edit',$data->id) }}" class="btn btn-warning ">Clear Dues</a> 
                    @elseif($data->amount_tobe_paid == $data->paid_amount )
                       <span class=" btn btn-info"> Paid </span>
                  @endif

                 </td>
                </tr>
                 @endforeach
            </tbody>
        </table>
    </div>
</div>
@include('renter.pages.room.create_renter_modal')
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