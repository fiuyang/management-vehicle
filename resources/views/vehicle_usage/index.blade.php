@extends('layouts.main')
@section('title','Vehicle Usage')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                @if (auth()->user()->role != 'officer')
                    <div class="text-right">
                        <div class="form-group">
                            @if (auth()->user()->role <> 'pegawai')
                                <a href="{{ route('vehicle_usage.export') }}" role="button" class="btn btn-success">Export</a>
                            @endif
                            <button type="button" id="btn-create" class="btn btn-primary" onclick="create()">Create</button>
                        </div>
                    </div>
                @else
                <div class="text-right form-group">
                    <a href="{{ route('vehicle_usage.export') }}" role="button" class="btn btn-success">Export</a>
                </div>
                @endif
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table" class="table table-striped table-bordered" width="100%">
                        <thead>
                            <tr>
                                <th>Employee</th>
                                <th>Vehicle</th>
                                <th>Order Destination</th>
                                <th>Status</th>
                                <th>Approve By</th>
                                <th></th>
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
        let dataTable;
        $(function() {
            dataTable = $('#table').DataTable({
                rocessing: true,
                serverSide: true,
                scrollX: true,
                ajax: "{{ route('vehicle_usage') }}",
                columns: [
                    {data: 'employee_name', name: 'employees.name'},
                    {data: 'vehicle_name', name: 'vehicles.name'},
                    {data: 'order_destination', name: 'vehicle_orders.order_destination'},
                    {data: 'status', name: 'vehicle_orders.status', class: 'text-center'},
                    {data: 'officer_name', name: 'officers.name'},
                    {data: '_', searchable: false, orderable: false, class: 'text-center'},
                ]
            })
        })

        function create() {
            $.ajax({
                url: "{{ route('vehicle_usage.create') }}",
                success: function(response) {
                    bootbox.dialog({
                        title: 'Create Vehicle Usage',
                        message: response
                    })
                }
            })
        }

        function edit(id) {
            $.ajax({
                url: "{{ route('vehicle_usage.edit') }}/"+id,
                success: function(response) {
                    bootbox.dialog({
                        title: 'Edit Vehicle Usage',
                        message: response
                    })
                }
            })
        }

        function view(id) {
            $.ajax({
                url: "{{  route('vehicle_usage.view') }}/"+id,
                success: function(response) {
                    bootbox.dialog({
                        size: 'large',
                        title: 'View Vehicle Usage',
                        message: response
                    })
                }
            })
        }

        function store() {
            $('#form-create .alert').remove()
            $.ajax({
                url: "{{ route('vehicle_usage.insert') }}",
                dataType: 'json',
                type: 'post',
                data: $('#form-create').serialize(),
                success: function(response) {
                    if(response.success) {
                        iziToast.success({
                            title : 'success',
                            message : response.message,
                            position: 'topRight'
                        });
                    } else {
                        iziToast.error({
                            title : 'false',
                            message : response.message,
                            position: 'topRight'
                        });
                    }
                    bootbox.hideAll()
                    dataTable.ajax.reload()
                },
                error: function(xhr) {
                    let response = JSON.parse(xhr.responseText);
                    $('#form-create').prepend(validation(response));
                }
            })
        }

        function update(id) {
            $('#form-edit .alert').remove()
            $.ajax({
                url: "{{  route('vehicle_usage.update')  }}/"+id,
                dataType: 'json',
                type: 'post',
                data: $('#form-edit').serialize(),
                success: function(response) {
                    if(response.success) {
                        iziToast.success({
                            title : 'success',
                            message : response.message,
                            position: 'topRight'
                        });
                    } else {
                        iziToast.error({
                            title : 'false',
                            message : response.message,
                            position: 'topRight'
                        });
                    }
                    bootbox.hideAll()
                    dataTable.ajax.reload()
                },
                error: function(xhr) {
                    let response = JSON.parse(xhr.responseText);
                    $('#form-edit').prepend(validation(response));
                }
            })
        }

        function destroy(id){
            Swal.fire({
            title: 'Delete',
            text: 'Apakah anda yakin akan menghapus data ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#929ba1',
            confirmButtonText: 'Oke'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "{{  route('vehicle_usage.delete')  }}/"+id,
                        success: function(response){
                            if(response.success) {
                                iziToast.success({
                                    title : 'success',
                                    message : response.message,
                                    position : 'topRight'
                                });
                                dataTable.ajax.reload();
                            } else {
                                iziToast.error({
                                    title : 'failed',
                                    message : response.message,
                                    position : 'topRight'
                                });
                            }
                        }
                    });
                }
            });
        }

        function approve(id) {
           $.ajax({
                url: "{{ route('vehicle_usage.approve') }}/"+id,
                success: function(response) {
                    bootbox.dialog({
                        title: 'Confirm Approve',
                        message: response
                    })
                }
           })
        }

        function approved(id) {
            $('#form-approve .alert').remove();
            var approvalId = $('input[name="approval_id"]').val(); 
            $.ajax({
                url: "{{ route('vehicle_usage.approved') }}/"+id,
                type: 'POST',
                dataType: 'JSON',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "approval_id": approvalId
                },
                success: function(response) {
                    if(response.success) {
                        iziToast.success({
                            title : 'success',
                            message : response.message,
                            position: 'topRight'
                        });
                    } else {
                        iziToast.error({
                            title : 'false',
                            message : response.message,
                            position: 'topRight'
                        });
                    }
                    bootbox.hideAll()
                },
                error: function(xhr) {
                    let response = JSON.parse(xhr.responseText);
                    $('#form-edit').prepend(validation(response));
                }
            })
        }
 
        function approve_by_officer(id){
            Swal.fire({
            title: 'Approve Request',
            text: 'Apakah anda yakin ingin menyetujui permintaan ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#929ba1',
            confirmButtonText: 'Oke'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "{{  route('vehicle_usage.approved-by-officer')  }}/"+id,
                        type: 'POST',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": id
                        },
                        success: function(response){
                            if(response.success) {
                                iziToast.success({
                                    title : 'success',
                                    message : response.message,
                                    position : 'topRight'
                                });
                                dataTable.ajax.reload();
                            } else {
                                iziToast.error({
                                    title : 'failed',
                                    message : response.message,
                                    position : 'topRight'
                                });
                            }
                        }
                    });
                }
            });
        }
     

        function reject(id) {
            Swal.fire({
            title: 'Reject',
            text: 'Apakah anda yakin ingin membatalkan data ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#929ba1',
            confirmButtonText: 'Oke'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "{{  route('vehicle_usage.reject')  }}/"+id,
                        success: function(response){
                            if(response.success) {
                                iziToast.success({
                                    title : 'success',
                                    message : response.message,
                                    position : 'topRight'
                                });
                                dataTable.ajax.reload();
                            } else {
                                iziToast.error({
                                    title : 'failed',
                                    message : response.message,
                                    position : 'topRight'
                                });
                            }
                        }
                    });
                }
            });
        }


        function validation(errors) {
            var validations = '<div class="alert alert-danger">';
                validations += '<p><b>'+errors.message+'</b></p>';
                $.each(errors.errors, function(i, error){
                    validations += error[0]+'<br>';
                });
                validations += '</div>';
            return validations;
        }

    </script>
@endsection
