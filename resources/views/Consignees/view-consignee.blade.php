@extends('layouts.main')
@section('content')

<div class="layout-px-spacing">
    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="widget-content widget-content-area br-6">
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="breadcrumb-title pe-3"><h5>Consignee Details</h5></div>
                </div>
                <div class="col-lg-12 col-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-content widget-content-area">
                            
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <th scope="row">Consignee Nick Name</th>
                                        <td>{{isset($getconsignee->nick_name)?ucfirst($getconsignee->nick_name):'-'}} </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Consignee Legal Name</th>
                                        <td>{{isset($getconsignee->legal_name)?ucfirst($getconsignee->legal_name):'-'}} </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Branch</th>
                                        <td>
                                            {{isset($getconsignee->GetBranch->name) ? ucfirst($getconsignee->GetBranch->name) : "-" }}
                                        </td>                                       
                                    </tr>
                                    <tr>
                                        <th scope="row">Consigner</th>
                                        <td> 
                                            {{isset($getconsignee->GetConsigner->nick_name) ? ucfirst($getconsignee->GetConsigner->nick_name) : "-" }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Type Of Dealer</th>
                                        <td><?php if($getconsignee->dealer_type == 1){
                                                echo "Register";
                                            }else if($getconsignee->dealer_type == 0){
                                                echo "Unregister";
                                            } else{ ?>
                                                 {{$getconsignee->dealer_type ?? "-"}}
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">GSTNO.</th>
                                        <td>{{isset($getconsignee->gst_number)?ucfirst($getconsignee->gst_number):'-'}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Contact Name</th>
                                        <td>{{isset($getconsignee->contact_name)?ucfirst($getconsignee->contact_name):'-'}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Mobile No.</th>
                                        <td>{{isset($getconsignee->phone)?ucfirst($getconsignee->phone):'-'}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Email ID</th>
                                        <td>{{isset($getconsignee->email)?ucfirst($getconsignee->email):'-'}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Sales officer Name</th>
                                        <td>{{isset($getconsignee->sales_officer_name)?ucfirst($getconsignee->sales_officer_name):'-'}}</td>
                                    </tr>
                                    <tr>
                                    <th scope="row">Sales officer Email</th>
                                        <td>{{isset($getconsignee->sales_officer_email)?ucfirst($getconsignee->sales_officer_email):'-'}}</td>
                                    </tr>
                                    <tr>
                                    <th scope="row">Sales officer Mobile</th>
                                        <td>{{isset($getconsignee->sales_officer_phone)?ucfirst($getconsignee->sales_officer_phone):'-'}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Address Line 1</th>
                                        <td>{{isset($getconsignee->address_line1)?ucfirst($getconsignee->address_line1):'-'}} </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Address Line 2</th>
                                        <td>{{isset($getconsignee->address_line2)?ucfirst($getconsignee->address_line2):'-'}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Address Line 3</th>
                                        <td>{{isset($getconsignee->address_line3)?ucfirst($getconsignee->address_line3):'-'}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">City</th>
                                        <td>{{isset($getconsignee->city) ? ucfirst($getconsignee->city):'-'}} </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">District</th>
                                        <td>{{isset($getconsignee->district)?ucfirst($getconsignee->district):'-'}} </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Pincode</th>
                                        <td>{{isset($getconsignee->postal_code) ? ucfirst($getconsignee->postal_code):'-'}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">State</th>
                                        <td>{{isset($getconsignee->GetState->name) ? ucfirst($getconsignee->GetState->name) : "-" }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Status</th>
                                        <td>
                                            <?php if($getconsignee->status == 1){
                                                echo "Active";
                                            }else if($getconsignee->status == 0){
                                                echo "Deactive";
                                            } else{ ?>
                                                 {{$getconsignee->status ?? "-"}}
                                            <?php } ?>
                                        </td>
                                    </tr>
                                        
                                </tbody>
                            </table>  
                            <a class="btn btn-primary" href="{{ route('consignees.index') }}"> Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection