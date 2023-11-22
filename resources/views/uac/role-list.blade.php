@extends('backend.layouts.app')
@section('content')


<style>
    .select2-container--default.select2-container--focus .select2-selection--multiple {
    border: solid #777676 1px;
    outline: 0;
    background-color: #343a40;
    }

    .input-group>.select2-container--default:not(:last-child) .select2-selection {
    border-bottom-right-radius: 0;
    border-top-right-radius: 0;
    background-color: #343a40;
    border: solid #777676 1px;
    }

    .select2-container--default:not(:last-child) .select2-selection--multiple .select2-selection__choice {
    background-color: #4b4b4b;
    }
</style>


<div class="content-wrapper">
    <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Role Management</h1><br>
            </div>
            <div class="col-sm-6">
            <div id="response" style="float: right;" role="alert"></div>
            </div>
            <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                <div class="card">
                    <div style="display: inline-flex;" class="card-header">
                    <h3 class="card-title col-md-11">List of Role</h3>
                    <button type="button" class="btn btn-success btn-block btn-sm" title="Create New Role" data-toggle="modal" data-target="#addRoleModal">
                        <i class="fa fa-plus"></i> Role</button>
                </div>
                <div class="card-body">
                <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">No.</th>
                                <th style="width: 40%;">Name</th>
                                <th>Total User</th>
                                <th>Created At</th>
                                <th style="width: 130px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($roles) == 0)
                            <tr>
                                <td colspan="4" style="text-align: center;"><p><i class="fas fa-info-circle"></i> No record was found.</p></td>
                            </tr>
                            @endif
                            @foreach ($roles as $role)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$role->name}}</td>
                                <td>{{$role->users_count}}</td>
                                <td>{{$role->created_at}}</td>
                                <td>
                                    <div class="row">
                                        <div class="col-4">
                                            <button type="button" class="btn btn-success btn-sm assign" title="Assign User" 
                                            data-toggle="modal" data-target="#assignUserModal" data-id="{{$role->id}}"><i class="fa fa-user-plus"></i></button>
                                        </div>
                                        <div class="col-4">
                                            <button type="button" class="btn btn-danger btn-sm unassign" title="Unassign User" 
                                            data-toggle="modal" data-target="#unassignUserModal" data-id="{{$role->id}}"><i class="fa fa-user-minus"></i></button>
                                        </div>
                                        {{-- <div class="col-4">
                                            <button type="button" class="btn btn-danger btn-sm delete" title="Delete"><i class="fa fa-trash-alt"></i></button>
                                        </div> --}}
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            <!-- Modal -->
            <div class="modal fade" id="addRoleModal" tabindex="-1" aria-labelledby="addRoleModalModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">Add New Role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </div>
                <form id="role_form">
                    @csrf
                <div class="modal-body" id="">
                    <label for="">Role Name<span style="color: red;">*</span></label>
                    <div class="input-group mb-3">
                    <input id="role_name" type="text" class="form-control @error('role_name') is-invalid @enderror" name="role_name" value="" required autocomplete="role_name" autofocus>
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-user-tag"></span>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Add Role</button>
                </div>
                </div>
                </form>
            </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="assignUserModal" tabindex="-1" aria-labelledby="assignRoleModalModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">Assign User to this role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </div>
                <form id="assign_user_form">
                    @csrf
                <div class="modal-body" id="">
                    <input type="hidden" name="roleId" id="roleId" value="">
                    <label for="">User<span style="color: red;">*</span></label>
                    <div class="input-group mb-3">
                    <select style="width: 90%;" class="form-control js-example-basic-multiple" name="user_id[]" id="position" multiple="multiple" required>
                        @foreach ($userList as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </select>
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-briefcase"></span>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Assign</button>
                </div>
                </div>
                </form>
            </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="unassignUserModal" tabindex="-1" aria-labelledby="unassignRoleModalModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Unassign User to this role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </div>
                <form id="unassign_user_form">
                    @csrf
                <div class="modal-body" id="">
                    <input type="hidden" name="roleId2" id="roleId2" value="">
                    <label for="">User<span style="color: red;">*</span></label>
                    <div class="input-group mb-3">
                    <select style="width: 90%;" class="form-control js-example-basic-multiple" name="user_id[]" id="userWithRole" multiple="multiple" required>

                    </select>
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-briefcase"></span>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Unassign</button>
                </div>
                </div>
                </form>
            </div>
            </div>

            <div class="card-footer clearfix">
                <div class="row">
                    <div class="col-sm-12 col-md-5">
                        <div class="dataTables_info" aria-live="polite">Showing {{$roles->firstItem()}} to {{$roles->lastItem()}} of {{$roles->total()}} entries</div>
                    </div>
                    <div class="col-sm-12 col-md-7">
                        <div class="dataTables_paginate paging_simple_numbers">
                            <ul class="pagination pagination m-0 float-right">
                                {{$roles->links()}}
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

    $('.js-example-basic-multiple').select2();

    $('#role_form').on('submit', function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            submitRole(formData);

        });

    $('#assignUserModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var roleId = button.data('id'); // Extract the data-id attribute

    // Update the hidden input field in the modal
    $(this).find('#roleId').val(roleId);
    });

    $('#unassignUserModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var roleId = button.data('id'); // Extract the data-id attribute

    // Update the hidden input field in the modal
    $(this).find('#roleId2').val(roleId);
    });

    $('#assign_user_form').on('submit', function (e) {
        e.preventDefault();
        var roleId = $('#roleId').val();
        let formData = new FormData(this);
        formData.append('roleId', roleId);
        assignUser(formData);
    });

    $('#unassign_user_form').on('submit', function(e) {
        e.preventDefault();
        var roleId2 = $('#roleId2').val();
        let formData = new FormData(this);
        formData.append('roleId2', roleId2);
        unassignUser(formData);

        });
    
    });
    

    function submitRole(data) {
    $('#addRoleModal').modal('hide');
    $('#role_form .hasErr').html('');
    
    $.ajax({
        url: "{{ route('uac.role-store') }}",
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


        }

    });
}

function assignUser(data) {
    $('#assignUserModal').modal('hide');
    $('#assign_user_form .hasErr').html('');
    
    $.ajax({
        url: "{{ route('uac.assign-user') }}",
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


        }

    });
}

function unassignUser(data) {
    $('#unassignUserModal').modal('hide');
    $('#unassign_user_form .hasErr').html('');
    
    $.ajax({
        url: "{{ route('uac.unassign-user') }}",
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


        }

    });
}

$(document).ready(function() {
    $('.unassign').on('click', function () {
        var roleId = $(this).data('id');
        console.log(roleId);
        var selectElement = $('#userWithRole');

        $.ajax({
            url: "{{ route('uac.get-users-for-role', ['roleId' => ':roleId']) }}".replace(':roleId', roleId),
            type: 'get',
            success: function (response) {
                // Handle the response, e.g., display users in the modal
                console.log(response.users);
                selectElement.empty();
                $.each(response.users, function(index, user) {
                    console.log(user); // Log each user object to the console
                    selectElement.append('<option value="' + user.id + '">' + user.name + '</option>');
                });
            },
            error: function (error) {
                console.error(error);
            }
        });
    });
});


</script>

@endsection