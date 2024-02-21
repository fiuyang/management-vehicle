<table class="table" style="border: none">
    <tr>
        <td style="border-top: 0; border-bottom: 0;">Employee Name</td>
        <td style="border-top: 0; border-bottom: 0;">:</td>
        <td style="border-top: 0; border-bottom: 0;">{{ $model->employee_name }}</td>
    </tr>
    <tr>
        <td style="border-top: 0; border-bottom: 0;">Vehicle</td>
        <td style="border-top: 0; border-bottom: 0;">:</td>
        <td style="border-top: 0; border-bottom: 0;">{{ $model->vehicle_name }}</td>
    </tr>
    <tr>
        <td style="border-top: 0; border-bottom: 0;">Order Destination</td>
        <td style="border-top: 0; border-bottom: 0;">:</td>
        <td style="border-top: 0; border-bottom: 0;">{{ $model->order_destination }}</td>
    </tr>
    <tr>
        <td style="border-top: 0; border-bottom: 0;">Status</td>
        <td style="border-top: 0; border-bottom: 0;">:</td>
        <td style="border-top: 0; border-bottom: 0;">
            @if ($model->status == 'Approve') 
                <button type="button" class="badge badge-success">Approve</button>
            @elseif ($model->status == 'Waiting')
                <button type="button" class="badge badge-warning">Waiting</button>
            @else
                <button type="button" class="badge badge-danger">Reject</button>
            @endif
        </td>
    </tr>
    <tr>
        <td style="border-top: 0; border-bottom: 0;">Approve By</td>
        <td style="border-top: 0; border-bottom: 0;">:</td>
        <td style="border-top: 0; border-bottom: 0;">{{ $model->officer_name }}</td>
    </tr>
</table>