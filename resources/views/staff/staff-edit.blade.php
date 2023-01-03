@extends('backend.layouts.app')
@section('content')

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
                    <h3 class="card-title col-md-11">Edit staff</h3>
                    <!-- <button type="button" class="btn btn-success btn-block btn-sm" title="Register new staff" data-toggle="modal" data-target="#registerModal">
                        <i class="fa fa-plus"></i> Staff</button> -->
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                        <form id="update_staff_form">
                        @csrf
                        <label for="">Name</label>
                            <div class="input-group mb-3">
                            <input id="fullname" type="text" class="form-control @error('fullname') is-invalid @enderror" name="fullname" value="{{$detail->fullname}}" required autocomplete="fullname" autofocus>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                <span class="fas fa-user"></span>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="col">
                        <label for="">Email</label>
                            <div class="input-group mb-3">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$detail->email}}" required autocomplete="email" autofocus>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                        <label for="">IC No.</label>
                            <div class="input-group mb-3">
                            <input id="ic_no" type="text" class="form-control @error('ic_no') is-invalid @enderror" name="ic_no" value="{{$detail->ic_no}}" required 
                            oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="12" autocomplete="ic_no" autofocus>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                <span class="fas fa-id-card"></span>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="col">
                        <label for="">Address</label>
                            <div class="input-group mb-3">
                            <textarea name="address" class="form-control" rows="4">{{$detail->address}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                        <label for="">Phone No.</label>
                            <div class="input-group mb-3">
                            <input id="phone_no" type="text" class="form-control @error('phone_no') is-invalid @enderror" name="phone_no" value="{{$detail->phone_no}}" required 
                            oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="12" autocomplete="phone_no" autofocus>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                <span class="fas fa-phone"></span>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="col">
                        <label for="">Position</label>
                            <div class="input-group mb-3">
                            <select class="form-control select2" name="position_id" id="position">
                                <option selected="selected" value="">Please select position...</option>
                                @foreach ($refposition as $position)
                                <option value="{{$position->id}}" {{$detail && $detail['position_id'] == $position->id  ? 'selected' : ''}}>{{$position->desc}}</option>
                                @endforeach
                            </select>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                <span class="fas fa-briefcase"></span>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                        <label for="">Supervisor</label>
                            <div class="input-group mb-3">
                            <select class="form-control select2" name="supervisor_id" id="supervisor_id">
                                <option selected="selected" value="">Please select supervisor...</option>
                                @foreach ($refsupervisor as $supervisor)
                                <option value="{{$supervisor->id}}" {{$detail && $detail['supervisor_id'] == $supervisor->id  ? 'selected' : ''}}>{{$supervisor->fullname}}</option>
                                @endforeach
                            </select>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                <span class="fas fa-user-tie"></span>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="col">
                        <label for="">Department</label>
                            <div class="input-group mb-3">
                            <select class="form-control select2" name="department_id" id="department">
                                <option selected="selected" value="">Please select department...</option>
                                @foreach ($refdepartment as $department)
                                <option value="{{$department->id}}" {{$detail && $detail['department_id'] == $department->id  ? 'selected' : ''}}>{{$department->desc}}</option>
                                @endforeach
                            </select>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                <span class="fas fa-building"></span>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer clearfix">
                    <button type="button" style="width: 100px;" class="btn btn-block btn-primary" onclick="submitStaffUpdate({{$detail->id}}, 'submit1')"><i class="fas fa-save"></i>
                     Update</button>
                </div>
                </form>
                </div>
            </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="updateStaffModal" tabindex="-1" aria-labelledby="updateStaffModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Update Confirmation</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
        </button>
        </div>
        <div class="modal-body">
            <form id="update_appr">
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


});

function submitStaffUpdate(id, result){
        $('#staff_id').val(id);
        $('#result').val(result);
        console.log(id);
        console.log(result);
        $('#updateStaffModal').modal("show");
    }

    $('#update_appr').on('submit', function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        submitFormUpdateStaff(formData);

    });

    function submitFormUpdateStaff(data) {

    $('#updateStaffModal').modal("hide");
    let formData = new FormData(document.getElementById('update_staff_form'));
    formData.append("staff_id", $('#staff_id').val());
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