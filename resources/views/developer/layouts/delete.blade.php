@if(Session::has('delete'))
<div class="row justify-content-center">
    <div id="delete" class="col-md-4">
        <p  class="alert alert-danger">{{ Session('delete') }}</p>
    </div>    
</div>  
@endif