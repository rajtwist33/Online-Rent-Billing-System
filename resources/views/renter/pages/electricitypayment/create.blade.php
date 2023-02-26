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
        <label for="" class="card-title">Electricity Payment </label>
            <span class="card-title float-right">Room ID : {!! Str::ucfirst($tenants->tenanthasroom->name) !!}</span>
        </div>
        </div>
        <form action="{{route('renter.electricitybill_payment.store')}}" method="post" enctype="multipart/form-data">
            @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 mb-5">
                    <div class="form-group">
                    @if($tenants->tenantimage != '')
                        <img src="{{asset('tenant/uploads/'.$tenants->tenantimage->image_path)}}" width="100rem" height="100rem" alt="image not found">   
                   @endif
                    </div>
                                      
                    <div class="form-group">
                    <label for="exampleInputEmail1"> Name : </label>
                        {{ $tenants->name }}
                    </div>
                    <label for="exampleInputEmail1"> Opening Electricity Bill : </label>
                  
                        {{ $elctricity_opening_unit != null ? $elctricity_opening_unit->opening_unit : ''}} Units <br><br>
                  
                    <label for="exampleInputEmail1"> Joined Date : </label>
                        {{ $tenants->created_at->format('Y-M-d') }} 

                </div>
                <div class="col-md-8">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Opening Electricity Bill (Units)</label>
                                <input type="number" min="1" readonly oninput="validity.valid||(value='');" id="opening_electricity_bill" name="opening_electricity_bill" value="{!! $elctricity_opening_unit !=null ? $elctricity_opening_unit->opening_unit : '' !!}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Current Electricity Bill (Units)</label>
                                <input type="number" min="1" oninput="validity.valid||(value='');" id="closing_electricity_bill" name="closing_electricity_bill" value="" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="mb-3">
                                <label for=""  class="form-label mt-2"></label>
                               <span class="btn btn-primary mt-5" onclick="generate_bill()">Generate Bill</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Total Electricity Bill Unit Generated</label>
                                <input type="number" min="1" oninput="validity.valid||(value='');" name="generated_bill" id="generated_bill" class="form-control"  aria-describedby="emailHelp">
                                <input type="hidden" readonly min="1" oninput="validity.valid||(value='');"  id="set_unit_price" value="{!! $elctricity_opening_unit !=null ? $elctricity_opening_unit->set_unit_price : '' !!}" class="form-control"  aria-describedby="emailHelp">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 bg-warning" id="result"></div>
                    <div class="col-md-12">
                        <div class="form-group">
                            
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Paying Amount</label>
                                <input type="hidden" min="1" oninput="validity.valid||(value='');" name="amount_tobe_paid" id="amount_tobe_paid" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                <input type="number" min="1" oninput="validity.valid||(value='');" name="bill_pay_amount" id="bill_pay_amount" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Amount In Dues (If Any)</label>
                                <input type="number" min="1" oninput="validity.valid||(value='');" name="dues" value="{{old('dues')}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Amount In Advance (If Any)</label>
                                <input type="number" min="0" oninput="validity.valid||(value='');" name="advance"  value="{{old('advance')}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                        <?php $today = date('Y-m-d H:i:s');?>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Paying Date</label>
                                <input type="datetime-local" name="paid_date" value="{{$today}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                <input type="hidden" readonly name="tenant_id" value="{{$tenants->id}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                <input type="hidden" readonly name="room_id" value="{{$tenants->room_id}}" readonly class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
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

<script type="text/javascript">
function generate_bill()
{
var a,b,c,Sub,Total_price;
a = parseInt(document.getElementById ("closing_electricity_bill").value);
b = parseInt(document.getElementById ("opening_electricity_bill").value);
c = parseInt(document.getElementById ("set_unit_price").value);
Sub = a-b; 
Total_price = c*Sub;

document.getElementById ("generated_bill").setAttribute('value', Sub);
document.getElementById ("bill_pay_amount").setAttribute('value', Total_price);
document.getElementById ("amount_tobe_paid").setAttribute('value', Total_price);
document.getElementById ("result").innerHTML ="<strong >Total Amount : </strong>Rs."+Total_price;
}
</script>
@endsection