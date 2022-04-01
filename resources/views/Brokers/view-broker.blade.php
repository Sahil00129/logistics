@extends('layouts.main')
@section('content')

<div class="layout-px-spacing">
    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="widget-content widget-content-area br-6">
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="breadcrumb-title pe-3"><h5>Broker Details</h5></div>
                </div>
                <div class="col-lg-12 col-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-content widget-content-area">
                            
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <th scope="row">Broker Name</th>
                                        <td>{{isset($getbroker->name)?ucfirst($getbroker->name):'-'}} </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Branch Name</th>
                                        <td>{{isset($getbroker->GetBranch->name) ? ucfirst($getbroker->GetBranch->name) : "-" }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Email ID</th>
                                        <td>{{isset($getbroker->email)?ucfirst($getbroker->email):'-'}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Phone</th>
                                        <td>{{isset($getbroker->phone) ? $getbroker->phone:'-'}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">GST NO.</th>
                                        <td>{{isset($getbroker->gst_number)?ucfirst($getbroker->gst_number):'-'}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Pan NO.</th>
                                        <td>{{isset($getbroker->pan_number)?ucfirst($getbroker->pan_number):'-'}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Broker Type</th>
                                        <td>
                                            <?php if($getbroker->broker_type == 1){
                                                echo "Contracted";
                                            }else if($getbroker->broker_type == 0){
                                                echo "Non-Contracted";
                                            } else{ ?>
                                                 {{$getbroker->broker_type ?? "-"}}
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Required Lane Wise Approval</th>
                                        <td>
                                            <?php if($getbroker->is_lane_approved == 1){
                                                echo "Yes";
                                            }else if($getbroker->is_lane_approved == 0){
                                                echo "No";
                                            } else{ ?>
                                                 {{$getbroker->is_lane_approved ?? "-"}}
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Address</th>
                                        <td>{{isset($getbroker->address)?ucfirst($getbroker->address):'-'}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Bank Name</th>
                                        <td>{{isset($getbroker->Broker->bank_name)?ucfirst($getbroker->Broker->bank_name):'-'}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Branch Name</th>
                                        <td>{{isset($getbroker->Broker->branch_name) ? ucfirst($getbroker->Broker->branch_name):'-'}} </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">IFSC</th>
                                        <td>{{isset($getbroker->Broker->ifsc) ? $getbroker->Broker->ifsc:'-'}} </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Account No</th>
                                        <td>{{isset($getbroker->Broker->account_number) ? $getbroker->Broker->account_number:'-'}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Account Holder Name</th>
                                        <td>{{isset($getbroker->Broker->account_holdername) ? ucfirst($getbroker->Broker->account_holdername) : "-" }}</td>
                                    </tr>
                                                                            
                                </tbody>
                            </table>  
                            <a class="btn btn-primary" href="{{ route('brokers.index') }}"> Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection