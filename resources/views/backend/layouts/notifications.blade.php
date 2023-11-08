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
              <div class="row">
                  <div class="col-md-8">
                  <h5 class="card-title">You have {{ auth()->user()->unreadNotifications->count() }} <i class="fas fa-envelope mr-2"></i>unread notification.</h5>
                  </div>
                  <div class="col-md-2">
                    <button class="btn btn-block btn-primary" id="markAsReadButton"><i class="fas fa-envelope-open"></i> Mark as Read</button>
                  </div>
                  <div class="col-md-2">
                    <button class="btn btn-block btn-danger" id="deleteButton"><i class="fas fa-trash-alt"></i> Delete</button>
                  </div>
              </div>
          </div><br>
              <!-- /.card-header -->
              <div style="margin-left: 100px; margin-right: 100px;">
              @foreach ($notificationList as $notification)
              <div class="card">
              <div style="padding-left: 40px;" class="card-body">
                    <input class="form-check-input" type="checkbox" name="notification[]" id="notification{{ $notification->id }}" value="{{ $notification->id }}" data-id="{{ $notification->id }}">
                    <!-- <h5 class="card-title">Special title treatment</h5> -->
                    <!-- <p class="card-text {{ $notification->read_at ? 'text-muted' : 'text-primary' }}">{{$notification->data['data']}}</p> -->
                    @if(isset($notification->data['route']))
                        <!-- <a class="card-text {{ $notification->read_at ? 'text-muted' : 'text-primary' }}" href="{{ $notification->data['route'] }}">{{ $notification->data['data'] }}</a> -->
                        <a class="card-text {{ $notification->read_at ? 'text-muted' : 'text-primary' }}" href="{{ route('notification.mark-as-read', ['notification' => $notification->id, 'route' => $notification->data['route']]) }}">
                {{ $notification->data['data'] }}
            </a>
                    @else
                        
                    @endif
                    <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                </div>
                <div class="card-footer text-muted">
                    {{$notification->created_at->diffForHumans()}}
                </div>
              </div>
              @endforeach
                
              </div>
              <div class="card-footer clearfix">
              <div class="row">
                    <div class="col-sm-12 col-md-5">
                        <div class="dataTables_info" aria-live="polite">Showing {{$notificationList->firstItem()}} to {{$notificationList->lastItem()}} of {{$notificationList->total()}} entries</div>
                    </div>
                    <div class="col-sm-12 col-md-7">
                        <div class="dataTables_paginate paging_simple_numbers">
                            <ul class="pagination pagination m-0 float-right">
                                {{$notificationList->links()}}
                            </ul>
                        </div>
                    </div>
                </div>
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

      const markAsReadButton = document.getElementById('markAsReadButton');
      const checkboxes = document.querySelectorAll('.form-check-input');

      markAsReadButton.addEventListener('click', function() {
        
          const selectedIds = [];

          checkboxes.forEach(checkbox => {
              if (checkbox.checked) {
                  selectedIds.push(checkbox.getAttribute('data-id'));
                  checkbox.checked = false; // Uncheck the checkbox
              }
          });

          if (selectedIds.length > 0) {

              $.ajax({
                url: "{{ route('notification.notification-read') }}",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // If you're using Laravel's CSRF protection
                },
                data: { selectedIds: selectedIds },
                method: 'POST',
                success: function(response) {
                    toastr.success(response['message']);
                    // $('#response').html('<span class="text-success">'+response.message+'</span>').fadeIn(500).fadeOut(5000);
                    setTimeout(function () {
                      window.location = response['url'];
                    }, 2000);
                    // parent.stopLoading();
                },
                error: function(response) {
                    toastr.error(response['message']);

                }

            });
              console.log('Marking as read:', selectedIds);
          }
      });

      deleteButton.addEventListener('click', function() {
        
        const selectedIds = [];

        checkboxes.forEach(checkbox => {
            if (checkbox.checked) {
                selectedIds.push(checkbox.getAttribute('data-id'));
                checkbox.checked = false; // Uncheck the checkbox
            }
        });

        if (selectedIds.length > 0) {

            $.ajax({
              url: "{{ route('notification.notification-delete') }}",
              headers: {
                  'X-CSRF-TOKEN': '{{ csrf_token() }}' // If you're using Laravel's CSRF protection
              },
              data: { selectedIds: selectedIds },
              method: 'DELETE',
              success: function(response) {
                  toastr.success(response['message']);
                  // $('#response').html('<span class="text-success">'+response.message+'</span>').fadeIn(500).fadeOut(5000);
                  setTimeout(function () {
                    window.location = response['url'];
                  }, 2000);
                  // parent.stopLoading();
              },
              error: function(response) {
                  toastr.error(response['message']);

              }

          });
            console.log('Marking as delete:', selectedIds);
        }
    });

});
  </script>

  @endsection