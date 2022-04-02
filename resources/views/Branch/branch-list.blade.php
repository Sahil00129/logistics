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
                    <div style="margin-left:9px;" class="breadcrumb-title pe-3"><h5>Branches</h5></div>
                    <div class="ms-auto" style="margin: 10px 0 0px 810px">
                        <div class="btn-group">
                            <a class="btn-primary btn-cstm btn w-100" id="add_role" href="{{ route('branches.create') }}"><span><i class="fa fa-plus"></i> Add New</span></a>
                        </div>
                    </div>
                </div>
                <p class="branch_error" style="display: none; color: red;">This Branch cannot be deleted because it's already in use.</p>
                <div class="table-responsive mb-4 mt-4">
                    @csrf
                    <table id="branchtable" class="table table-hover get-datatable" style="width:100%">
                        <thead>
                            <tr>
                                <th>Sr No.</th>
                                <th>Branch Name</th>
                                <th>GST No.</th>
                                <th>State</th>
                                <th>Consignment note</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                if(count($branches)>0) {
                                    foreach ($branches as $key => $value) {  
                                ?> 
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ ucfirst($value->name) }}</td>
                                <td>{{ $value->gstin_number }}</td>
                                <td>{{isset($value->State->name) ? ucfirst($value->State->name) : "-"}}</td>
                                <td>{{ $value->consignment_note }}</td>
                                <!-- <td>
                                    <a class="btn btn-primary" href="{{url($prefix.'branches/'.Crypt::encrypt($value->id).'/edit')}}" >Edit<span><i class="fa fa-edit"></i></span></a>
                                    <a class="btn btn-primary" href="{{url($prefix.'branches/'.Crypt::encrypt($value->id))}}" >View</a>
                                    <a href="Javascript:void();" class="btn btn-danger delete_branch" data-id="{{ $value->id }}" data-action="<?php// echo URL::to($prefix.'branches/delete-branch'); ?>">Delete</a> 
                                </td> -->
                                <td>
                                    <a class="" href="{{url($prefix.'branches/'.Crypt::encrypt($value->id).'/edit')}}" >
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                    </a>
                                    <a class="" href="{{url($prefix.'branches/'.Crypt::encrypt($value->id))}}" >
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                    </a>
                                    
                                    <a href="Javascript:void();" class="delete_branch" data-id="{{ $value->id }}" data-action="<?php echo URL::to($prefix.'branches/delete-branch'); ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                    </a>
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
                    <!-- <div class="ml-auto mr-auto"><nav class="navigation2 text-center" aria-label="Page navigation">{{$branches->links()}}</nav></div>
                 -->
                </div>
            </div>
        </div>
    </div>
</div>

@include('models.delete-branch')
@endsection
<!-- @section('js')
<script type="text/javascript">
$('.widget-content .delete_branch').on('click', function () {
    var branchid =  jQuery(this).attr('data-id');
    var url =  jQuery(this).attr('data-action');
    alert("gjj");
   
})
</script>
@endsection -->