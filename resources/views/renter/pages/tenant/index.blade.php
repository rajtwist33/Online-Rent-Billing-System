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
                <th>Image</th>
                <th>Tenant Name</th>
                <th>Tenant Phone</th>
                <th>Tenant Fees</th>
                <th>Total Resident </th>
                <th>Joined Date</th>
                <th>Rent Payment</th>
                <th>Electricity Payment</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
               @foreach ($tenants as $tenant)
               <tr>
                 <td>{{$loop->iteration}}</td>
                 @if($tenant->tenantimage != '' )
                <td><img src="{{asset('tenant/uploads/'.$tenant->tenantimage->image_path)}}" width="100rem" height="100rem" alt="image not found"></td>
                @else
                <td><img src="{{asset('tenant/default/dumy.png')}}" width="100rem" height="100rem" alt="image not found"></td>
                @endif
                 <td>{{$tenant->name}}</td>
                 <td>{{$tenant->phone}}</td>
                 <td>{{$tenant->fee}}</td>
                 <td>{{$tenant->total_resident}}</td>
                 <td class="text-success">{{ $tenant->created_at->format('Y-M-d') }} </td>
                 <td> 
                    <form action="{{route('renter.payment.create')}}" method="get">
                      @csrf
                      <input type="hidden" readonly  name="tenant_id" value="{{$tenant->id}}">
                    <button type="submit" class="btn btn-outline-warning" data-toggle="tooltip" title='Click For Payment'><i class="	fas fa-money-check text-danger"></i></button>
                    </form>
                 </td>
                 <td> 
                    <form action="{{route('renter.electricitybill_payment.create')}}" method="get">
                      @csrf
                      <input type="hidden" readonly  name="tenant_id" value="{{$tenant->id}}">
                    <button type="submit" class="btn btn-outline-warning" data-toggle="tooltip" title='Click For Eelectricity Payment'><i class="	fas fa-money-check text-danger"></i></button>
                    </form>
                 </td>
                 <td col-2>
                  <div class="row ">
                  <div class="col-md-3 ">
                      <a href="{{route('renter.tenant.show',$tenant->slug)}}" class=" nav-link" data-toggle="tooltip" title='View Detail'><i class="fa fa-eye text-success"></i></a>
                  </div>
                  <div class="col-md-3">
                      <a href="{{route('renter.tenant.edit',$tenant->slug)}}" class=" nav-link" data-toggle="tooltip" title='Edit Tenant'><i class="fa fa-edit text-primary"></i></a>
                  </div>
                  <div class="col-md-2 ">
                      <form action="{{route('renter.tenant.destroy',$tenant->slug)}}" method="post">
                         @method('delete')
                          @csrf
                          <input type="hidden" name="data_id" value="{{$tenant->slug}}">
                          <button type="submit" class=" btn show_confirm" data-toggle="tooltip" title='Delete'><i class="fa fa-trash text-danger"></i></button>
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