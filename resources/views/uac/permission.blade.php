@extends('backend.layouts.app')
@section('content')


<div class="content-wrapper">
    <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Permission Management</h1><br>
            </div>
            <div class="col-sm-6">
            <div id="response" style="float: right;" role="alert"></div>
            </div>
            <div class="container-fluid">
            <div class="row">
                <div class="col">
                <div class="card">
                    <div style="display: inline-flex;" class="card-header">
                    <h3 class="card-title col-md-11">Edit Permission</h3>
                    <button type="button" class="btn btn-success btn-block btn-sm" title="Create New Permission" data-toggle="modal" data-target="#addRoleModal">
                        <i class="fa fa-plus"></i> Permission</button>
                </div>
                <div class="card-body">

                </div>

            <!-- Modal -->
            <div class="modal fade" id="addRoleModal" tabindex="-1" aria-labelledby="addRoleModalModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">Add New Role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </div>
                <form id="role_form">
                    @csrf
                <div class="modal-body" id="">
                    <label for="">Role Name<span style="color: red;">*</span></label>
                    <div class="input-group mb-3">
                    <input id="role_name" type="text" class="form-control @error('role_name') is-invalid @enderror" name="role_name" value="" required autocomplete="role_name" autofocus>
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-user-tag"></span>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Add Role</button>
                </div>
                </div>
                </form>
            </div>
            </div>

            <div class="card-footer clearfix">
                <div class="row">
                    <div class="col-sm-12 col-md-5">
                        <div class="dataTables_info" aria-live="polite">Showing 1 to 1 of 1 entries</div>
                    </div>
                    <div class="col-sm-12 col-md-7">
                        <div class="dataTables_paginate paging_simple_numbers">
                            <ul class="pagination pagination m-0 float-right">
                                
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

$(document).ready(function(){

});


</script>

@endsection