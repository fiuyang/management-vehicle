<table class="table" style="border: none">
    <tr>
        <td style="border-top: 0; border-bottom: 0;">Company Name</td>
        <td style="border-top: 0; border-bottom: 0;">:</td>
        <td style="border-top: 0; border-bottom: 0;">{{ $model->company_name }}</td>
    </tr>
    <tr>
        <td style="border-top: 0; border-bottom: 0;">Vehicle Name</td>
        <td style="border-top: 0; border-bottom: 0;">:</td>
        <td style="border-top: 0; border-bottom: 0;">{{ $model->name }}</td>
    </tr>
    <tr>
        <td style="border-top: 0; border-bottom: 0;">Vehicle Type</td>
        <td style="border-top: 0; border-bottom: 0;">:</td>
        <td style="border-top: 0; border-bottom: 0;">{{ ucwords($model->vehicle_type) }}</td>
    </tr>
    <tr>
        <td style="border-top: 0; border-bottom: 0;">Fuel (liter)</td>
        <td style="border-top: 0; border-bottom: 0;">:</td>
        <td style="border-top: 0; border-bottom: 0;">{{ $model->fuel }}</td>
    </tr>
    <tr>
        <td style="border-top: 0; border-bottom: 0;">Service Schedule</td>
        <td style="border-top: 0; border-bottom: 0;">:</td>
        <td style="border-top: 0; border-bottom: 0;">{{ date('d-m-Y', strtotime($model->service_schedule)) }}</td>
    </tr>
    @if ($model->rent == 1)
        <tr>
            <td style="border-top: 0; border-bottom: 0;">Cost</td>
            <td style="border-top: 0; border-bottom: 0;">:</td>
            <td style="border-top: 0; border-bottom: 0;">{{ number_format($model->cost) }}</td>
        </tr>
        <tr>
            <td style="border-top: 0; border-bottom: 0;">Start Date</td>
            <td style="border-top: 0; border-bottom: 0;">:</td>
            <td style="border-top: 0; border-bottom: 0;">{{ date('d-m-Y', strtotime($model->start_date)) }}</td>
        </tr>
        <tr>
            <td style="border-top: 0; border-bottom: 0;">End Date</td>
            <td style="border-top: 0; border-bottom: 0;">:</td>
            <td style="border-top: 0; border-bottom: 0;">{{ date('d-m-Y', strtotime($model->end_date)) }}</td>
        </tr>
    @endif
</table>