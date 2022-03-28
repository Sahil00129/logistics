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
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div style="margin-left:9px;" class="breadcrumb-title pe-3"><h5>Permissions</h5></div>
                    <div class="ms-auto" style="margin: 10px 0 0px 654px">
                        <div class="btn-group">
                            <a class="btn-primary btn-cstm btn w-100" id="add_role" data-toggle="modal" data-target="#rolemodal" href="#"><span><i class="fa fa-plus"></i> Add New</span></a>
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
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                if(count($permissions)>0) {
                                    foreach ($permissions as $key => $value) {  
                                ?> 
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $value->name }}</td>
                                <td>
                                    <a class="btn btn-primary editrole" href="javascript:void(0)" data-action = "<?php echo URL::to($prefix.'permissions/get-permission'); ?>" data-status="{{ $value->status }}" data-id="{{ $value->id }}" data-toggle="modal" data-target="#rolemodal">Edit</a>                    
                                    <!-- <a href="Javascript:void();" class="btn btn-primary delete_role" data-id="{{ $value->id }}" data-action="<?php echo URL::to($prefix.'permissions/delete-permission'); ?>">Delete</a> -->
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
                    <!-- <div class="ml-auto mr-auto"><nav class="navigation2 text-center" aria-label="Page navigation">{{$permissions->links()}}</nav></div>
                 -->
                </div>
            </div>
        </div>
    </div>
</div>

@endsection