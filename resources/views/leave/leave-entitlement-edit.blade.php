@extends('backend.layouts.app')
@section('content')

<div class="content-wrapper">
    <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Leave</h1><br>
            </div>
            <div class="col-sm-6">
            <div id="response" style="float: right;" role="alert"></div>
            </div>
            <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                <div class="card">
                    <div style="display: inline-flex;" class="card-header">
                    <h3 class="card-title col-md-11">Edit Staff Entitlement</h3>
                    <!-- <button type="button" class="btn btn-success btn-block btn-sm" title="Register new staff" data-toggle="modal" data-target="#registerModal">
                        <i class="fa fa-plus"></i> Staff</button> -->
                </div>
                <div class="card-body">
                <form id="leave_entitlement">
                    @csrf
                <input type="hidden" id="staff_id" name="staff_id" value="{{$detail->id}}">
                @forelse($entitlement as $leave)
                <div class="row">
                <div class="form-group col-md-4">
                    <div class="col-md-6">
                        <label for="">{{$leave->hasLeaveName->desc}} :</label>
                        <div class="input-group">
                            <input class="form-control" type="text" name="leave[{{$leave->leave_type_id}}]" id="{{$leave->id}}" value="{{$leave->entitlement}}">
                        </div>
                    </div>
                </div>
                </div>
                @empty
                @foreach($refleavetype as $leave)
                <div class="row">
                <div class="form-group col-md-4">
                    <div class="col-md-6">
                        <label for="">{{$leave->desc}} :</label>
                        <div class="input-group">
                            <input class="form-control" type="text" name="leave[{{$leave->leave_type_id}}]" id="{{$leave->id}}" value="">
                        </div>
                    </div>
                </div>
                </div>
                @endforeach
                @endforelse
                </div>
                <div class="card-footer clearfix">
                    <button type="submit" style="width: 100px;" class="btn btn-block btn-primary"><i class="fas fa-save"></i>
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

    $('#leave_entitlement').on('submit', function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        // ('#frm_register .hasError').html('');
        submitLeaveEntitlement(formData);

    });

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

    function submitLeaveEntitlement(data) {
    console.log("hehe");
    $.ajax({
        url: "{{ route('leave.leave-entitlement-store') }}",
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
            // setTimeout(function (){
            //     window.location = response['url'];
            // }, 3000);
        },
        error: function(response) {

        }

    });
}


</script>


@endsection