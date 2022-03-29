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
                                        <th scope="row">Consigner Nick Name</th>
                                        <td>{{isset($getconsigner->nick_name)?ucfirst($getconsigner->nick_name):'-'}} </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Consigner Legal Name</th>
                                        <td>{{isset($getconsigner->legal_name)?ucfirst($getconsigner->legal_name):'-'}} </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">GSTNO.</th>
                                        <td>{{isset($getconsigner->gst_number)?ucfirst($getconsigner->gst_number):'-'}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Contact Name</th>
                                        <td>{{isset($getconsigner->contact_name)?ucfirst($getconsigner->contact_name):'-'}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Mobile No.</th>
                                        <td>{{isset($getconsigner->phone)?ucfirst($getconsigner->phone):'-'}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Branch</th>
                                        <td>
                                            {{isset($getconsigner->GetBranch->name) ? ucfirst($getconsigner->GetBranch->name) : "-" }}
                                        </td>                                       
                                    </tr>
                                    <tr>
                                        <th scope="row">Email ID</th>
                                        <td>{{isset($getconsigner->email)?ucfirst($getconsigner->email):'-'}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Address Line 1</th>
                                        <td>{{isset($getconsigner->address_line1)?ucfirst($getconsigner->address_line1):'-'}} </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Address Line 2</th>
                                        <td>{{isset($getconsigner->address_line2)?ucfirst($getconsigner->address_line2):'-'}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Address Line 3</th>
                                        <td>{{isset($getconsigner->address_line3)?ucfirst($getconsigner->address_line3):'-'}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">City</th>
                                        <td>{{isset($getconsigner->city) ? ucfirst($getconsigner->city):'-'}} </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">District</th>
                                        <td>{{isset($getconsigner->district)?ucfirst($getconsigner->district):'-'}} </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Pincode</th>
                                        <td>{{isset($getconsigner->postal_code) ? ucfirst($getconsigner->postal_code):'-'}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">State</th>
                                        <td>{{isset($getconsigner->GetState->name) ? ucfirst($getconsigner->GetState->name) : "-" }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Status</th>
                                        <td>
                                            <?php if($getconsigner->status == 1){
                                                echo "Active";
                                            }else if($getconsigner->status == 0){
                                                echo "Deactive";
                                            } else{ ?>
                                                 {{$getconsigner->status ?? "-"}}
                                            <?php } ?>
                                        </td>
                                    </tr>
                                        
                                </tbody>
                            </table>  
                            <a class="btn btn-primary" href="{{ route('consigners.index') }}"> Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection