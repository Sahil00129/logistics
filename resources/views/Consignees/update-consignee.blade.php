@extends('layouts.main')
@section('content')

<div class="layout-px-spacing">
    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="widget-content widget-content-area br-6">
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="breadcrumb-title pe-3"><h5>Update Consignee</h5></div>
                    
                </div>
                <div class="col-lg-12 col-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-content widget-content-area">
                            <form class="general_form" method="POST" action="{{url($prefix.'consignees/update-consignee')}}" id="updateconsignee">
                                @csrf
                                <input type="hidden" name="consignee_id" value="{{$getconsignee->id}}">

                                <div class="form-row mb-0">                          
                                    <div class="form-group col-md-6">
                                        <label for="exampleFormControlInput2">Consignee Nick Name</label>
                                        <input type="text" class="form-control" name="nick_name" value="{{old('nick_name',isset($getconsignee->nick_name)?$getconsignee->nick_name:'')}}" placeholder="">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="exampleFormControlInput2">Consignee Legal Name</label>
                                        <input type="text" class="form-control" name="legal_name" value="{{old('legal_name',isset($getconsignee->legal_name)?$getconsignee->legal_name:'')}}" placeholder="">
                                    </div>
                                </div>
                                <div class="form-row mb-0">                          
                                    <div class="form-group col-md-6">
                                        <label for="exampleFormControlSelect1">Branch</label>
                                        <select class="form-control" name="branch_id">
                                            <option value="">Select</option>
                                            <?php 
                                            if(count($branches)>0) {
                                                foreach ($branches as $k => $branch) {
                                            ?>
                                                <option value="{{ $k }}" {{ $k == $getconsignee->branch_id ? 'selected' : ''}}>{{ucwords($branch)}}</option>
                                              <?php 
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="exampleFormControlSelect1">Consigner</label>
                                        <select class="form-control" name="branch_id">
                                            <option value="">Select</option>
                                            <?php 
                                            if(count($consigners)>0) {
                                                foreach ($consigners as $k => $consigner) {
                                            ?>
                                                <option value="{{ $k }}" {{ $k == $getconsignee->consigner_id ? 'selected' : ''}}>{{ucwords($consigner)}}</option>
                                              <?php 
                                                }
                                            }
                                            ?>
                                        </select>
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
                                                <option value="{{ $k }}" {{ $k == $getconsignee->state_id ? 'selected' : ''}}>{{ucwords($state)}}</option> 
                                              <?php 
                                                }
                                            }
                                            ?>                            
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="exampleFormControlInput2">GST No.</label>
                                        <input type="text" class="form-control" name="gst_number" value="{{old('gst_number',isset($getconsignee->gst_number)?$getconsignee->gst_number:'')}}" placeholder="">
                                    </div>
                                </div>
                                <div class="form-row mb-0">                          
                                    <div class="form-group col-md-6">
                                        <label for="exampleFormControlInput2">Contact Name</label>
                                        <input type="text" class="form-control" name="contact_name" value="{{old('contact_name',isset($getconsignee->contact_name)?$getconsignee->contact_name:'')}}" placeholder="Contact Name">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="exampleFormControlInput2">Email ID</label>
                                        <input type="email" class="form-control" name="email" value="{{old('email',isset($getconsignee->email)?$getconsignee->email:'')}}" placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-row mb-0">
                                    <div class="form-group col-md-6">
                                        <label for="exampleFormControlInput2">Mobile No.</label>
                                        <input type="text" class="form-control mbCheckNm" name="phone" value="{{old('phone',isset($getconsignee->phone)?$getconsignee->phone:'')}}" placeholder="Phone" maxlength="10">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="exampleFormControlSelect1">Type Of Dealer</label>
                                        <select class="form-control" name="dealer_type">
                                            <option value="">Select</option>
                                            <option value="1" {{$getconsignee->dealer_type == '1' ? 'selected' : ''}}>Registered</option>
                                            <option value="0" {{$getconsignee->dealer_type == '0' ? 'selected' : ''}}>Unregistered</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row mb-0">                          
                                    <div class="form-group col-md-6">
                                        <label for="exampleFormControlInput2">Sales Officer Name</label>
                                        <input type="text" class="form-control" name="sales_officer_name" value="{{old('sales_officer_name',isset($getconsignee->sales_officer_name)?$getconsignee->sales_officer_name:'')}}" placeholder="Address Line 1">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="exampleFormControlInput2">Sales Officer Email</label>
                                        <input type="text" class="form-control" name="sales_officer_email" value="{{old('sales_officer_email',isset($getconsignee->sales_officer_email)?$getconsignee->sales_officer_email:'')}}" placeholder="Address Line 1">
                                    </div>
                                </div>
                                <div class="form-row mb-0">                          
                                    <div class="form-group col-md-6">
                                        <label for="exampleFormControlInput2">Sales Officer Mobile</label>
                                        <input type="text" class="form-control" name="sales_officer_phone" value="{{old('sales_officer_phone',isset($getconsignee->sales_officer_phone)?$getconsignee->sales_officer_phone:'')}}" placeholder="Address Line 1">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="exampleFormControlInput2">Address Line 1</label>
                                        <input type="text" class="form-control" name="address_line1" value="{{old('address_line1',isset($getconsignee->address_line1)?$getconsignee->address_line1:'')}}" placeholder="Address Line 1">
                                    </div>
                                </div>
                                <div class="form-row mb-0">                          
                                    <div class="form-group col-md-6">
                                        <label for="exampleFormControlInput2">Address Line 2</label>
                                        <input type="text" class="form-control" name="address_line2" value="{{old('address_line2',isset($getconsignee->address_line2)?$getconsignee->address_line2:'')}}" placeholder="Address Line 2">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="exampleFormControlInput2">Address Line 3</label>
                                        <input type="text" class="form-control" name="address_line3" value="{{old('address_line3',isset($getconsignee->address_line3)?$getconsignee->address_line3:'')}}" placeholder="Address Line 3">
                                    </div>
                                </div>
                                <div class="form-row mb-0">                          
                                    <div class="form-group col-md-6">
                                        <label for="exampleFormControlInput2">Village/City</label>
                                        <input type="text" class="form-control" name="city" value="{{old('city',isset($getconsignee->city)?$getconsignee->city:'')}}" placeholder="City">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="exampleFormControlInput2">District</label>
                                        <input type="text" class="form-control" name="district" value="{{old('district',isset($getconsignee->district)?$getconsignee->district:'')}}" placeholder="District">
                                    </div>
                                </div>
                                <div class="form-row mb-0">                          
                                    <div class="form-group col-md-6">
                                        <label for="exampleFormControlInput2">Pincode</label>
                                        <input type="text" class="form-control" name="postal_code" value="{{old('postal_code',isset($getconsignee->postal_code)?$getconsignee->postal_code:'')}}" placeholder="Pincode">
                                    </div>
                                    <div class="form-row col-md-6">
                                    <div class="form-group col-md-6">
                                        <label for="exampleFormControlInput2">Status</label>
                                        <div class="check-box d-flex">
                                            <div class="checkbox radio">
                                                <label class="check-label">Active
                                                   <input type="radio" value="1" name="status" class=""  {{ ($getconsignee->status=="1")? "checked" : "" }}>
                                                   <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <div class="checkbox radio">
                                                <label class="check-label">Deactive
                                                   <input type="radio" name="status" value="0" {{ ($getconsignee->status=="0")? "checked" : "" }}>
                                                   <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        </div>                                    
                                    </div>
                                </div>
                                </div>

                                <input type="submit" class="mt-4 mb-4 btn btn-primary" value="Update">
                                <a class="btn btn-danger" href="{{ route('consignees.index') }}"> Back</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection