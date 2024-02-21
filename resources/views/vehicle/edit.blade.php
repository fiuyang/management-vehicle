{!! Form::model($model, ['id' => 'form-edit']) !!}
@include('vehicle.form')
<div class="float-right">
    <button type="button" class="btn btn-secondary" onclick="bootbox.hideAll()">Cancel</button>
    <button type="button" class="btn btn-primary" onclick="update('<?= $model->id; ?>')">update</button>
</div>
{!! Form::close() !!}
<script>
    $('#form-edit').buildForm();
</script>