@extends('backend.layouts.app')
@section('content')

<style>
    p {
        margin-top: 6px;
    }


    .col-sm-2 {
        max-width: 15%;
    }

    .form-group {
        margin-bottom: 0px;
    }

    .custom-control {
        margin-top: 8px;
    }
    .col-sm-4 {
        margin-top: 12px;
    }

    #loading-overlay {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  z-index: 9999;
}

.loader, .loader:before, .loader:after {
  border-radius: 50%;
  width: 2.5em;
  height: 2.5em;
  animation-fill-mode: both;
  animation: bblFadInOut 1.8s infinite ease-in-out;
  position: absolute;
  top: 50%;
  left: 50%;
  margin-top: -1.25em;
  margin-left: -0.25em;
}

.loader {
  color: #FFF;
  font-size: 7px;
  text-indent: -9999em;
  transform: translateZ(0);
  animation-delay: -0.16s;
}

.loader:before,
.loader:after {
  content: '';
  position: absolute;
  top: 8px;
}

.loader:before {
  left: -3.5em;
  animation-delay: -0.32s;
}

.loader:after {
  left: 3.5em;
}

@keyframes bblFadInOut {
  0%, 80%, 100% { box-shadow: 0 2.5em 0 -1.3em }
  40% { box-shadow: 0 2.5em 0 0 }
}


</style>

<div id="loading-overlay">
  <div class="loader"></div>
</div>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Leaves</h1><br>
                </div>
                <div class="col-sm-6">
                    <div id="response" style="float: right;" role="alert"></div>
                </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div style="display: inline-flex;" class="card-header">
                                    <h3 class="card-title col-md-11">Leave Request Detail</h3>
                                </div>
                                <div class="card-body">
                                <form id="leave_form_approval">
                                    @csrf
                                    @php
                                    $staff_id = $detail->hasStaff->id;
                                    @endphp
                                    <input type="hidden" name="staff_id" value="{{$staff_id}}">
                                    <div class="form-group row">
                                        <label for="" class="col-sm-2 col-form-label">Name :</label>
                                        <div class="col-10">
                                        <p>{{$detail->hasStaff->fullname}}</p>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-2 col-form-label">Position :</label>
                                        <div class="col-sm-10">
                                        <p>{{$detail->hasStaff->hasPosition->desc}}</p>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-2 col-form-label">Leave Type :</label>
                                        <div class="col-sm-10">
                                        <p>{{$detail->hasLeaveName->desc}}</p>
                                        <input type="hidden" name="leave_type_id" value="{{$detail->leave_type_id}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-2 col-form-label">Date(From) :</label>
                                        <div class="col-sm-10">
                                        <p>{{Carbon\Carbon::parse($detail->start_date)->format('d/m/Y')}}</p>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-2 col-form-label">Date(To) :</label>
                                        <div class="col-sm-10">
                                        <p>{{Carbon\Carbon::parse($detail->end_date)->format('d/m/Y')}}</p>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-2 col-form-label">No of days :</label>
                                        <div class="col-sm-10">
                                        <p>{{$detail->no_of_days}}</p>
                                        <input type="hidden" name="no_of_days" value="{{$detail->no_of_days}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-2 col-form-label">Reason :</label>
                                        <div class="col-sm-10">
                                        <p>{{$detail->reason ?? '-'}}</p>
                                        </div>
                                    </div>
                                    @if(Auth::user()->hasRole('Admin') || Auth::user()->hasStaff->is_supervisor == 1)
                                    <hr>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-2 col-form-label">Status :</label>
                                    @if($detail->status_id == 5)
                                    <div class="custom-control custom-radio">
                                        <div class="col-4">
                                        <input class="custom-control-input" type="radio" id="result1" value="1" name="approval">
                                        <label for="result1" class="custom-control-label">Approve</label>
                                        </div>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <div class="col-4">
                                        <input class="custom-control-input" type="radio" id="result2" value="0" name="approval">
                                        <label for="result2" class="custom-control-label">Reject</label>
                                        </div>
                                    </div>
                                    @else
                                    <div class="col-sm-10">
                                        <p>{{$detail->hasStatus->desc}}</p>
                                    </div>
                                    @endif
                                    </div>
                                    <div class="form-group row" id="approval" style="display: none;">
                                        <label for="" class="col-sm-2 col-form-label">Remarks :</label>
                                        <div class="col-sm-4">
                                        <textarea name="supervisor_remark" class="form-control" rows="4"></textarea>
                                        </div>
                                    </div>
                                </div>
                                @if($detail->status_id == 5)
                                <div class="card-footer clearfix">
                                    <button type="button" style="width: 100px;" id="appr_btn" class="btn btn-block btn-success" onclick="submitLeaveApproval({{$detail->id}})" disabled></i>
                                    Submit</button>
                                </div>
                                @endif
                                @else
                                <hr>
                                <div class="form-group row">
                                    <div style="display: flex;" class="col-md-6">
                                    <label style="margin-top: 1px;" for="" class="col-sm-4 col-form-label">Status :</label>
                                    <div style="padding-top: 8px;" class="col-sm-8">
                                    @if($detail->status_id == '6')
                                    <span style="font-size: 90%;" class="right badge badge-success">{{$detail->hasStatus->desc}}</span>
                                    @elseif($detail->status_id == '5')
                                    <span style="font-size: 90%;" class="right badge badge-info">{{$detail->hasStatus->desc}}</span>
                                    @else
                                    <span style="font-size: 90%;" class="right badge badge-danger">{{$detail->hasStatus->desc}}</span>
                                    @endif
                                    </div>
                                    </div>
                                </div>
                                @if($detail->status_id == '6')
                                <div class="form-group row">
                                    <div style="display: flex;" class="col-md-6">
                                    <label style="margin-top: 1px;" for="" class="col-sm-4 col-form-label">Approved By :</label>
                                    <div style="padding-top: 4px;" class="col-sm-8">
                                        <p>{{$detail->hasApproval->fullname}}</p>
                                    </div>
                                    </div>
                                    <div style="display: flex;" class="col-md-6">
                                    <label style="margin-top: 1px;" for="" class="col-sm-4 col-form-label">Approved On :</label>
                                    <div style="padding-top: 4px;" class="col-sm-8">
                                        <p>{{$detail->updated_at->format('d/m/Y')}}</p>
                                    </div>
                                    </div>
                                </div>
                                @else($detail->status_id == '8')
                                <div class="form-group row">
                                    <div style="display: flex;" class="col-md-6">
                                    <label style="margin-top: 1px;" for="" class="col-sm-4 col-form-label">Remarks :</label>
                                    <div style="padding-top: 4px;" class="col-sm-8">
                                        <p>{{$detail->supervisor_remark}}</p>
                                    </div>
                                    </div>
                                </div>
                                @endif
                                @endif
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="leaveModalApprove" tabindex="-1" aria-labelledby="leaveModalApproveLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                    <h4 class="modal-title">Approval Confirmation</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <form id="leave_approval">
                            @csrf
                        <p><i class="fas fa-info-circle"></i> Are you sure you want to submit this leave approval?</p>
                    </div>
                        <div class="modal-footer">
                            <input type="hidden" name="leave_id" id="leave_id">
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
</div>

