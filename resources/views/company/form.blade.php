<div class="form-group">
    <label>Company Name</label>
    {!! Form::text('name',null, ['class' => 'form-control', 'id' => "name"]) !!}
</div>
<div class="form-group">
    <label>Address</label>
    {!! Form::text('address',null, ['class' => 'form-control', 'id' => "address"]) !!}
</div>
<div class="form-group">
    <label>Status</label>
    {!! Form::select('status', ['' => 'select', 'headquarters' => 'Headquarters', 'branch' => 'Branch', 'contributor' => 'Contributor'], null, ['class' => 'form-control', 'id' => "status"]) !!}
</div>


