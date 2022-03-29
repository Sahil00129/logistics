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
                                        <th scope="row">Branch Name</th>
                                        <td>{{isset($getbranch->name)?ucfirst($getbranch->name):'-'}} </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Address Line 1</th>
                                        <td>{{isset($getbranch->address_line1)?ucfirst($getbranch->address_line1):'-'}} </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Address Line 2</th>
                                        <td>{{isset($getbranch->address_line2)?ucfirst($getbranch->address_line2):'-'}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Address Line 3</th>
                                        <td>{{isset($getbranch->address_line3)?ucfirst($getbranch->address_line3):'-'}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">GSTNO.</th>
                                        <td>{{isset($getbranch->gstin_number)?ucfirst($getbranch->gstin_number):'-'}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">City</th>
                                        <td>{{isset($getbranch->city) ? ucfirst($getbranch->city):'-'}} </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">District</th>
                                        <td>{{isset($getbranch->district)?ucfirst($getbranch->district):'-'}} </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Pincode</th>
                                        <td>{{isset($getbranch->postal_code) ? ucfirst($getbranch->postal_code):'-'}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">State</th>
                                        <td>{{isset($getbranch->GetState->name) ? ucfirst($getbranch->GetState->name) : "-" }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Consignment Note</th>
                                        <td>{{isset($getbranch->consignment_note)?ucfirst($getbranch->consignment_note):'-'}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Email ID</th>
                                        <td>{{isset($getbranch->email)?ucfirst($getbranch->email):'-'}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Telephone</th>
                                        <td>{{isset($getbranch->phone)?ucfirst($getbranch->phone):'-'}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Status</th>
                                        <td>
                                            <?php if($getbranch->status == 1){
                                                echo "Active";
                                            }else if($getbranch->status == 0){
                                                echo "Deactive";
                                            } else{ ?>
                                                 {{$getbranch->status ?? "-"}}
                                            <?php } ?>
                                        </td>
                                    </tr>
                                        
                                </tbody>
                            </table>  
                            <a class="btn btn-primary" href="{{ route('branches.index') }}"> Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection