@extends('layouts.main')
@section('title','Log Activity')
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
                                <th>Date</th>
                                <th>Class</th>
                                <th>Action</th>
                                <th>Url</th>
                                <th>Method</th>
                                <th>Activity</th>
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
                    {data: 'created_at', name: 'log_activities.created_at'},
                    {data: 'class', name: 'log_activities.class'},
                    {data: 'action', name: 'log_activities.action'},
                    {data: 'url', name: 'log_activities.url'},
                    {data: 'method', name: 'log_activities.method'},
                    {data: 'activity', name: 'log_activities.activity'},
                ]
            })
        });
    </script>
@endsection
