@extends('backend.layouts.app')
@section('content')

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
                                    <h3 class="card-title col-md-11">Request a Leave</h3>
                                </div>
                                <div class="card-body">
                                <form id="leave_form">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <div class="col-md-12">
                                                <label for="start_date"><span style="color: red;">*</span>Start Date :</label>
                                                <div class="input-group date" id="start_date">
                                                <input type="text" class="form-control" id="input_start_date" required>
                                                <input type="hidden" class="form-control" id="get_start_date" name="get_start_date">
                                                <div class="input-group-append">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <div class="col-md-12">
                                                <label for="end_date"><span style="color: red;">*</span>End Date :</label>
                                                <div class="input-group date" id="end_date">
                                                <input type="text" class="form-control" id="input_end_date" required>
                                                <input type="hidden" class="form-control" id="get_end_date" name="get_end_date">
                                                <div class="input-group-append">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <div class="col-md-12">
                                                <label for="">No of Days :</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="no_of_days" id="no_of_days" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <div class="col-md-12">
                                            <label for=""><span style="color: red;">*</span>Leave Type :</label>
                                            <div class="input-group">
                                                <select class="form-control select2" name="leave_type_id" id="leave_type_id">
                                                    <option selected="selected" value="">Please select leave type...</option>
                                                    @foreach ($refleavetype as $leavetype)
                                                    <option value="{{$leavetype->id}}">{{$leavetype->desc}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                    <span class="fas fa-minus-circle"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-5">
                                            <div class="col-md-12">
                                            <label for="">Reason :</label>
                                            <textarea name="reason" class="form-control" rows="4"></textarea>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <div class="card-footer clearfix">
                                    <button type="button" style="width: 100px;" class="btn btn-block btn-success" onclick="submitLeave({{$detail->id}})"><i class="fas fa-save"></i>
                                    Apply</button>
                                </div>
                            </div>
                            </form>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div style="display: inline-flex;" class="card-header">
                                    <h3 class="card-title col-md-11">Leave Balance</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-5">
                                            <label for="start_date">Annual Leave :</label>
                                            <input type="text" class="form-control" name="annual_leave" value="{{$detail->hasLeaveBalance->annual_leave}}" disabled>
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label for="start_date">Sick Leave :</label>
                                            <input type="text" class="form-control" name="sick_leave" value="{{$detail->hasLeaveBalance->sick_leave}}" disabled>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-5">
                                            <label for="start_date">Paternity Leave :</label>
                                            <input type="text" class="form-control" name="paternity_leave" value="{{$detail->hasLeaveBalance->paternity_leave}}" disabled>
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label for="start_date">Maternity Leave :</label>
                                            <input type="text" class="form-control" name="maternity_leave" value="{{$detail->hasLeaveBalance->maternity_leave}}" disabled>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-5">
                                            <label for="start_date">Marriage Leave :</label>
                                            <input type="text" class="form-control" name="marriage_leave" value="{{$detail->hasLeaveBalance->marriage_leave}}" disabled>
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label for="start_date">Compassionate Leave :</label>
                                            <input type="text" class="form-control" name="compassionate_leave" value="{{$detail->hasLeaveBalance->compassionate_leave}}" disabled>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-5">
                                            <label for="start_date">Unpaid Leave :</label>
                                            <input type="text" class="form-control" name="unpaid_leave" value="{{$detail->hasLeaveBalance->unpaid_leave}}" disabled>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="leaveModal" tabindex="-1" aria-labelledby="leaveModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                    <h4 class="modal-title">Request Confirmation</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <form id="leave_appr">
                            @csrf
                        <p><i class="fas fa-info-circle"></i> Are you sure you want to submit this leave form?</p>
                    </div>
                        <div class="modal-footer">
                            <input type="hidden" name="staff_id" id="staff_id">
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
</div>

<script type="text/javascript">


function submitLeave(id){
        $('#staff_id').val(id);
        console.log(id);
        $('#leaveModal').modal("show");
    }

    $('#leave_appr').on('submit', function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        submitLeaveForm(formData);

    });

    function submitLeaveForm(data) {

        $('#leaveModal').modal("hide");
        let formData = new FormData(document.getElementById('leave_form'));
        formData.append("staff_id", $('#staff_id').val());
        $('#leave_form .hasErr').html('');
        // parent.startLoading();
        $.ajax({
            url: "{{ route('leave.leave-application') }}",
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
                toastr.error('Something went wrong');

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

$(document).ready(function(){
//Date picker
$('#start_date').datepicker({
        autoclose: true,
        todayHighlight: 1,
        format: 'dd/mm/yyyy',
        // startDate: new Date(),
        // endDate: new Date(),
        }).on('change', function(ev){
            var start_date = $('#input_start_date').val();
            $('[name="get_start_date"]').val(start_date);
            showDays();
            // console.log(start_date);
        });


$('#end_date').datepicker({
    autoclose: true,
    todayHighlight: 1,
    format: 'dd/mm/yyyy',
    // startDate: new Date(),
    // endDate: new Date(),
    }).on('change', function(ev){
            var end_date = $('#input_end_date').val();
            $('[name="get_end_date"]').val(end_date);
            showDays();
            // console.log(start_date);
        });


});

function showDays(){
    var start = $('#get_start_date').val();
    var end = $('#get_end_date').val();
    if(!start || !end) return;
    start = new Date(start.split('/')[2],start.split('/')[1]-1,start.split('/')[0]);
    end = new Date(end.split('/')[2],end.split('/')[1]-1,end.split('/')[0]);
    
    var diffTime = Math.abs(end - start);
    var days = Math.ceil(diffTime/(1000*60*60*24));
    $('#no_of_days').val(days+1);
    
}



</script>

@endsection