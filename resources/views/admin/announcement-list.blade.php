@extends('backend.layouts.app')
@section('content')

<style>
     .delete{
        padding-left: 10px;
        padding-right: 10px;
    }
    .view_form .image img {
        width: 300px;
        height: auto;
    }
</style>

<div class="content-wrapper">
    <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Announcement</h1><br>
            </div>
            <div class="col-sm-6">
            <div id="response" style="float: right;" role="alert"></div>
            </div>
            <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                <div class="card">
                    <div style="display: inline-flex;" class="card-header">
                    <h3 class="card-title col-md-10">List of Announcements</h3>
                    <a href="{{route ('admin.announcement-create')}}" class="btn btn-success btn-sm" role="button" style="width: 100%;" title="Create new announcement"><i class="fa fa-plus"></i> Announcement</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">No.</th>
                                <th style="width: 50%">Title</th>
                                <th>Created By</th>
                                <th>Created At</th>
                                <th>Status</th>
                                <th style="width: 140px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($announcementList) == 0)
                            <tr>
                                <td colspan="6" style="text-align: center;"><p><i class="fas fa-info-circle"></i> No record was found.</p></td>
                            </tr>
                            @endif
                            @foreach ($announcementList as $announcement)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$announcement->title}}</td>
                                <td>{{$announcement->hasCreatedBy->name}}</td>
                                <td>{{\Carbon\Carbon::parse($announcement->created_at)->format('d-m-Y')}}</td>
                                @if($announcement->status_id == 2)
                                <td><span style="font-size: 90%;" class="right badge badge-success">{{$announcement->hasStatus->desc}}</span></td>
                                @else
                                <td><span style="font-size: 90%;" class="right badge badge-danger">{{$announcement->hasStatus->desc}}</span></td>
                                @endif
                                <td>
                                    <div class="row">
                                        <div class="col-4">
                                            <button type="button" class="btn btn-primary btn-sm view" title="View" 
                                            data-toggle="modal" data-target="#viewModal" data-id="{{$announcement->id}}"><i class="fa fa-eye"></i></button>
                                        </div>
                                        <div class="col-4">
                                            <a href="{{route('admin.announcement-edit',['id' => $announcement->id])}}" class="btn btn-success btn-sm edit" role="button" title="Edit"><i class="fas fa-edit"></i></a>
                                        </div>
                                        <div class="col-4">
                                            <button type="button" class="btn btn-danger btn-sm remove" title="Remove" 
                                            data-toggle="modal" data-target="#removeModal" data-id="{{$announcement->id}}"><i class="fa fa-trash-alt"></i></button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            <!-- Modal -->
            <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">Announcement Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </div>
                <div class="modal-body" id="viewModalBody">
                    <label for="">Title</label>
                    <h5 class="view_form" id="view_title"></h5><hr>
                    <p class="view_form" id="view_body"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <!-- <button type="submit" class="btn btn-primary">Register</button> -->
                </div>
                </div>
            </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="removeModal" tabindex="-1" aria-labelledby="removeModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-exclamation-triangle"></i> Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </div>
                <div class="modal-body">
                <div class="card-body">
                <p class="login-box-msg"></p>
                <input type="hidden" id="id" value="">
                @csrf
                    <p>Are you sure you want to remove this announcement?</p>
                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="removeAnnouncement" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-trash-alt"></i> Remove</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <!-- <button type="submit" class="btn btn-primary">Register</button> -->
                </div>
                </div>
            </div>
            </div>

            <div class="card-footer clearfix">
                <div class="row">
                    <div class="col-sm-12 col-md-5">
                        <div class="dataTables_info" aria-live="polite">Showing {{$announcementList->firstItem()}} to {{$announcementList->firstItem()}} of {{$announcementList->total()}} entries</div>
                    </div>
                    <div class="col-sm-12 col-md-7">
                        <div class="dataTables_paginate paging_simple_numbers">
                            <ul class="pagination pagination m-0 float-right">
                                {{$announcementList->links()}}
                            </ul>
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

$(document).ready(function() {
    $('.view').on('click', function() {
        var announcementId = $(this).data('id');

        // AJAX request to fetch announcement details
        $.ajax({
        url: '{{ route("admin.announcement-details") }}', // Replace with your route
        method: 'GET',
        data: { id: announcementId },
        success: function(response) {
            // Update modal content with fetched data
            // $('#viewModalBody').html(response);
            $('.view_form').html("");
            $('#view_title').html(response[0].title);
            $('#view_body').html(response[0].body);
        },
        error: function() {
            alert('Error fetching announcement details.');
        }
        });
    });
});

$(".remove").click(function(){
    var data = $(this).attr("data-id"); //GET THE DATA IN ATTR
    event.preventDefault();
    console.log(data);
    $(".modal-body #id").val(data);
    console.log('click');
})

$("#removeAnnouncement").click(function(){
    var announcementID = document.getElementById("id").value;
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    
    $.ajax({
        url: "{{ route('admin.announcement-delete') }}?id=" + announcementID,
        type: 'delete',
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        cache: false,
        contentType: false,
        processData: false,
        method: 'DELETE',
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
    console.log('removing announcement with id:',announcementID);
})

</script>

@endsection