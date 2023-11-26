@extends('backend.layouts.app')
@section('content')

@php
$roles = [];
@endphp


<div class="content-wrapper">
    <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Permission Management</h1><br>
            </div>
            <div class="col-sm-6">
            <div id="response" style="float: right;" role="alert"></div>
            </div>
            <div class="container-fluid">
            <div class="row">
                <div class="col">
                <div class="card">
                    <div style="display: inline-flex;" class="card-header">
                    <h3 class="card-title col-md-11">Edit Permission</h3>
                    <button type="button" class="btn btn-success btn-block btn-sm" title="Create New Permission" data-toggle="modal" data-target="#addpermissionModal">
                        <i class="fa fa-plus"></i> Permission</button>
                </div>
                <div class="card-body">
                <table class="table table-bordered">
                <form id="permission_form">
                    @csrf
                    <thead>
                        <tr>
                            <th style="width: 5%;">No.</th>
                            <th style="width: 35%;">Permission</th>
                            @foreach($roleList as $role)
                            <th style="width: 7%;text-align:center">{{$role->name}}</th>
                            @endforeach
                        </tr>
                    </thead>
                        <tbody>
                        @if(count($permissionList) == 0)
                            <tr>
                                <td colspan="4" style="text-align: center;"><p><i class="fas fa-info-circle"></i> No record was found.</p></td>
                            </tr>
                        @endif
                        @foreach($permissionList as $permission)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$permission->name}}</td>
                                @foreach($roleList as $role)
                                <td style="text-align: center;">
                                    <div class="custom-control custom-switch custom-switch-on-success">
                                    <input type="checkbox" name="permissions[{{$permission->id}}][{{$role->id}}]" class="custom-control-input" 
                                    id="permission_{{$permission->id}}_{{$role->id}}" 
                                    @if($role->hasPermissionTo($permission))
                                        checked
                                    @endif
                           >
                                    <label class="custom-control-label" for="permission_{{$permission->id}}_{{$role->id}}"></label>
                                    </div>
                                </td>
                                @endforeach
                            </tr>
                            @endforeach
                    </tbody>
                </table>
                <br>
                <div class="row">
                    <div class="col">
                    <button type="button" style="width: 100px;" class="btn btn-block btn-success" data-toggle="modal" data-target="#savepermissionModal"><i class="fas fa-save"></i>
                     Save</button>
                    </div>
                </div>
            </form>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="addpermissionModal" tabindex="-1" aria-labelledby="addpermissionModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">Add Permission</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </div>
                <form id="submit_permission">
                    @csrf
                <div class="modal-body" id="">
                    <label for="">Permission Name<span style="color: red;">*</span></label>
                    <div class="input-group mb-3">
                    <input id="role_name" type="text" class="form-control @error('permission_name') is-invalid @enderror" name="permission_name" value="" required autocomplete="permission_name" autofocus>
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-unlock-alt"></span>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Add Permission</button>
                </div>
                </div>
                </form>
            </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="savepermissionModal" tabindex="-1" aria-labelledby="savepermissionModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-exclamation-triangle"></i> Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </div>
                <div class="modal-body" id="">
                    <p>Are you sure you want to save this permission?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="savePermission" class="btn btn-success"><i class="fas fa-save"></i> Save</button>
                </div>
                </div>
            </div>
            </div>

            <div class="card-footer clearfix">
                <div class="row">
                    <div class="col-sm-12 col-md-5">
                        <div class="dataTables_info" aria-live="polite">Showing {{$permissionList->firstItem()}} to {{$permissionList->lastItem()}} of {{$permissionList->total()}} entries</div>
                    </div>
                    <div class="col-sm-12 col-md-7">
                        <div class="dataTables_paginate paging_simple_numbers">
                            <ul class="pagination pagination m-0 float-right">
                                {{$permissionList->links()}}
                            </ul>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>

<script type="text/javascript">

$(document).ready(function(){
    $('#submit_permission').on('submit', function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            // ('#frm_register .hasError').html('');
            createPermission(formData);

        });

        $('#savePermission').on('click', function() {
            // Prevent the default form submission
            event.preventDefault();

            // Collect form data
            var formData = $('#permission_form').serializeArray();
            var selectedPermissions = formData.filter(item => item.value === 'on');
            var permissionsByRole = {};

            selectedPermissions.forEach(permission => {
                var parts = permission.name.split('][');
                var roleId = parts[1];
                var permissionId = parts[0].replace('permissions[', '');

                if (!permissionsByRole[roleId]) {
                    permissionsByRole[roleId] = [];
                }

                permissionsByRole[roleId].push(permissionId);
            });

            var permissionsArray = Object.entries(permissionsByRole).map(([roleId, permissionIds]) => ({ roleId, permissionIds }));
            console.log('permissionsByRole:', permissionsByRole);
            console.log(permissionsArray);

            // Submit the form using AJAX
            $.ajax({
                type: 'POST',
                url: "{{route('uac.permission-assign')}}",
                data: {
                    permissions: permissionsArray,
                    _token: $('input[name="_token"]').val(),
                },
                success: function(response) {
                    // Handle success if needed
                    console.log(response);
                    toastr.success(response['message']);
                },
                error: function(error) {
                    // Handle error if needed
                    console.error(error);
                }
            });

            // Optionally, close the modal
            $('#savepermissionModal').modal('hide');
        });
});


function createPermission(data){
    $('#addpermissionModal').modal('hide');
    console.log(data);
    $.ajax({
        url: "{{ route('uac.permission-store') }}",
        type: 'post',
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        method: 'POST',
        success: function(response) {
            console.log(response);
            toastr.success(response['message']);
            // $('#response').html('<span class="text-success">'+response.message+'</span>').fadeIn(500).fadeOut(5000);
            setTimeout(function (){
                window.location = response['url'];
            }, 3000);
        },
        error: function(response) {
            // parent.stopLoading();
            // var errors = response.responseJSON.errors;

            // $.each(errors, function(key, value) {
            //     if($('[name="'+key+'"]').attr('type') == 'radio' || $('[name="'+key+'"]').attr('type') == 'checkbox'){
            //         if($('[name="'+key+'"]').find('.hasErr').length == 0){
            //             $('[name="'+key+'"]').parent().append('<div class="hasErr text-danger col-12 fs-6">'+value[0]+'</div>');
            //         }
            //     } else {
            //         if($('[name="'+key+'"]').find('.hasErr').length == 0){
            //             $('[name="'+key+'"]').parent().append('<div class="hasErr text-danger col-12 fs-6">'+value[0]+'</div>');
            //         }
            //     }
            // });


        }

    });
}


</script>

@endsection