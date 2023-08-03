@extends('backend.layouts.app')
@section('content')


<div class="content-wrapper">
    <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Role Management</h1><br>
            </div>
            <div class="col-sm-6">
            <div id="response" style="float: right;" role="alert"></div>
            </div>
            <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                <div class="card">
                    <div style="display: inline-flex;" class="card-header">
                    <h3 class="card-title col-md-11">List of Role</h3>
                    <button type="button" class="btn btn-success btn-block btn-sm" title="Create New Role" data-toggle="modal" data-target="#registerModal">
                        <i class="fa fa-plus"></i> Role</button>
                </div>
                <div class="card-body">
                <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">No.</th>
                                <th>Name</th>
                                <th>Created At</th>
                                <th style="width: 140px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($roles) == 0)
                            <tr>
                                <td colspan="4" style="text-align: center;"><p><i class="fas fa-info-circle"></i> No record was found.</p></td>
                            </tr>
                            @endif
                            @foreach ($roles as $role)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$role->name}}</td>
                                <td>{{$role->created_at}}</td>
                                <td>
                                    <div class="row">
                                        <div class="col-4">
                                            <a href="#" class="btn btn-success btn-sm edit" role="button" title="Edit"><i class="fa fa-user-edit"></i></a>
                                        </div>
                                        <div class="col-4">
                                            <button type="button" class="btn btn-danger btn-sm delete" title="Delete"><i class="fa fa-trash-alt"></i></button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            <div class="card-footer clearfix">
                <div class="row">
                    <div class="col-sm-12 col-md-5">
                        <div class="dataTables_info" aria-live="polite">Showing {{$roles->firstItem()}} to {{$roles->lastItem()}} of {{$roles->total()}} entries</div>
                    </div>
                    <div class="col-sm-12 col-md-7">
                        <div class="dataTables_paginate paging_simple_numbers">
                            <ul class="pagination pagination m-0 float-right">
                                {{$roles->links()}}
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