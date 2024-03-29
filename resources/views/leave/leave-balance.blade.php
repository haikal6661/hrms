@extends('backend.layouts.app')
@section('content')

@php
$user_role = auth()->user()->roles->first()->name;
@endphp

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
                    @role('Admin')
                    <h3 class="card-title col-md-11">List of staff leave balance (Days)</h3>
                    @else
                    <h3 class="card-title col-md-11">Leave balance (Days)</h3>
                    @endrole
                    <!-- <button type="button" class="btn btn-success btn-block btn-sm" title="Register new staff" data-toggle="modal" data-target="#registerModal">
                        <i class="fa fa-plus"></i> Staff</button> -->
                </div>
                <div class="card-body">
                @if($user_role == "User")
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group row" style="margin-bottom: 0px;">
                                <label for="">&ensp;&nbsp; Name :</label>
                                <p>&nbsp; {{$detail->fullname}}</p>
                            </div>
                            <div class="form-group row" style="margin-bottom: 0px;">
                                <label for="">&ensp;&nbsp; Email :</label>
                                <p>&nbsp; {{$detail->email}}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row" style="margin-bottom: 0px;">
                                <label for="">&ensp;&nbsp; Position :</label>
                                <p>&nbsp; {{$detail->hasPosition->desc}}</p>
                            </div>
                            <div class="form-group row" style="margin-bottom: 0px;">
                                <label for="">&ensp;&nbsp; Department :</label>
                                <p>&nbsp; {{$detail->hasDepartment->desc}}</p>
                            </div>
                        </div>
                    </div>
                    <hr>
                    @forelse($balance->chunk(3) as $chunk)
                        <div class="row">
                            @foreach($chunk as $leave)
                            <div class="form-group col-md-4">
                                <div class="col-md-6">
                                    <label for="">{{$leave->hasLeaveName->desc}} :</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" name="leave[{{$leave->leave_type_id}}]" id="{{$leave->id}}" value="{{$leave->balance}}" disabled>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @empty
                        <h4>No leaves entitled yet.</h4>
                    @endforelse
                @else
                <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">No.</th>
                                <th>Name</th>
                                <th>Leaves</th>
                                @can('update leave balance')
                                <th>Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($staffList) == 0)
                            <tr>
                                <td colspan="4" style="text-align: center;"><p><i class="fas fa-info-circle"></i> No record was found.</p></td>
                            </tr>
                            @endif
                            @foreach($staffList as $staff)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$staff->fullname}}</td>
                                <td>
                                    <div class="row">
                                    @php
                                        $refleavetypes = $refleavetype->chunk(3);
                                    @endphp
                                    @for($i=0; $i < count($refleavetypes); $i++)
                                        <div class="col">
                                        @foreach($refleavetypes[$i] as $leavetype)
                                            <li>{{$leavetype->desc}} = 
                                            @foreach ($staff->hasLeave as $balance)
                                                @if($balance->leave_type_id == $leavetype->id)
                                                    {{$balance->balance ?? '0'}}
                                                @endif
                                            @endforeach
                                            </li>
                                        @endforeach
                                        </div>
                                    @endfor
                                    </div>
                                </td>
                                @can('update leave balance')
                                <td>
                                <div class="row">
                                        <div class="col-4">
                                            <a href="{{route('leave.leave-balance-edit', ['id' => $staff->id])}}" role="button" class="btn btn-success btn-sm" title="Edit Balance"><i class="fa fa-edit"></i></a>
                                        </div>
                                    </div>
                                </td>
                                @endcan
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
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
                    @foreach($refleavetype as $leave)
                    <div class="form-group row">
                        <label for="" class="col-sm-6 col-form-label">{{$leave->desc}} :</label>
                        <div class="col-sm-4">
                        @foreach ($staffList as $key => $staff)
                            @foreach ($staff->hasLeave as $entitlement)
                            @if($leave->id == $entitlement->id)
                            <input type="text" class="form-control" name="leave[{{$leave->id}}]" id="{{$leave->id}}" value="{{$entitlement->entitlement}}"
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '');">
                            @endif
                            @endforeach
                        @endforeach
                        </div>
                    </div>
                    @endforeach
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
            <div class="card-footer clearfix">
                @role('Admin')
                <div class="row">
                    <div class="col-sm-12 col-md-5">
                        <div class="dataTables_info" aria-live="polite">Showing {{$staffList->firstItem()}} to {{$staffList->lastItem()}} of {{$staffList->total()}} entries</div>
                    </div>
                    <div class="col-sm-12 col-md-7">
                        <div class="dataTables_paginate paging_simple_numbers">
                            <ul class="pagination pagination m-0 float-right">
                                {{$staffList->links()}}
                            </ul>
                        </div>
                    </div>
                </div>
                @endrole
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