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
      <div class="card card-primary">
        <div class="card-header">
        <label for="" class="card-title"> Payment </label>
           
        </div>
        </div>
        <form action="{{route('renter.payment.store')}}" method="post" enctype="multipart/form-data">
            @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                  
                                      
                    <div class="form-group">
                    <label for="exampleInputEmail1"> Name : </label>
                        {{ $payments->tenant->name }}
                    </div>
                    <label for="exampleInputEmail1"> Fees : </label>
                        {{ $payments->tenant->fee }} <br>
                    <label for="exampleInputEmail1"> Joined Date : </label>
                        {{ $payments->tenant->created_at->format('Y-M-d') }} 

                </div>
                <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Paid Amount</label>
                                <input type="number" min="0" oninput="validity.valid||(value='');"  readonly name="paid_amount" value="{{ $payments->paid_amount != '' ? $payments->paid_amount : old('paid_amount')}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                        </div>
                    </div>
                 
                    @if($payments->dues != '')
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">PAY Dues Amount</label>
                                <input type="number" min="0" oninput="validity.valid||(value='');"  name="dues" class="form-control"  value="{{ $payments->dues != '' ? $payments->dues : old('paid_amount') }}"  id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                        </div>
                    </div>
                    @endif
                    <?php $today = date('Y-m-d H:i:s');?>
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Paying Date</label>
                                <input type="datetime-local" value="{{$today}}" name="paid_date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                <input type="hidden" readonly name="tenant_id" value="{{$payments->tenant->id}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                <input type="hidden" readonly name="data_id" value="{{$payments->id}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                <input type="hidden" readonly name="tenant_fee" value="{{$payments->tenant->fee}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                        </div>
                    </div>
                   
                </div>
                </div> 
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary float-right">Save</button>
        </div>
        </form>
     </div>
   
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