<script type="text/javascript">

$(document).ready(function() {
    $("input[name$='approval']").click(function() {
        var approval = $(this).val();

        if(approval == 1){
            $('#approval').hide();
            document.querySelector('#appr_btn').disabled = false;
        }else{
            $('#approval').show();
            document.querySelector('#appr_btn').disabled = false;
        }

        // $("div.desc").hide();
        // $("#Cars" + test).show();
    });
});

function submitLeaveApproval(id){
        $('#leave_id').val(id);
        console.log(name);
        $('#leaveModalApprove').modal("show");
    }

    $('#leave_approval').on('submit', function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        submitApproval(formData);

    });

function submitApproval(data) {

$('#leaveModalApprove').modal("hide");
let formData = new FormData(document.getElementById('leave_form_approval'));
formData.append("leave_id", $('#leave_id').val());
$('#leave_form_approval .hasErr').html('');
// parent.startLoading();

showLoadingOverlay();
$.ajax({
    url: "{{ route('leave.leave-approval') }}",
    type: 'post',
    data: formData,
    cache: false,
    contentType: false,
    processData: false,
    method: 'POST',
    success: function(response) {
        hideLoadingOverlay();
        console.log(response);
            toastr.success(response['message']);
        // $('#response').html('<span class="text-success">'+response.message+'</span>').fadeIn(500).fadeOut(5000);
        setTimeout(function (){
                window.location = response['url'];
            }, 3000);
    },
    error: function(response) {
        hideLoadingOverlay();
        toastr.error('Something went wrong');

        var errors = response.responseJSON.errors;
        console.log(response.responseJSON);

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

function showLoadingOverlay() {
    // You can implement this function to show your loading overlay
    // For example, display an overlay with a spinner
    $('#loading-overlay').show();
}

function hideLoadingOverlay() {
    // You can implement this function to hide your loading overlay
    // For example, hide the overlay
    $('#loading-overlay').hide();
}

</script>


@endsection