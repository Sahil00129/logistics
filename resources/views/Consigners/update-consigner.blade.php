@extends('layouts.main')
@section('content')

<div class="layout-px-spacing">
    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="widget-content widget-content-area br-6">
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="breadcrumb-title pe-3"><h5>Update Consigner</h5></div>
                    
                </div>
                <div class="col-lg-12 col-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-content widget-content-area">
                            <form class="general_form" method="POST" action="{{url($prefix.'consigners/update-consigner')}}" id="updateconsigner">
                                @csrf
                                <input type="hidden" name="consigner_id" value="{{$getconsigner->id}}">

                                <div class="form-row mb-0">
                                    <div class="form-group col-md-6">
                                        <label for="exampleFormControlInput2">Consigner Nick Name</label>
                                        <input type="text" class="form-control" name="nick_name" value="{{old('nick_name',isset($getconsigner->nick_name)?$getconsigner->nick_name:'')}}" placeholder="">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="exampleFormControlInput2">Consigner Legal Name</label>
                                        <input type="text" class="form-control" name="legal_name" value="{{old('legal_name',isset($getconsigner->legal_name)?$getconsigner->legal_name:'')}}" placeholder="">
                                    </div>
                                </div>                         
                                <div class="form-row mb-0">
                                    <div class="form-group col-md-6">
                                        <label for="exampleFormControlSelect1">Select State</label>
                                        <select class="form-control" name="state_id">
                                            <option value="">Select</option>
                                            <?php 
                                            if(count($states)>0) {
                                                foreach ($states as $k => $state) {
                                            ?>
                                                <option value="{{ $k }}" {{ $k == $getconsigner->state_id ? 'selected' : ''}}>{{ucwords($state)}}</option> 
                                              <?php 
                                                }
                                            }
                                            ?>                            
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="exampleFormControlInput2">GST No.</label>
                                        <input type="text" class="form-control" name="gst_number" value="{{old('gst_number',isset($getconsigner->gst_number)?$getconsigner->gst_number:'')}}" placeholder="">
                                    </div>
                                </div>
                                <div class="form-row mb-0">
                                    <div class="form-group col-md-6">
                                        <label for="exampleFormControlInput2">Contact Name</label>
                                        <input type="text" class="form-control" name="contact_name" value="{{old('contact_name',isset($getconsigner->contact_name)?$getconsigner->contact_name:'')}}" placeholder="Contact Name">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="exampleFormControlInput2">Email ID</label>
                                        <input type="email" class="form-control" name="email" value="{{old('email',isset($getconsigner->email)?$getconsigner->email:'')}}" placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-row mb-0">
                                    <div class="form-group col-md-6">
                                        <label for="exampleFormControlInput2">Mobile No.</label>
                                        <input type="text" class="form-control mbCheckNm" name="phone" value="{{old('phone',isset($getconsigner->phone)?$getconsigner->phone:'')}}" placeholder="Phone" maxlength="10">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="exampleFormControlSelect1">Select Branch</label>
                                        <select class="form-control" name="branch_id">
                                            <option value="">Select</option>
                                            <?php 
                                            if(count($branches)>0) {
                                                foreach ($branches as $k => $branch) {
                                            ?>
                                                <option value="{{ $k }}" {{ $k == $getconsigner->branch_id ? 'selected' : ''}}>{{ucwords($branch)}}</option>
                                              <?php 
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="exampleFormControlInput2">Address</label>
                                    <textarea class="form-control" name="address" cols="5" rows="5" placeholder="Address">{{old('address',isset($getconsigner->address)?$getconsigner->address:'')}}</textarea>
                                </div>
                                <div class="form-row mb-0">
                                    <div class="form-group col-md-6">
                                        <label for="exampleFormControlInput2">City</label>
                                        <input type="text" class="form-control" name="city" value="{{old('city',isset($getconsigner->city)?$getconsigner->city:'')}}" placeholder="City">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="exampleFormControlInput2">District</label>
                                        <input type="text" class="form-control" name="district" value="{{old('district',isset($getconsigner->district)?$getconsigner->district:'')}}" placeholder="District">
                                    </div>
                                </div>
                                <div class="form-row mb-0">
                                    <div class="form-group col-md-6">
                                        <label for="exampleFormControlInput2">Pincode</label>
                                        <input type="text" class="form-control" name="postal_code" value="{{old('postal_code',isset($getconsigner->postal_code)?$getconsigner->postal_code:'')}}" placeholder="Pincode">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="exampleFormControlInput2">Status</label>
                                        <div class="check-box d-flex">
                                            <div class="checkbox radio">
                                                <label class="check-label">Active
                                                   <input type="radio" value="1" name="status" class=""  {{ ($getconsigner->status=="1")? "checked" : "" }}>
                                                   <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <div class="checkbox radio">
                                                <label class="check-label">Deactive
                                                   <input type="radio" name="status" value="0" {{ ($getconsigner->status=="0")? "checked" : "" }}>
                                                   <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>                              
                                </div>
                                <input type="submit" class="mt-4 mb-4 btn btn-primary">
                                <a class="btn btn-primary" href="{{ route('consigners.index') }}"> Back</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection