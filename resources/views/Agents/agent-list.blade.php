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
                    <div style="margin-left:9px;" class="breadcrumb-title pe-3"><h5>Agents</h5></div>
                    <div class="ms-auto" style="margin: 10px 0 0px 828px">
                        <div class="btn-group">
                            <a class="btn-primary btn-cstm btn w-100" id="add_role" href="{{ route('agents.create') }}"><span><i class="fa fa-plus"></i> Add New</span></a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive mb-4 mt-4">
                    @csrf
                    <table id="agenttable" class="table table-hover get-datatable" style="width:100%">
                        <thead>
                            <tr>
                                <!-- <th>Sr No.</th> -->
                                <th>Agent Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>GST</th>
                                <th>Pan</th>
                                <th>Type</th>
                                <th>Lane Approval</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                if(count($agents)>0) {
                                    foreach ($agents as $key => $value) {  
                                ?> 
                            <tr>
                                <!-- <td>{{ ++$i }}</td> -->
                                <td>{{ ucfirst($value->name) }}</td>
                                <td>{{ ucfirst($value->email) }}</td>
                                <td>{{ ucfirst($value->phone) }}</td>
                                <td>{{ ucfirst($value->gst_number) }}</td>
                                <td>{{ ucfirst($value->pan_number) }}</td>
                                <td>
                                    <?php if($value->agent_type == 1){
                                        echo "Contracted";
                                    }else if($value->agent_type == 0){
                                        echo "Non-Contracted";
                                    } else{ ?>
                                         {{$value->agent_type ?? "-"}}
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php if($value->is_lane_approved == 1){
                                        echo "Yes";
                                    }else if($value->is_lane_approved == 0){
                                        echo "No";
                                    } else{ ?>
                                         {{$value->is_lane_approved ?? "-"}}
                                    <?php } ?>
                                </td>
                                <td>
                                    <a class="btn btn-primary" href="{{url($prefix.'agents/'.Crypt::encrypt($value->id).'/edit')}}" >Edit<span><i class="fa fa-edit"></i></span></a>
                                    <a class="btn btn-primary" href="{{url($prefix.'agents/'.Crypt::encrypt($value->id))}}" >View</a>
                                    <a href="Javascript:void();" class="btn btn-danger delete_agent" data-id="{{ $value->id }}" data-action="<?php echo URL::to($prefix.'agents/delete-agent'); ?>">Delete</a>
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
                    <!-- <div class="ml-auto mr-auto"><nav class="navigation2 text-center" aria-label="Page navigation">{{$agents->links()}}</nav></div>
                 -->
                </div>
            </div>
        </div>
    </div>
</div>

@include('models.delete-agent')
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