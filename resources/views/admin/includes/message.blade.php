@if(Session::get('success') == true)
    <div class="alert alert-success" role="alert" id="success-alert">
        <button type="button" class="close" data-dismiss="alert">x</button>
        {{ Session::get('success') }}
    </div>
@endif

@if(Session::get('delete') == true)
    <div class="alert alert-danger" role="alert" id="delete-alert">
        <button type="button" class="close" data-dismiss="alert">x</button>
        {{ Session::get('delete') }}
    </div>
@endif


<script>
$("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
    $("#success-alert").slideUp(500);
});

$("#delete-alert").fadeTo(2000, 500).slideUp(500, function(){
    $("#delete-alert").slideUp(500);
});

</script>

 <script>
  $(document).ready(function() {
    // show the alert
    setTimeout(function() {
        $(".alert").alert('close');
    }, 2000);
});
</script> 