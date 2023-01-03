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
                <div class="col-md-12">
                <div class="card">
                    <div style="display: inline-flex;" class="card-header">
                    <h3 class="card-title col-md-11">List of staff leave entitlement (Days)</h3>
                    <!-- <button type="button" class="btn btn-success btn-block btn-sm" title="Register new staff" data-toggle="modal" data-target="#registerModal">
                        <i class="fa fa-plus"></i> Staff</button> -->
                </div>
                <div class="card-body">
                <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">No.</th>
                                <th>Name</th>
                                <th>Annual</th>
                                <th>Sick</th>
                                <th>Paternity</th>
                                <th>Maternity</th>
                                <th>Marriage</th>
                                <th>Compassionate</th>
                                <th>Unpaid</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($staffList as $staff)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$staff->fullname}}</td>
                                <td>{{$staff->hasLeaveEntitlement->annual_leave ?? '-'}}</td>
                                <td>{{$staff->hasLeaveEntitlement->sick_leave ?? '-'}}</td>
                                <td>{{$staff->hasLeaveEntitlement->paternity_leave ?? '-'}}</td>
                                <td>{{$staff->hasLeaveEntitlement->maternity_leave ?? '-'}}</td>
                                <td>{{$staff->hasLeaveEntitlement->marriage_leave ?? '-'}}</td>
                                <td>{{$staff->hasLeaveEntitlement->compassionate_leave ?? '-'}}</td>
                                <td>{{$staff->hasLeaveEntitlement->unpaid_leave ?? '-'}}</td>
                                <td>
                                <div class="row">
                                        <div class="col-4">
                                            <button type="button" class="btn btn-success btn-sm edit" title="Edit Entitlement" 
                                            data-toggle="modal" data-target="#leaveEntitlementModal" data-id="{{$staff->id}}"><i class="fa fa-edit"></i></button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal fade" id="leaveEntitlementModal" tabindex="-1" aria-labelledby="leaveEntitlementModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="leaveEntitlementModalLabel">Leave Entitlement</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </div>
                <div class="modal-body">
                <div class="card-body">
                <p class="login-box-msg"></p>
                
                <form id="leave_entitlement">
                    @csrf
                    <input type="hidden" id="staff_id" name="staff_id" value="">
                    <div class="form-group row">
                        <label for="" class="col-sm-6 col-form-label">Annual Leave :</label>
                        <div class="col-sm-4">
                        <input type="text" class="form-control" name="annual_leave" id="annual_leave" 
                        oninput="this.value = this.value.replace(/[^0-9.]/g, '');">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-6 col-form-label">Sick Leave :</label>
                        <div class="col-sm-4">
                        <input type="text" class="form-control" name="sick_leave" id="sick_leave" 
                        oninput="this.value = this.value.replace(/[^0-9.]/g, '');">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-6 col-form-label">Paternity Leave :</label>
                        <div class="col-sm-4">
                        <input type="text" class="form-control" name="paternity_leave" id="paternity_leave" 
                        oninput="this.value = this.value.replace(/[^0-9.]/g, '');">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-6 col-form-label">Maternity Leave :</label>
                        <div class="col-sm-4">
                        <input type="text" class="form-control" name="maternity_leave" id="maternity_leave" 
                        oninput="this.value = this.value.replace(/[^0-9.]/g, '');">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-6 col-form-label">Marriage Leave :</label>
                        <div class="col-sm-4">
                        <input type="text" class="form-control" name="marriage_leave" id="marriage_leave" 
                        oninput="this.value = this.value.replace(/[^0-9.]/g, '');">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-6 col-form-label">Compassionate Leave :</label>
                        <div class="col-sm-4">
                        <input type="text" class="form-control" name="compassionate_leave" id="compassionate_leave" 
                        oninput="this.value = this.value.replace(/[^0-9.]/g, '');">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-6 col-form-label">Unpaid Leave :</label>
                        <div class="col-sm-4">
                        <input type="text" class="form-control" name="unpaid_leave" id="unpaid_leave" 
                        oninput="this.value = this.value.replace(/[^0-9.]/g, '');">
                        </div>
                    </div>
                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
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

$(".edit").click(function() {
  
  var data = $(this).attr("data-id"); // GET THE DATA IN ATTR
  event.preventDefault();
  console.log(data);
  $(".modal-body #staff_id").val(data);

  var url = '{{ route("staff.getStaffDetail", "data=staff_id") }}';
    url = url.replace('staff_id', data);

    $.ajax({
        url: url,
        type: 'get',
        dataType: 'json',
        success: function(response) {
            if (response) {
                console.log(response);
                // $('.view_form').html("");
                // $('#viewModalLabel').html("View "+response[0].fullname);
                $('#annual_leave').val(response[0].has_leave_entitlement.annual_leave);
                $('#sick_leave').val(response[0].has_leave_entitlement.sick_leave);
                $('#paternity_leave').val(response[0].has_leave_entitlement.paternity_leave);
                $('#maternity_leave').val(response[0].has_leave_entitlement.maternity_leave);
                $('#marriage_leave').val(response[0].has_leave_entitlement.marriage_leave);
                $('#compassionate_leave').val(response[0].has_leave_entitlement.compassionate_leave);
                $('#unpaid_leave').val(response[0].has_leave_entitlement.unpaid_leave);
            }else{
                // $('#staff_id').val(response[0].id);
                // $('#nama_pegawai').html(response[0].name);
                // $('#penempatan_semasa').html('TIADA');
            }
        }
    });

});

function submitLeaveEntitlement(data) {
    $('#leaveEntitlementModal').modal('hide');
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
            setTimeout(function (){
                window.location = response['url'];
            }, 3000);
        },
        error: function(response) {

        }

    });
}

</script>

@endsection