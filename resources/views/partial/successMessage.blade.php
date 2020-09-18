@if(session('success'))
<div class="alert alert-success mt-3" id="alert" roles="alert">
    {{ session('success') }} 
</div> 
@endif  


@if(session('danger'))
<div class="alert alert-danger mt-3" id="alert" roles="alert">
    {{ session('danger') }} 
</div> 
@endif  