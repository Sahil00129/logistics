@extends('layouts.main')
@section('content')

<div class="layout-px-spacing">
    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="widget-content widget-content-area br-6">
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="breadcrumb-title pe-3"><h5>Create new consigner</h5></div>
                </div>
                <div class="col-lg-12 col-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <!-- <div class="widget-header">                                
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Create New Branch</h4>
                                </div>
                            </div>
                        </div> -->
                        <div class="widget-content widget-content-area">
                            {!! Form::open(array('route' => 'consigners.store','method'=>'POST', 'id'=>'createconsigner', 'class'=>'general_form')) !!}
                                                            
                                <div class="form-group mb-4">
                                    <label for="exampleFormControlInput2">Consigner Nick Name</label>
                                    <input type="text" class="form-control" name="nick_name" placeholder="">
                                </div>
                                <div class="form-group mb-4">
                                    <label for="exampleFormControlInput2">Consigner Legal Name</label>
                                    <input type="text" class="form-control" name="legal_name" placeholder="">
                                </div>
                                <div class="form-group mb-4">
                                    <label for="exampleFormControlInput2">GST No.</label>
                                    <input type="text" class="form-control" name="gst_number" placeholder="">
                                </div>
                                <div class="form-group mb-4">
                                    <label for="exampleFormControlInput2">Contact Name</label>
                                    <input type="text" class="form-control" name="contact_name" placeholder="Contact Name">
                                </div>
                                <div class="form-group mb-4">
                                    <label for="exampleFormControlInput2">Mobile No.</label>
                                    <input type="text" class="form-control mbCheckNm" name="phone" placeholder="Enter 10 digit mobile no" maxlength="10">
                                </div>
                                <div class="form-group mb-4">
                                    <label for="exampleFormControlSelect1">Select Branch</label>
                                    <select class="form-control" name="branch_id">
                                        <option value="">Select</option>
                                        <?php 
                                        if(count($branches)>0) {
                                            foreach ($branches as $key => $branch) {
                                        ?>
                                            <option value="{{ $key }}">{{ucwords($branch)}}</option>
                                          <?php 
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="exampleFormControlInput2">Email ID</label>
                                    <input type="email" class="form-control" name="email" placeholder="">
                                </div>
                                <div class="form-group mb-4">
                                    <label for="exampleFormControlInput2">Address Line 1</label>
                                    <input type="text" class="form-control" name="address_line1" placeholder="Address Line 1">
                                </div>
                                <div class="form-group mb-4">
                                    <label for="exampleFormControlInput2">Address Line 2</label>
                                    <input type="text" class="form-control" name="address_line2" placeholder="Address Line 2">
                                </div>
                                <div class="form-group mb-4">
                                    <label for="exampleFormControlInput2">Address Line 3</label>
                                    <input type="text" class="form-control" name="address_line3" placeholder="Address Line 3">
                                </div>
                                <div class="form-group mb-4">
                                    <label for="exampleFormControlInput2">City</label>
                                    <input type="text" class="form-control" name="city" placeholder="City">
                                </div>
                                <div class="form-group mb-4">
                                    <label for="exampleFormControlInput2">District</label>
                                    <input type="text" class="form-control" name="district" placeholder="District">
                                </div>
                                <div class="form-group mb-4">
                                    <label for="exampleFormControlInput2">Pincode</label>
                                    <input type="text" class="form-control" name="postal_code" placeholder="Pincode">
                                </div>                                
                                <div class="form-group mb-4">
                                    <label for="exampleFormControlSelect1">Select State</label>
                                    <select class="form-control" name="state_id">
                                        <option value="">Select</option>
                                        <?php 
                                        if(count($states)>0) {
                                            foreach ($states as $key => $state) {
                                        ?>
                                            <option value="{{ $key }}">{{ucwords($state)}}</option>
                                          <?php 
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="exampleFormControlInput2">Status</label>
                                    <div class="check-box d-flex">
                                        <div class="checkbox radio">
                                            <label class="check-label">Active
                                               <input type="radio" value="1" name="status" class=""  checked="">
                                               <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="checkbox radio">
                                            <label class="check-label">Deactive
                                               <input type="radio" name="status" value="0">
                                               <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>                                    
                                </div>
                                    
                                <input type="submit" name="time" class="mt-4 mb-4 btn btn-primary">
                                <a class="btn btn-primary" href="{{ route('consigners.index') }}"> Back</a>
                                {!! Form::close() !!}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection