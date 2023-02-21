

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Creating Room Account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('renter.room.store')}}" method="post">
            @csrf
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Room Name:</label>
            <input type="text" class="form-control" name="room_name" id="recipient-name">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Description:</label>
            <textarea name="description" id="editor1" rows="10" cols="80">
            </textarea>
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
