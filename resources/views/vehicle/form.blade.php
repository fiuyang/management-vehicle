<div class="form-group">
    <label>Company Name</label>
    {!! Form::select('company_id', ['' => 'Select'] + \App\Models\Company::pluck('name', 'id')->toArray(), null, ['class' => 'form-control', 'id' => 'name']) !!}
</div>
<div class="form-group">
    <label>Vehicle Name</label>
    {!! Form::text('name',null, ['class' => 'form-control', 'id' => "name"]) !!}
</div>
<div class="form-group">
    <label>Vehicle Type</label>
    {!! Form::select('vehicle_type', ['' => 'Select', 'heavy' => 'Heavy ', 'light' => 'Light ', 'medium' => 'Medium'], null, ['class' => 'form-control', 'id' => 'vehicle_type']) !!}
</div>
<div class="form-group">
    <label>Fuel(liter)</label>
    {!! Form::text('fuel', null, ['class' => 'form-control', 'id' => 'fuel', 'data-precision' => 0]) !!}
</div>
<div class="form-group">
    <label>Service Schedule</label>
    {!! Form::text('service_schedule', null, ['class' => 'form-control', 'id' => 'service_schedule', 'autocomplete' => 'off']) !!}
</div>
<div class="form-group">
    {!! Form::checkbox('rent', 1, isset($model->rent) && $model->rent == 1 ? true : false, ['id' => 'rent', 'onclick' => 'rentals()']) !!}
    {!! Form::label('rent', 'Rental') !!}
</div>
<div id="template"></div>
<script>
    $(function() {
        $('#template').buildForm();
        if ($('#rent').is(':checked') == true) {
            rentals();
        }
    })
    function rentals() {
        if ($('#rent').is(':checked') == true) {
            $('#template').html(`
                <div class="form-group">
                    <label>Cost</label>    
                    <input type="text" class="form-control text-right" id="cost" name="cost" value="{{ isset($model->rent) && $model->rent == 1 ? $model->cost : 0 }}">
                </div>
                <div class="form-group">
                    <label>Start Date</label>    
                    <input type="text" class="form-control" id="start_date" name="start_date"  value="{{ isset($model->rent) && $model->rent == 1 ? date('d-m-Y', strtotime($model->start_date)) : null }}">
                </div>
                <div class="form-group">
                    <label>Sampai Tanggal</label>    
                    <input type="text" class="form-control" id="end_date" name="end_date" value="{{ isset($model->rent) && $model->rent == 1 ? date('d-m-Y', strtotime($model->end_date)) : null }}">
                </div>
            `)
            $('#template').buildForm();
        } else {
            $('#template').html('')
        }
    }
</script>


