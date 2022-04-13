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
                    <div style="margin-left:9px;" class="breadcrumb-title pe-3"><h5>Payments</h5></div>
                    <div class="ms-auto" style="margin: 10px 0 0px 774px">
                        <div class="btn-group">
                            <a class="btn-primary btn-cstm btn w-100" id="add_role" href="{{ route('payments.create') }}"><span><i class="fa fa-plus"></i> Add New</span></a>
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
                                <th>From City</th>
                                <th>Destination City</th>
                                <!-- <th>Purchase Price</th>
                                <th>Consignment note</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                if(count($payments)>0) {
                                    foreach ($payments as $key => $value) { 
                                ?>
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ ucfirst($value->origin) }}</td>
                                <td>{{ $value->destination }}</td>
                                
                            </tr>
                            <?php 
                                }
                            }
                            ?>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
<!-- @section('js')
<script>

</script>
@endsection -->