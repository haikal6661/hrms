@extends('backend.layouts.app')
@section('content')

<style>
     .delete{
        padding-left: 10px;
        padding-right: 10px;
    }

    .ck-editor__editable[role="textbox"] {
        /* editing area */
        min-height: 200px;
        color: black;
    }
    .ck-editor__editable[role="textbox"] p{
        /* editing area */
        margin-bottom: 2px;
    }
    .ck-content .image {
        /* block images */
        max-width: 80%;
        margin: 20px auto;
        width: 300px;
    }
    .ck-content .image-inline img, .ck-content .image-inline picture {
        flex-grow: 1;
        flex-shrink: 1;
        max-width: 100%;
        width: 300px;
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
                    <h3 class="card-title col-md-10">Create Announcement</h3>
                </div>
                <div class="card-body">
                <div class="row">
                        <div class="col">
                        <form id="announcement_form">
                        @csrf
                        <label for=""><span style="color: red;">*</span>Title</label>
                            <div class="input-group mb-3">
                            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="" required autocomplete="title" autofocus>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                <span class="fas fa-font"></span>
                                </div>
                            </div>
                            </div>
                            <div class="hasErr"></div>
                        </div>
                        <div class="col">
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                        <label for="">Status</label>
                            <div class="custom-control custom-switch custom-switch-on-success">
                            <input type="checkbox" name="status_id" class="custom-control-input" id="status_id" onchange="updateLabel()">
                            <label class="custom-control-label" for="status_id">Inactive</label>
                            </div>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col">
                        <label for=""><span style="color: red;">*</span>Body</label>
                            <textarea name="body" id="editor"  rows="10"></textarea>
                        </div>
                    </div>
                </form>
                </div>

            <!-- Modal -->
            <div class="modal fade" id="confirmAnnouncement" tabindex="-1" aria-labelledby="confirmAnnouncementLabel" aria-hidden="true">
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
                <form id="confirmation_announcement">
                <input type="hidden" name="user_id" id="user_id">
                @csrf
                    <p>Are you sure you want to save this announcement?</p>
                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
                </div>
                </div>
            </form>
            </div>
            </div>

            <div class="card-footer clearfix" id="footer">
                <button type="button" style="width: 100px;" class="btn btn-block btn-primary" onclick="submitAnnouncement({{$user->id}})"><i class="fas fa-save"></i>
                    Save</button>
            </div>
            </div>
        </div>
        </div>
    </div>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>

<script type="text/javascript">

function updateLabel() {
        var checkbox = document.getElementById('status_id');
        var label = document.querySelector('label[for="status_id"]');

        if (checkbox.checked) {
            label.textContent = 'Active';
        } else {
            label.textContent = 'Inactive';
        }
    }

    let editorInstance;

    class MyUploadAdapter {
    constructor( loader ) {
            // The file loader instance to use during the upload. It sounds scary but do not
            // worry — the loader will be passed into the adapter later on in this guide.
            this.loader = loader;
        }

        // Starts the upload process.
        upload() {
            return this.loader.file
                .then( file => new Promise( ( resolve, reject ) => {
                    this._initRequest();
                    this._initListeners( resolve, reject, file );
                    this._sendRequest( file );
                } ) );
        }

        // Aborts the upload process.
        abort() {
            if ( this.xhr ) {
                this.xhr.abort();
            }
        }

        // Initializes the XMLHttpRequest object using the URL passed to the constructor.
        _initRequest() {
            const xhr = this.xhr = new XMLHttpRequest();

            // Note that your request may look different. It is up to you and your editor
            // integration to choose the right communication channel. This example uses
            // a POST request with JSON as a data structure but your configuration
            // could be different.
            xhr.open( 'POST', '{{route("admin.ckeditor-upload")}}', true );
            xhr.setRequestHeader('x-csrf-token', '{{csrf_token()}}');
            xhr.responseType = 'json';
        }

        // Initializes XMLHttpRequest listeners.
        _initListeners( resolve, reject, file ) {
            const xhr = this.xhr;
            const loader = this.loader;
            const genericErrorText = `Couldn't upload file: ${ file.name }.`;

            xhr.addEventListener( 'error', () => reject( genericErrorText ) );
            xhr.addEventListener( 'abort', () => reject() );
            xhr.addEventListener( 'load', () => {
                const response = xhr.response;
                if ( !response || response.error ) {
                    return reject( response && response.error ? response.error.message : genericErrorText );
                }

                resolve( {
                    default: response.url
                } );
            } );

            // user interface.
            if ( xhr.upload ) {
                xhr.upload.addEventListener( 'progress', evt => {
                    if ( evt.lengthComputable ) {
                        loader.uploadTotal = evt.total;
                        loader.uploaded = evt.loaded;
                    }
                } );
            }
        }

        // Prepares the data and sends the request.
        _sendRequest( file ) {
            // Prepare the form data.
            const data = new FormData();

            data.append( 'upload', file );


            // Send the request.
            this.xhr.send( data );
        }
    }

    function SimpleUploadAdapterPlugin( editor ) {
    editor.plugins.get( 'FileRepository' ).createUploadAdapter = ( loader ) => {
        // Configure the URL to the upload script in your back-end here!
        return new MyUploadAdapter( loader );
    };
}

ClassicEditor
    .create( document.querySelector( '#editor' ), {

        extraPlugins: [ SimpleUploadAdapterPlugin ],

        fontSize: {
                    options: [ 10, 12, 14, 'default', 18, 20, 22 ],
                    supportAllValues: true
                },

    } )
    .then(editor => {
        // Save the CKEditor instance
        editorInstance = editor;
    })
    .catch( error => {
        console.error( error );
    } );

    function submitAnnouncement(id){
        $('#user_id').val(id);
        console.log(id);
        $('#confirmAnnouncement').modal("show");
    }

    $('#confirmation_announcement').on('submit', function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        submitAnnouncementForm(formData);

    });

    function submitAnnouncementForm(data) {

    $('#confirmAnnouncement').modal("hide");
    let formData = new FormData(document.getElementById('announcement_form'));
    formData.append("user_id", $('#user_id').val());
    // Retrieve CKEditor content and append it to the form data
    formData.append('body', editorInstance.getData());
    $('#announcement_form .hasErr').html('');
    // parent.startLoading();
    $.ajax({
        url: "{{ route('admin.announcement-submit') }}",
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
            if(response['message'] != null){
                toastr.error(response['message']);
            }else{
                toastr.error('Something went wrong');
            }

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

</script>

@endsection