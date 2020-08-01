@if (Session::has('info'))
<div class="alert alert-info" role="alert">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    {!! Session::get('info') !!}
</div>
@endif

@if (Session::has('success'))
<div class="alert alert-success" role="alert">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    {!! Session::get('success') !!}
</div>
@endif

@if (Session::has('warning'))
<div class="alert alert-warning" role="alert">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    {!! Session::get('warning') !!}
</div>
@endif

@if (Session::has('error'))
<div class="alert alert-danger" role="alert">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    {!! Session::get('error') !!}
</div>
@endif