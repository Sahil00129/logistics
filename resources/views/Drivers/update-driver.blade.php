@extends('layouts.main')
@section('content')

<div class="layout-px-spacing">
    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="widget-content widget-content-area br-6">
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="breadcrumb-title pe-3"><h5>Update Driver</h5></div>
                    
                </div>
                <div class="col-lg-12 col-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-content widget-content-area">
                            <form class="general_form" method="POST" action="{{url($prefix.'drivers/update-driver')}}" id="updatedriver">
                                @csrf
                                <input type="hidden" name="driver_id" value="{{$getdriver->id}}">

                                <div class="form-row mb-0">
                                    <div class="form-group col-md-6">
                                        <label for="exampleFormControlInput2">Driver Name</label>
                                        <input type="text" class="form-control" name="name" value="{{old('name',isset($getdriver->name)?$getdriver->name:'')}}" placeholder="Name">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="exampleFormControlInput2">Driver Phone</label>
                                        <input type="text" class="form-control mbCheckNm" name="phone" value="{{old('phone',isset($getdriver->phone)?$getdriver->phone:'')}}" placeholder="Phone" maxlength="10">
                                    </div>
                                </div>
                                <div class="form-row mb-0">
                                    <div class="form-group col-md-6">
                                        <label for="exampleFormControlInput2">Driver License Number</label>
                                        <input type="text" class="form-control" name="license_number" value="{{old('license_number',isset($getdriver->license_number)?$getdriver->license_number:'')}}" placeholder="">
                                    </div>
                                </div>
                                <!-- <div class="form-row mb-0">
                                    <div class="form-group col-md-6">
                                        <label for="exampleFormControlInput2">Driver License File(Optional)</label>
                                        <input type="file" class="form-control" name="license_image" value="{{old('license_image',isset($getdriver->license_image)?$getdriver->license_image:'')}}" placeholder="">
                                    </div>
                                </div> -->

                                <input type="submit" class="mt-4 mb-4 btn btn-primary">
                                <a class="btn btn-primary" href="{{ route('drivers.index') }}"> Back</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection