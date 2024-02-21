@extends('layouts.main')
@section('title','monitoring')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table" class="table table-striped table-bordered" width="100%">
                        <thead>
                            <tr>
                                <th>Vehicle</th>
                                <th>Employee</th>
                                <th>Order Destination</th>
                                <th>Status</th>
                                <th>Fuel</th>
                                <th>Service Schedule</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        var dataTable;
        $(function() {
            dataTable = $('#table').dataTable({
                processing: true,
                serverSide: true,
                scrollX: true,
                ajax: '',
                columns: [
                    {data: 'vehicle_name', name: 'vehicles.name'},
                    {data: 'employee_name', name: 'employees.name'},
                    {data: 'order_destination', name: 'vehicle_orders.order_destination'},
                    {data: 'status', name: 'vehicles.status'},
                    {data: 'fuel', name: 'fuel'},
                    {data: 'service_schedule', name: 'vehicles.service_schedule'},
                ]
            })
        });
        console.log(dataTable); 
    </script>
@endsection
