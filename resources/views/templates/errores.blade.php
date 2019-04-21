<div class="row">
    @foreach($errors->all() as $error)
    <div class="col-md-12 col-sm-12">
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {!! $error !!}
        </div>
    </div>
    @endforeach
</div>
