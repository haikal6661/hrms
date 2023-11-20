@extends('backend.layouts.app')
@section('content')

<style>
    .image-area {
  position: relative;
    }
    .image-area img{
    max-width: 100%;
    height: auto;
    }
    .remove-image {
    display: none;
    position: absolute;
    top: 5px;
    right: 15px;
    border-radius: 10em;
    padding: 2px 6px 3px;
    text-decoration: none;
    font: 700 21px/20px sans-serif;
    background: #555;
    border: 3px solid #fff;
    color: #FFF;
    box-shadow: 0 2px 6px rgba(0,0,0,0.5), inset 0 2px 4px rgba(0,0,0,0.3);
    text-shadow: 0 1px 2px rgba(0,0,0,0.5);
    -webkit-transition: background 0.5s;
    transition: background 0.5s;
    }
    .remove-image:hover {
    background: #E54E4E;
    padding: 3px 7px 5px;
    top: 5px;
    right: 15px;
    }
    .remove-image:active {
    background: #E54E4E;
    top: 6px;
    right: 15px;
    }

    .image-area .overlay {
    position: absolute; 
    bottom: 0; 
    background-color: rgba(0, 0, 0, 0.5); /* Black see-through */
    color: #f1f1f1; 
    width: 100%;
    transition: .5s ease;
    opacity:0;
    color: white;
    font-size: 20px;
    padding: 20px;
    text-align: center;
    }

    .image-area:hover .overlay {
    opacity: 1;
    }

