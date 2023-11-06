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
</style>

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
                                        <p>{{auth()->user()->hasStaff->hasSupervisor->fullname}}</p>
                                    </div>
                                    </div>
                                    <div style="display: flex;" class="col-md-6">
                                    <label style="margin-top: 1px;" for="" class="col-sm-4 col-form-label">Approved On :</label>
                                    <div style="padding-top: 4px;" class="col-sm-8">
                                        <p>{{$detail->updated_at->format('d/m/Y')}}</p>
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
$.ajax({
    url: "{{ route('leave.leave-approval') }}",
    type: 'post',
    data: formData,
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

</script>


@endsection