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
                    <h3 class="card-title col-md-11">List of staff leave application</h3>
                    <!-- <button type="button" class="btn btn-success btn-block btn-sm" title="Register new staff" data-toggle="modal" data-target="#registerModal">
                        <i class="fa fa-plus"></i> Staff</button> -->
                </div>
                <div class="card-body">
                <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">No.</th>
                                <th>Name</th>
                                <th>Leave Type</th>
                                <th>Date (From)</th>
                                <th>Date (To)</th>
                                <th>No of Days</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($leave_application as $application)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$application->hasStaff->fullname}}</td>
                                <td>{{$application->hasLeaveName->desc}}</td>
                                <td>{{Carbon\Carbon::parse($application->start_date)->format('d/m/Y')}}</td>
                                <td>{{Carbon\Carbon::parse($application->end_date)->format('d/m/Y')}}</td>
                                <td>{{$application->no_of_days}}</td>
                                <td>{{$application->hasStatus->desc}}</td>
                                {{-- <td>
                                    <div class="col">
                                    @for($i=0; $i < count($refleavetype); $i++)
                                        &nbsp;{{$refleavetype[$i]->desc}} = 
                                        @foreach ($staff->hasLeave as $balance)
                                            @if($balance->leave_type_id == $refleavetype[$i]->id)
                                            {{$balance->balance ?? '0'}}
                                            @endif
                                        @endforeach
                                    @endfor
                                    </div>
                                </td> --}}
                                <td>
                                <div class="row">
                                        <div class="col-4">
                                            <a href="{{route('leave.leave-balance-edit', ['id' => $application->id])}}" role="button" class="btn btn-success btn-sm" title="Edit Balance"><i class="fa fa-edit"></i></a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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

$('#leave_balance').on('submit', function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        // ('#frm_register .hasError').html('');
        submitLeaveBalance(formData);

    });
});

$(".edit").click(function() {
  
  var data = $(this).attr("data-id"); // GET THE DATA IN ATTR
  event.preventDefault();
  console.log(data);
  $(".modal-body #staff_id").val(data);

//   var url = '{{ route("staff.getStaffDetail", "data=staff_id") }}';
//     url = url.replace('staff_id', data);

//     $.ajax({
//         url: url,
//         type: 'get',
//         dataType: 'json',
//         success: function(response) {
//             if (response) {
//                 console.log(response);
//                 // $('.view_form').html("");
//                 // $('#viewModalLabel').html("View "+response[0].fullname);
//                 $('#annual_leave').val(response[0].has_leave_entitlement.annual_leave);
//                 $('#sick_leave').val(response[0].has_leave_entitlement.sick_leave);
//                 $('#paternity_leave').val(response[0].has_leave_entitlement.paternity_leave);
//                 $('#maternity_leave').val(response[0].has_leave_entitlement.maternity_leave);
//                 $('#marriage_leave').val(response[0].has_leave_entitlement.marriage_leave);
//                 $('#compassionate_leave').val(response[0].has_leave_entitlement.compassionate_leave);
//                 $('#unpaid_leave').val(response[0].has_leave_entitlement.unpaid_leave);
//             }else{
//                 // $('#staff_id').val(response[0].id);
//                 // $('#nama_pegawai').html(response[0].name);
//                 // $('#penempatan_semasa').html('TIADA');
//             }
//         }
//     });

});

function submitLeaveBalance(data) {
    $('#leaveEntitlementModal').modal('hide');
    console.log("hehe");
    $.ajax({
        url: "{{ route('leave.leave-balance-store') }}",
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