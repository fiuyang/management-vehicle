{!! Form::open(['id' => 'form-create']) !!}
@include('vehicle.form')
<div class="float-right">
    <button type="button" class="btn btn-secondary" onclick="bootbox.hideAll()">Cancel</button>
    <button type="button" class="btn btn-primary" onclick="store()">Store</button>
</div>
{!! Form::close() !!}
<script>
    $('#form-create').buildForm();
</script>


