@extends('backend.layouts.app')
@section('content')

@php

use App\Models\Staff;

$totalStaff = Staff::count();

@endphp



<style>
  .fc-view-container {
    background-color: grey;
  }
  .fc-day-header {
    background-color: steelblue;
  }

  .fc td.fc-today {
    background: slategray;
  }
  .fc-event {
    border: 1px solid #7c7c7c;
  }
  td {
    pointer-events: none;
  }
  .col-sm-10 {
    margin-top: 6px;
  }
  .fc-title {
    padding: 0 1px;
    white-space: normal;
  }

</style>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v2</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                <div class="info-box-content" title="Total Employees">
                  <span class="info-box-text">Employees</span>
                  <span class="info-box-number">{{$totalStaff}}</span>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-calendar-alt"></i></span>

              <div class="info-box-content" title="Total Events for the month">
                <span class="info-box-text">Events</span>
                <span class="info-box-number">{{$totalLeave}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-walking" style="color: #203250;"></i></span>

              <div class="info-box-content" title="Total Leaves for the month">
                <span class="info-box-text">Track Leaves</span>
                <span class="info-box-number">{{$totalLeave}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-birthday-cake"></i></span>

              <div class="info-box-content" title="Total staff celebrating birthdays this month">
                <span class="info-box-text">Birthdays</span>
                @if($totalBirthday > 0)
                <span class="info-box-number">{{$totalBirthday}} person</span>
                @else
                <span class="info-box-number">{{$totalBirthday}}</span>
                @endif
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Event Calendar</h5>

                <div class="card-tools">
                  <!-- <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i> -->
                  </button>
                  <!-- <div class="btn-group">
                    <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                      <i class="fas fa-wrench"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                      <a href="#" class="dropdown-item">Action</a>
                      <a href="#" class="dropdown-item">Another action</a>
                      <a href="#" class="dropdown-item">Something else here</a>
                      <a class="dropdown-divider"></a>
                      <a href="#" class="dropdown-item">Separated link</a>
                    </div>
                  </div> -->
                  <!-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button> -->
                </div>
              </div>
              <!-- /.card-header -->
              <div style="margin-left: 100px; margin-right: 100px;" class="card-body">
                <div class="form-group row">
                  <label for="" style="max-width: 125px;" class="col-sm-2 col-form-label">Leave Legend :</label>
                  <div class="col-sm-10">
                    <span class="right badge badge-info">Waiting Approval</span>&emsp;
                    <span class="right badge badge-success">Approved</span>&emsp;
                    <span class="right badge badge-danger">Rejected</span>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div id='full_calendar_events'></div>
                  </div>
                </div>
                <!-- /.row -->
              </div>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Main row -->
        <div class="row">
        
        </div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>

 

  <!-- Announcment Modal -->

  <div class="modal fade" id="announcementModal" tabindex="-1" role="dialog" aria-labelledby="announcementModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Modal body text goes here.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
    // Check for the loginSuccess parameter and call openModal if present
    @if(session('loginSuccess'))
        @php
            // Unset the loginSuccess session variable to ensure the modal is shown only once
            session()->forget('loginSuccess');
        @endphp

        window.onload = function () {
            $('#announcementModal').modal('show');
        };
    @endif
</script>

  <script>
  
  console.log('js loaded');
  function openModal() {
        document.getElementById('announcementModal').style.display = 'block';
    }

    $(document).ready(function () {

            var SITEURL = "{{ url('/') }}";
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var calendar = $('#full_calendar_events').fullCalendar({
                editable: false,
                events: SITEURL + "/calendar-event",
                displayEventTime: true,
                height: 800,
                eventRender: function (event, element, view) {
                  console.log(event);
                  element.find('.fc-title').append(" - " + event.leave_type);
                  if(event.status_id == 6){
                    element.css('background-color', '#21ae00');
                  }
                  if(event.status_id == 8){
                    element.css('background-color', '#dc3545');
                  }
                  if(event.status_id == 5){
                    element.css('background-color', '#17a2b8');
                  }
                    
                  event.allDay = true; // Set allDay property to true for all events
                },
                selectable: false,
                selectHelper: false,
            });
        });

        function displayMessage(message) {
            toastr.success(message, 'Event');            
        }
  </script>

  @endsection