</style>

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
                    <a class="nav-link" id="custom-tabs-one-details-tab" data-toggle="pill" href="#custom-tabs-one-details" role="tab" aria-controls="custom-tabs-one-details" aria-selected="false">Details</a>
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
                    <form id="update_profile" enctype="multipart/form-data">
                    @csrf
                    <div class="row d-flex justify-content-center">
                        <div class="row">
                            <div class="image-area" style="cursor:pointer">
                                <input type='file' name="image" id="imgInp" class="form-control @error('image') is-invalid @enderror" style="display:none" />
                                
                                @isset($staff->image_path)
                                <img id="blah" style="border-radius:50%; border-style:outset" src="{{asset('storage/'.$staff->image_path)}}" alt="your image" height="150" width="150"/>
                                @else
                                <img id="blah" style="border-radius:50%; border-style:outset" src="{{asset('default_picture.jpg')}}" alt="your image" height="150" width="150"/>
                                @endif
                                <!-- <div class="overlay" style="border-radius:0 0 10em 10em; height:100px; width:200px;">Change</div> -->
                                <a class="remove-image" href="#" style="display: inline; color:white;">&#215;</a>
                            </div>
                        </div>
                    </div>
                    <div class="hasErr"></div>
                    <div class="row d-flex justify-content-center mb-3">
                        <label for="profile_picture">Profile Picture</label>
                    </div>
                    <div class="row">
                        <div class="col">
                        <label for="">Name :</label>
                            <div class="input-group mb-3">
                            <p>{{$staff->fullname ?? ''}}</p>
                            </div>
                        </div>
                        <div class="col">
                        <label for="">Email :</label>
                            <div class="input-group mb-3">
                            <p>{{$staff->email ?? ''}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                        <label for="">IC No. :</label>
                            <div class="input-group mb-3">
                            <input id="ic_no" type="text" class="form-control @error('ic_no') is-invalid @enderror" name="ic_no" value="{{$staff->ic_no ?? ''}}"  
                            oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="12" autocomplete="ic_no" autofocus>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                <span class="fas fa-id-card"></span>
                                </div>
                            </div>
                            </div>
                            <label for="">Gender :</label>
                            <div class="input-group mb-3">
                                <div class="custom-control custom-radio">
                                    <div class="col-4">
                                    <input class="custom-control-input" type="radio" id="result1" value="1" {{ $staff->gender_id === 1 ? 'checked' : '' }} name="gender">
                                    <label for="result1" class="custom-control-label">Male</label>
                                    </div>
                                </div>
                                <div class="custom-control custom-radio">
                                    <div class="col-4">
                                    <input class="custom-control-input" type="radio" id="result2" value="2" {{ $staff->gender_id === 2 ? 'checked' : '' }} name="gender">
                                    <label for="result2" class="custom-control-label">Female</label>
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
                            <p>Note : Contact your admin if there is any changes to this details.</p>
                        </div>
                    </div>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-one-details" role="tabpanel" aria-labelledby="custom-tabs-one-details-tab">
                    <div class="row">
                        <div class="col">
                        <label for="">Marriage Status</label>
                            <div class="input-group mb-3">
                            <select class="form-control select2" name="marriage_status" id="marriage_status" onchange="showDiv('spouse_details', this)">
                                <option selected="selected" value="">Please select your status...</option>
                                <option value="Single" {{ optional($staff->hasDetail)->marriage_status == 'Single' ? 'selected' : '' }}>Single</option>
                                <option value="Married" {{ optional($staff->hasDetail)->marriage_status == 'Married' ? 'selected' : '' }}>Married</option>
                            </select>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                <span class="fas fa-user-tie"></span>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="col">
                                
                        </div>
                    </div><br>
                    <div id="spouse_details" style="display: none;">
                    <h4>Spouse Details</h4>
                    <div class="row">
                        <div class="col">
                        <label for="">Name</label>
                            <div class="input-group mb-3">
                            <input id="spouse_name" type="text" class="form-control @error('spouse_name') is-invalid @enderror" name="spouse_name" value="{{$staff->hasDetail->spouse_name ?? ''}}" required autocomplete="spouse_name" autofocus>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                <span class="fas fa-user"></span>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="col">
                        <label for="">Phone No.</label>
                            <div class="input-group mb-3">
                            <input id="spouse_phone_no" type="text" class="form-control @error('spouse_phone_no') is-invalid @enderror" name="spouse_phone_no" 
                            oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="12" placeholder="0123456789" value="{{$staff->hasDetail->spouse_phone_no ?? ''}}" autocomplete="spouse_phone_no" autofocus>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                <span class="fas fa-phone"></span>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                        <label for="">Occupation</label>
                            <div class="input-group mb-3">
                            <input id="occupation" type="text" class="form-control @error('occupation') is-invalid @enderror" name="occupation" value="{{$staff->hasDetail->occupation ?? ''}}" required autocomplete="occupation" autofocus>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                <span class="fas fa-briefcase"></span>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="col">
                            <label for="">No. Of Children</label>
                            <div class="input-group mb-3">
                            <input id="no_children" type="number" class="form-control @error('no_children') is-invalid @enderror" name="no_children" value="{{$staff->hasDetail->no_children ?? ''}}" required autocomplete="no_children" autofocus>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                <span class="fas fa-child"></span>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div><br>
                    </div>
                    
                    <h4>Emergency Contact</h4>
                    <div class="row">
                    <div class="col">
                        <label for="">Name</label>
                            <div class="input-group mb-3">
                            <input id="emergency_name" type="text" class="form-control @error('emergency_name') is-invalid @enderror" name="emergency_name" value="{{$staff->hasDetail->emergency_name ?? ''}}" required autocomplete="emergency_name" autofocus>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                <span class="fas fa-user"></span>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="col">
                        <label for="">Phone No.</label>
                            <div class="input-group mb-3">
                            <input id="emergency_phone_no" type="text" class="form-control @error('emergency_phone_no') is-invalid @enderror" name="emergency_phone_no" 
                            oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="12" placeholder="0123456789" value="{{$staff->hasDetail->emergency_phone_no ?? ''}}" autocomplete="emergency_phone_no" autofocus>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                <span class="fas fa-phone"></span>
                                </div>
                            </div>
                            </div>
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
    $("#custom-tabs-one-details-tab").click(function(){
        $("#footer").show();
    });

    $('#blah').click(function(){
        $('#imgInp').click();
    })

    // Show/hide the div based on the initial value of the dropdown
    toggleDivVisibility();

    // Bind an event handler to the dropdown change event
    $('#marriage_status').on('change', function() {
        toggleDivVisibility();
    });

    // Function to toggle the visibility of the div based on the selected value
    function toggleDivVisibility() {
        var selectedValue = $('#marriage_status').val();

        // Show the div if the selected value is 'Married', otherwise hide it
        if (selectedValue == 'Married') {
            $('#spouse_details').show();
        } else {
            $('#spouse_details').hide();
        }
    }


function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#imgInp").change(function(){
        readURL(this);
    });


});

    document.addEventListener("DOMContentLoaded", function() {
        const imgInp = document.getElementById("imgInp");
        const imgElem = document.getElementById("blah");
        const removeImageLink = document.querySelector(".remove-image");

        imgInp.addEventListener("change", function() {
            const file = imgInp.files[0];
            if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imgElem.src = e.target.result;
                removeImageLink.style.display = "inline"; // Show the "Remove" link
            };
            reader.readAsDataURL(file);
            }
        });

        removeImageLink.addEventListener("click", function(event) {
            event.preventDefault();
            imgElem.src = "{{asset('default_picture.jpg')}}";
            imgInp.value = ""; // Reset file input
            removeImageLink.style.display = "none"; // Hide the "Remove" link
        });

    });


    const icNoInput = document.getElementById("ic_no");
    const dateOfBirthOutput = document.getElementById("display_DOB");

    icNoInput.addEventListener("input", extractDateOfBirth);

    function extractDateOfBirth() {
            console.log(icNoInput);

            const icNo = icNoInput.value.trim();

            // if (icNo.length !== 12) {
            //     dateOfBirthOutput.textContent = "Invalid IC No";
            //     return;
            // }

            const year = icNo.substr(0, 2);
            const month = icNo.substr(2, 2);
            const day = icNo.substr(4, 2);

            const birthYear = parseInt(year) < 50 ? "20" + year : "19" + year;
            const dateOfBirth = new Date(birthYear, parseInt(month) - 1, day);

            const formattedDate = dateOfBirth.toLocaleDateString("en-MY", {
                year: "numeric",
                month: "long",
                day: "numeric",
            });

            // dateOfBirthOutput.textContent = formattedDate;
        }

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
            if(response['message'] != null){
                toastr.error(response['message']);
            }else{
                toastr.error('Something went wrong');
            }

            var errors = response.responseJSON.errors;

            $.each(errors, function(key, value) {
                if($('[name="'+key+'"]').attr('type') == 'radio' || $('[name="'+key+'"]').attr('type') == 'checkbox'){
                    if($('[name="'+key+'"]').find('.hasErr').length == 0){
                        $('[name="'+key+'"]').parent().append('<div class="hasErr text-danger col-12 fs-6">'+value[0]+'</div>');
                    }
                } else {
                    if($('[name="'+key+'"]').find('.hasErr').length == 0){
                        $('[name="'+key+'"]').parent().append('<div class="hasErr text-danger col-12 fs-6">'+value[0]+'</div>');
                    }
                }
            });

        }

    });
}


</script>


@endsection