@extends('layouts.main')
@section('content')

<div class="layout-px-spacing">
    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="widget-content widget-content-area br-6">
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="breadcrumb-title pe-3"><h5>Driver Details</h5></div>
                    <div class="col-md-10 text-right">
                        <a href="{{url($prefix.'drivers/'.Crypt::encrypt($getdriver->id).'/edit')}}" class="btn my-3" href="" style="background:#fff;" title="Edit Driver"><i class="fa fa-edit m-0"></i></a>
                    </div>
                </div>
                <div class="col-lg-12 col-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-content widget-content-area">
                            
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <th scope="row">Driver Name</th>
                                        <td>{{isset($getdriver->name)?ucfirst($getdriver->name):'-'}} </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Phone</th>
                                        <td>{{isset($getdriver->phone) ? ucfirst($getdriver->phone) : "-" }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Driver License Number</th>
                                        <td>{{isset($getdriver->license_number)?ucfirst($getdriver->license_number):'-'}}</td>
                                    </tr>
                                    <!-- <tr>
                                        <th scope="row">Driver License Image</th>
                                        <td>{{isset($getdriver->license_image) ? $getdriver->license_image:'-'}}</td>
                                    </tr> -->
                                    
                                                                            
                                </tbody>
                            </table>  
                            <a class="btn btn-primary" href="{{ route('drivers.index') }}"> Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection