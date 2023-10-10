@extends('backend.layouts.app')
@section('content')

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
            <h1 class="m-0">Notifications</h1>
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
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">You have {{auth()->user()->unreadNotifications->count()}} <i class="fas fa-envelope mr-2"></i> unread notification.</h5>
              </div><br>
              <!-- /.card-header -->
              <div style="margin-left: 100px; margin-right: 100px;">
              @foreach (auth()->user()->unreadNotifications as $notification)
              <div class="card">
              <div class="card-body">
                    <!-- <h5 class="card-title">Special title treatment</h5> -->
                    <p class="card-text text-primary">{{$notification->data['data']}}</p>
                    <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                </div>
                <div class="card-footer text-muted">
                    {{$notification->created_at->diffForHumans()}}
                </div>
              </div>
              @endforeach
                
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

  <script>
    $(document).ready(function () {

        });
  </script>

  @endsection