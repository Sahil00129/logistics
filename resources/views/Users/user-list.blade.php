@extends('layouts.main')
@section('content')
 <!-- BEGIN PAGE LEVEL STYLES -->
    <link rel="stylesheet" type="text/css" href="plugins/table/datatable/datatables.css">
    <link rel="stylesheet" type="text/css" href="plugins/table/datatable/dt-global_style.css">
    <!-- END PAGE LEVEL STYLES -->

    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-6">
                    <div style="margin-left:9px;" class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                        <div class="breadcrumb-title pe-3"><h5>Users</h5></div>
                        <div class="ms-auto" style="margin: 10px 0 0px 812px">
                            <div class="btn-group">
                                <a href="{{ route('users.create') }}" class="btn btn-primary pull-right">Create User</a>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive mb-4 mt-4">
                        @csrf
                        <table id="usertable" class="table table-hover get-datatable" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Roles</th>
                                    <th style="display: none;">Password</th>
                                    <th>Action</th>
                                    <!-- <th class="no-content"></th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    if(count($data)>0) {
                                        foreach ($data as $key => $user) {  
                                    ?> 
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ ucwords($user->name ?? "")}}</td>
                                    <td>{{ $user->email ?? "" }}</td>
                                    <td>{{ ucwords($user->UserRole->name ?? "") }}</td>
                                    <td style="display: none;">{{ $user->user_password ?? "" }}</td>
                                    <td>
                                        <a class="btn btn-primary" href="{{url($prefix.'users/'.Crypt::encrypt($user->id).'/edit')}}" >Edit</a>
                                        <a class="btn btn-primary" href="{{url($prefix.'users/'.Crypt::encrypt($user->id))}}" >View</a>
                                        <a href="Javascript:void();" class="btn btn-danger delete_user" data-id="{{ $user->id }}" data-action="<?php echo URL::to($prefix.'users/delete-user'); ?>">Delete</a>
                                    </td>
                                </tr>
                                <?php 
                                    }
                                }
                                else {
                                    ?>
                                        <tr>
                                            <td colspan="7" class="text-center">No Record Found </td>
                                        </tr>
                                <?php 
                                    }
                                ?>
                            </tbody>
                        </table>
                        <!-- <div class="ml-auto mr-auto"><nav class="navigation2 text-center" aria-label="Page navigation">{{$data->links()}}</nav></div> -->
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@include('models.delete-user')
@endsection