@if(Session::get('success') == true)
    <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert">x</button>
        {{ Session::get('success') }}
    </div>
@endif

@if(Session::get('delete') == true)
    <div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert">x</button>
        {{ Session::get('delete') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-warning">
        <h4>Warning!</h4>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<div id="ajaxMsg">
</div>