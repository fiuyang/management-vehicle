{!! Form::model($model, ['id' => 'form-approve']) !!}
    <div class="form-group">
        {!! Form::label('officer_name', 'Officer Name') !!}
        @if ($model->approval_id)
            {!! Form::hidden('approval_id', $model->approval_id) !!}
            {!! Form::text('officer_name', $model->officer_name, ['class' => 'form-control', 'id' => 'officer_name', 'readonly']) !!}
        @else
            {!! Form::select('approval_id', ['' => 'Pilih'] + App\Models\Officer::pluck('name', 'id')->toArray(), null, ['class' => 'form-control', 'id' => 'officer_name']) !!}
        @endif
    </div>
    <div class="text-right">
        <button type="button" class="btn btn-secondary" onclick="bootbox.hideAll()">Cancel</button>
        <button type="button" class="btn btn-primary" onclick="approved('{{ $model->id }}')">Submit</button>
    </div>
{!! Form::close() !!}