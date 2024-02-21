<div class="form-group">
    <label>Employee Name</label>
    {!! Form::select('employee_id', ['' => 'Select'] + \App\Models\Employee::pluck('name', 'id')->toArray(), null, ['class' => 'form-control', 'id' => 'employee_id']) !!}
</div>
<div class="form-group">
    <label>Vehicle</label>
    {!! Form::select('vehicle_id', ['' => 'Select'] + \App\Models\Vehicle::where('unit_status', 1)->pluck('name', 'id')->toArray(), null, ['class' => 'form-control', 'id' => 'vehicle_id']) !!}
</div>
<div class="form-group">
    <label>Order Destination</label>
    {!! Form::textarea('order_destination', null, ['class' => 'form-control', 'id' => 'order_destination', 'rows' => 5]) !!}
</div>
@if (auth()->user()->role == 'admin')
    <div class="form-group">
        <label>Officer Name</label>
        {!! Form::select('approval_id', ['' => 'Select'] + \App\Models\officer::pluck('name', 'id')->toArray(), null, ['class' => 'form-control', 'id' => 'approval_id']) !!}
    </div>
@endif


