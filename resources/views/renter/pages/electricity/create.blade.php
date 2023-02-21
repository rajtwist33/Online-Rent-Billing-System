

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Creating Opening Electricity Unit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('renter.electricitybill.store')}}" method="post">
            @csrf
            <label for="recipient-name" class="col-form-label">Choose Room:</label>
            <select class="custom-select custom-select-sm" name="room_id">
                <option selected>Open this select menu</option>
                @foreach ($rooms as $room)
                      <option value="{{$room->id }}">{!! Str::ucfirst($room->name) !!}</option>
                @endforeach
             </select>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Opening Unit:</label>
            <input type="number" min="0" oninput="validity.valid||(value='');" class="form-control" name="opening_unit">
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
