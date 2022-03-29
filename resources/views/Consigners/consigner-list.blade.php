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
                    <div style="margin-left:9px;" class="breadcrumb-title pe-3"><h5>Consigners</h5></div>
                    <div class="ms-auto" style="margin: 10px 0 0px 795px">
                        <div class="btn-group">
                            <a class="btn-primary btn-cstm btn w-100" id="add_role" href="{{ route('consigners.create') }}"><span><i class="fa fa-plus"></i> Add New</span></a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive mb-4 mt-4">
                    @csrf
                    <table id="consignertable" class="table table-hover get-datatable" style="width:100%">
                        <thead>
                            <tr>
                                <th>Sr No.</th>
                                <th>Nick Name</th>
                                <th>GST No.</th>
                                <th>Contact Name</th>
                                <th>Mobile</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                if(count($consigners)>0) {
                                    foreach ($consigners as $key => $value) {  
                                ?> 
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ ucfirst($value->nick_name) }}</td>
                                <td>{{ $value->gst_number }}</td>
                                <td>{{ ucfirst($value->contact_name) }}</td>
                                <td>{{ $value->phone }}</td>
                                <td>
                                    <a class="btn btn-primary" href="{{url($prefix.'consigners/'.Crypt::encrypt($value->id).'/edit')}}" >Edit</a>
                                    <a class="btn btn-primary" href="{{url($prefix.'consigners/'.Crypt::encrypt($value->id))}}" >View</a>
                                    <a href="Javascript:void();" class="btn btn-danger delete_consigner" data-id="{{ $value->id }}" data-action="<?php echo URL::to($prefix.'consigners/delete-consigner'); ?>">Delete</a>
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
                    <!-- <div class="ml-auto mr-auto"><nav class="navigation2 text-center" aria-label="Page navigation">{{$consigners->links()}}</nav></div>
                 -->
                </div>
            </div>
        </div>
    </div>
</div>

@include('models.delete-consigner')
@endsection
