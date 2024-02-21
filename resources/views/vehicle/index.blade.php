@extends('layouts.main')
@section('title','Vehicle')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="form-group">
                    <!-- <button type="button" id="btn-create" class="btn btn-primary" onclick="document.location.href='<?= route('vehicles.create') ?>'">Create</button> -->
                    <button type="button" id="btn-create" class="btn btn-primary" onclick="create()">Create</button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table" class="table table-striped table-bordered" width="100%">
                        <thead>
                            <tr>
                                <th>Company Name</th>
                                <th>Vehicle Name</th>
                                <th>Vehicle Type</th>
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
            dataTable = $('#table').dataTable({
                processing: true,
                serverSide: true,
                scrollX: true,
                ajax: '',
                columns: [
                    {data: 'company_name', name: 'companies.name'},
                    {data: 'name', name: 'vehicles.name'},
                    {data: 'vehicle_type', name: 'vehicles.vehicle_type'},
                    {data: '_', searchable: false, orderable: false, class: 'text-center'},
                ]
            })
        });
        console.log(dataTable)

        function create() {
            $.ajax({
                url: "{{ route('vehicles.create') }}",
                success: function(response) {
                    bootbox.dialog({
                        title: 'Create Vehicle',
                        message: response
                    })
                }
            })
        }

        function edit(id) {
            $.ajax({
                url: "{{ route('vehicles.edit') }}/"+id,
                success: function(response) {
                    bootbox.dialog({
                        title: 'Edit Vehicle',
                        message: response
                    })
                }
            })
        }

        function view(id) {
            $.ajax({
                url: "{{  route('vehicles.view') }}/"+id,
                success: function(response) {
                    bootbox.dialog({
                        size: 'large',
                        title: 'View Vehicle',
                        message: response
                    })
                }
            })
        }

        function store() {
            $('#form-create .alert').remove()
            $.ajax({
                url: "{{ route('vehicles.insert') }}",
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
                url: "{{  route('vehicles.update')  }}/"+id,
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
                        url: "{{  route('vehicles.delete')  }}/"+id,
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
