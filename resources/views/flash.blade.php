<div class="row">
    <div class="col-lg-12">
       @foreach($missing as $device)
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <i class="fa fa-cogs"></i>  El arduino <strong>{{ $device->name }}</strong> no está enviando datos.
        </div>
        @endforeach
    </div>
</div>
<!-- /.row -->