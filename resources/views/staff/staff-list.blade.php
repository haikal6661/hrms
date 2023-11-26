@extends('backend.layouts.app')
@section('content')

<style>
     .delete{
        padding-left: 10px;
        padding-right: 10px;
    }
</style>

<div class="content-wrapper">
    <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Staff</h1><br>
            </div>
            <div class="col-sm-6">
            <div id="response" style="float: right;" role="alert"></div>
            </div>
            <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                <div class="card">
                    <div style="display: inline-flex;" class="card-header">
                    <h3 class="card-title col-md-11">List of staff</h3>
                    @can('create staff')
                    <button type="button" class="btn btn-success btn-block btn-sm" title="Register new staff" data-toggle="modal" data-target="#registerModal">
                        <i class="fa fa-plus"></i> Staff</button>
                    @endcan
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">No.</th>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Department</th>
                                <th>Supervisor</th>
                                <th style="width: 140px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($stafflist) == 0)
                            <tr>
                                <td colspan="6" style="text-align: center;"><p><i class="fas fa-info-circle"></i> No record was found.</p></td>
                            </tr>
                            @endif
                            @foreach ($stafflist as $staff)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$staff->fullname}}</td>
                                <td>{{$staff->hasPosition->desc ?? 'Not Assigned'}}</td>
                                <td>{{$staff->hasDepartment->desc ?? 'Not Assigned'}}</td>
                                <td>{{$staff->hasSupervisor->fullname ?? 'Not Assigned'}}</td>
                                <td>
                                    <div class="row">
                                        <div class="col-4">
                                            <button type="button" class="btn btn-primary btn-sm view" title="View" 
                                            data-toggle="modal" data-target="#viewModal" data-id="{{$staff->id}}"><i class="fa fa-eye"></i></button>
                                        </div>
                                        <div class="col-4">
                                            <a href="{{route('staff.staff-edit',['id' => $staff->id])}}" class="btn btn-success btn-sm edit" role="button" title="Edit"><i class="fa fa-user-edit"></i></a>
                                        </div>
                                        <div class="col-4">
                                            <button type="button" class="btn btn-danger btn-sm remove" title="Remove" 
                                            data-toggle="modal" data-target="#removeModal" data-id="{{$staff->id}}"><i class="fa fa-trash-alt"></i></button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            <!-- Modal -->
            <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registerModalLabel">Register New Staff</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </div>
                <div class="modal-body">
                <div class="card-body">
                <p class="login-box-msg"></p>

                <form id="register_form">
                    @csrf
                    <div class="input-group mb-3">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Full Name" required 
                    oninput="this.value = this.value.toUpperCase()" autocomplete="name" autofocus>
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-user"></span>
                        </div>
                    </div>
                    </div>
                    <div class="input-group mb-3">
                    <input id="name" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" placeholder="Username" required autocomplete="username" autofocus>
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-user"></span>
                        </div>
                    </div>
                    </div>
                    <div class="input-group mb-3">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email" required autocomplete="email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    </div>
                    <div class="input-group mb-3">
                        <select class="form-control select2" name="position_id" id="position">
                            <option selected="selected" value="">Please select position...</option>
                            @foreach ($refposition as $position)
                            <option value="{{$position->id}}">{{$position->desc}}</option>
                            @endforeach
                        </select>
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-briefcase"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <select class="form-control select2" name="department_id" id="department">
                            <option selected="selected" value="">Please select department...</option>
                            @foreach ($refdepartment as $department)
                            <option value="{{$department->id}}">{{$department->desc}}</option>
                            @endforeach
                        </select>
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-building"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="new-password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    </div>
                    <div class="input-group mb-3">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    </div>
                    <div class="input-group mb-3">
                        <input style="margin-left: 0px;" class="form-check-input" type="checkbox" name="is_supervisor" id="is_supervisor" value="1">
                        <label style="padding-left: 20px;" for="is_supervisor" class="form-check-label">Supervisor</label>
                    </div>
                </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Register</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </form>
                </div>
            </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </div>
                <div class="modal-body">
                <div class="card-body">
                <p class="login-box-msg"></p>
                <input type="hidden" id="id" value="">
                    <label for="">Name :</label>
                    <h5 class="view_form" id="view_name"></h5><hr>
                    <label for="">Email :</label>
                    <h5 class="view_form" id="view_email"></h5><hr>
                    <label for="">IC No :</label>
                    <h5 class="view_form" id="view_ic_no"></h5><hr>
                    <label for="">Address :</label>
                    <h5 class="view_form" id="view_address"></h5><hr>
                    <label for="">Phone No :</label>
                    <h5 class="view_form" id="view_phone_no"></h5><hr>
                    <label for="">Position :</label>
                    <h5 class="view_form" id="view_position"></h5><hr>
                    <label for="">Department :</label>
                    <h5 class="view_form" id="view_department"></h5><hr>
                    <label for="">Supervisor :</label>
                    <h5 class="view_form" id="view_supervisor"></h5><hr>
                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <!-- <button type="submit" class="btn btn-primary">Register</button> -->
                </div>
                </div>
            </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="removeModal" tabindex="-1" aria-labelledby="removeModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-exclamation-triangle"></i> Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </div>
                <div class="modal-body">
                <div class="card-body">
                <p class="login-box-msg"></p>
                <input type="hidden" id="id" value="">
                @csrf
                    <p>Are you sure you want to remove this staff?</p>
                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="removeStaff" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-trash-alt"></i> Remove</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <!-- <button type="submit" class="btn btn-primary">Register</button> -->
                </div>
                </div>
            </div>
            </div>

            <div class="card-footer clearfix">
                <div class="row">
                    <div class="col-sm-12 col-md-5">
                        <div class="dataTables_info" aria-live="polite">Showing {{$stafflist->firstItem()}} to {{$stafflist->lastItem()}} of {{$stafflist->total()}} entries</div>
                    </div>
                    <div class="col-sm-12 col-md-7">
                        <div class="dataTables_paginate paging_simple_numbers">
                            <ul class="pagination pagination m-0 float-right">
                                {{$stafflist->links()}}
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

    function submitRegister(data) {
    $('#registerModal').modal('hide');
    console.log("hehe");
    $.ajax({
        url: "{{ route('staff.staff-store') }}",
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

$(".remove").click(function(){
    var data = $(this).attr("data-id"); //GET THE DATA IN ATTR
    event.preventDefault();
    console.log(data);
    $(".modal-body #id").val(data);
    console.log('click');
})

$("#removeStaff").click(function(){
    var staffID = document.getElementById("id").value;
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    
    $.ajax({
        url: "{{ route('staff.staff-delete') }}?id=" + staffID,
        type: 'delete',
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        cache: false,
        contentType: false,
        processData: false,
        method: 'DELETE',
        success: function(response) {
            console.log(response);
            toastr.success(response['message']);
            // $('#response').html('<span class="text-success">'+response.message+'</span>').fadeIn(500).fadeOut(5000);
            setTimeout(function (){
                window.location = response['url'];
            }, 3000);
        },
        error: function(response) {

        }

    });
    console.log('removing staff with id:',staffID);
})

$(".view").click(function() {
  
  var data = $(this).attr("data-id"); // GET THE DATA IN ATTR
  event.preventDefault();
  console.log(data);
  $(".modal-body #id").val(data);

  var url = '{{ route("staff.getStaffDetail", "data=id") }}';
    url = url.replace('id', data);

    $.ajax({
        url: url,
        type: 'get',
        dataType: 'json',
        success: function(response) {
            if (response) {
                console.log(response);
                $('.view_form').html("");
                $('#viewModalLabel').html("View "+response[0].fullname);
                $('#staff_id').val(response[0].id);
                $('#view_name').html(response[0].fullname);
                $('#view_email').html(response[0].email);
                $('#view_ic_no').html(response[0].ic_no);
                $('#view_address').html(response[0].address);
                $('#view_phone_no').html(response[0].phone_no);
                $('#view_position').html(response[0].has_position.desc);
                $('#view_department').html(response[0].has_department.desc);
                $('#view_supervisor').html(response[0].has_supervisor.fullname);
            }else{
                // $('#staff_id').val(response[0].id);
                // $('#nama_pegawai').html(response[0].name);
                // $('#penempatan_semasa').html('TIADA');
            }
        }
    });

});

$(document).ready(function(){

    $('#register_form').on('submit', function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            // ('#frm_register .hasError').html('');
            submitRegister(formData);

        });
    });
</script>

@endsection