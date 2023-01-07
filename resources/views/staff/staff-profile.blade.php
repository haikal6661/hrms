@extends('backend.layouts.app')
@section('content')

<div class="content-wrapper">
    <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">My Profile</h1><br>
            </div>
            <div class="col-sm-6">
            <div id="response" style="float: right;" role="alert"></div>
            </div>
            <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                <div class="card card-tabs">
                    <div style="display: inline-flex;" class="card-header">
                    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                    <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="true">Profile</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-password-tab" data-toggle="pill" href="#custom-tabs-one-password" role="tab" aria-controls="custom-tabs-one-password" aria-selected="false">Security</a>
                    </li>
                    </ul>
                    <!-- <h3 class="card-title col-md-11">My Profile</h3> -->
                    <!-- <button type="button" class="btn btn-success btn-block btn-sm" title="Register new staff" data-toggle="modal" data-target="#registerModal">
                        <i class="fa fa-plus"></i> Staff</button> -->
                </div>
                <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                    <div class="tab-pane fade active show" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                    <div class="row">
                        <div class="col">
                        <form id="update_profile">
                        @csrf
                        <label for="">Name :</label>
                            <div class="input-group mb-3">
                            <p>{{$staff->fullname}}</p>
                            </div>
                        </div>
                        <div class="col">
                        <label for="">Email :</label>
                            <div class="input-group mb-3">
                            <p>{{$staff->email}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                        <label for="">IC No. :</label>
                            <div class="input-group mb-3">
                            <input id="ic_no" type="text" class="form-control @error('ic_no') is-invalid @enderror" name="ic_no" value="{{$staff->ic_no}}"  
                            oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="12" autocomplete="ic_no" autofocus>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                <span class="fas fa-id-card"></span>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="col">
                        <label for="">Address :</label>
                            <div class="input-group mb-3">
                            <textarea name="address" class="form-control" rows="4">{{$staff->address}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                        <label for="">Phone No. :</label>
                            <div class="input-group mb-3">
                            <input id="phone_no" type="text" class="form-control @error('phone_no') is-invalid @enderror" name="phone_no" value="{{$staff->phone_no}}" 
                            oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="12" autocomplete="phone_no" autofocus>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                <span class="fas fa-phone"></span>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="col">
                        <label for="">Position :</label>
                            <div class="input-group mb-3">
                            <p>{{$staff->hasPosition->desc}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                        <label for="">Supervisor :</label>
                            <div class="input-group mb-3">
                            <p>{{$staff->hasSupervisor->fullname ?? 'Not Assign'}}</p>
                            </div>
                        </div>
                        <div class="col">
                        <label for="">Department :</label>
                            <div class="input-group mb-3">
                            <p>{{$staff->hasDepartment->desc}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <p>Note : Contact your admin if there is any changes to this detail.</p>
                        </div>
                    </div>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-one-password" role="tabpanel" aria-labelledby="custom-tabs-one-password-tab">
                    <p>Change your password.</p>
                    <a href="{{ route('password.request') }}" class="btn btn-success" role="button"><i class="fas fa-user-lock"></i> Change password</a>
                    </div>
                </div>
                </div>
                <div class="card-footer clearfix" id="footer">
                    <button type="button" style="width: 100px;" class="btn btn-block btn-primary" onclick="submitProfileUpdate({{$staff->id}}, 'profile')"><i class="fas fa-save"></i>
                     Update</button>
                </div>
                </form>
                </div>
            </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="updateStaffProfile" tabindex="-1" aria-labelledby="updateStaffProfileLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Profile Update Confirmation</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
        </button>
        </div>
        <div class="modal-body">
            <form id="update_profile_appr">
                @csrf
            <p><i class="fas fa-info-circle"></i> Are you sure you want to update this data?</p>
        </div>
            <div class="modal-footer">
                <input type="hidden" name="staff_id" id="staff_id">
                <input type="hidden" name="result" id="result">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Yes</button>
            </div>
            </form>
        </div>
        </div>
        </div>
    </div>
    </div>
</div>

<script type="text/javascript">

$(document).ready(function(){

    $("#custom-tabs-one-password-tab").click(function(){
        $("#footer").hide();
    });
    $("#custom-tabs-one-profile-tab").click(function(){
        $("#footer").show();
    });

});

function submitProfileUpdate(id, result){
        $('#staff_id').val(id);
        $('#result').val(result);
        console.log(id);
        console.log(result);
        $('#updateStaffProfile').modal("show");
    }

    $('#update_profile_appr').on('submit', function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        submitStaffProfile(formData);

    });

    function submitStaffProfile(data) {

    $('#updateStaffProfile').modal("hide");
    let formData = new FormData(document.getElementById('update_profile'));
    formData.append("staff_id", $('#staff_id').val());
    formData.append("result", $('#result').val());
    // $('#frm_work_history .hasErr').html('');
    // parent.startLoading();
    $.ajax({
        url: "{{ route('staff.staff-update') }}",
        type: 'post',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        method: 'POST',
        success: function(response) {
            toastr.success(response['message']);
            // $('#response').html('<span class="text-success">'+response.message+'</span>').fadeIn(500).fadeOut(5000);
            // window.location = response['url'];
            // parent.stopLoading();
        },
        error: function(response) {
            toastr.error(response['message']);

        }

    });
}


</script>


@endsection