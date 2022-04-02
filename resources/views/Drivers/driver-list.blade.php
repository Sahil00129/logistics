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
                    <div style="margin-left:9px;" class="breadcrumb-title pe-3"><h5>Drivers</h5></div>
                    <div class="ms-auto" style="margin: 10px 0 0px 828px">
                        <div class="btn-group">
                            <a class="btn-primary btn-cstm btn w-100" id="add_role" href="{{ route('drivers.create') }}"><span><i class="fa fa-plus"></i> Add New</span></a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive mb-4 mt-4">
                    @csrf
                    <table id="drivertable" class="table table-hover get-datatable" style="width:100%">
                        <thead>
                            <tr>
                                <th>Sr No.</th>
                                <th>Driver</th>
                                <th>Phone</th>
                                <th>License No</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                if(count($drivers)>0) {
                                    foreach ($drivers as $key => $value) {  
                                ?> 
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ ucfirst($value->name) }}</td>
                                <td>{{ ucfirst($value->phone) }}</td>
                                <td>{{ ucfirst($value->license_number) }}</td>
                                <td>
                                    <a class="btn btn-primary" href="{{url($prefix.'drivers/'.Crypt::encrypt($value->id).'/edit')}}" >Edit<span><i class="fa fa-edit"></i></span></a>
                                    <!-- <a class="btn btn-primary" href="{{url($prefix.'drivers/'.Crypt::encrypt($value->id))}}" >View</a> -->
                                    <a href="Javascript:void();" class="btn btn-danger delete_driver" data-id="{{ $value->id }}" data-action="<?php echo URL::to($prefix.'drivers/delete-driver'); ?>">Delete</a>
                                </td>
                            </tr>
                            <?php 
                                }
                            }
                            ?>
                            
                        </tbody>
                    </table>
                    <!-- <div class="ml-auto mr-auto"><nav class="navigation2 text-center" aria-label="Page navigation">{{$drivers->links()}}</nav></div>
                 -->
                </div>
            </div>
        </div>
    </div>
</div>

@include('models.delete-driver')
@endsection
