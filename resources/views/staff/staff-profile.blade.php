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
                                
                                @if($staff->image_path)
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
                            <p>Note : Contact your admin if there is any changes to this details.</p>
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

    $('#blah').click(function(){
        $('#imgInp').click();
    })


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