

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Creating Renter Account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('developer.tenantowner.store')}}" method="post">
            @csrf
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Renter Name:</label>
            <input type="text" class="form-control" name="renter_name" id="recipient-name">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Renter User Id:</label>
            <input type="text" class="form-control" name="renter_useraccount" id="recipient-name">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Renter Password:</label>
            <input type="text" class="form-control" name="renter_password" id="recipient-name">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Renter Conform Password:</label>
            <input type="text" class="form-control" name="renter_confpassword" id="recipient-name">
          </div>
      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-secondary" >Reset</button>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>
