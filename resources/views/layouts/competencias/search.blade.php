<div class="input-group" id="search">
    <input type="text" name="q" class="form-control input-sm pull-right" value="{{e((isset($search)? $search: ''))}}" placeholder="{{trans('generals.search')}}">
    <div class="input-group-btn">
        <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
    </div>
</div>