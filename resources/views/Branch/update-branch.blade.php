@extends('layouts.main')
@section('content')

<div class="layout-px-spacing">
    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="widget-content widget-content-area br-6">
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="breadcrumb-title pe-3"><h5>Update branch</h5></div>
                    
                </div>
                <div class="col-lg-12 col-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-content widget-content-area">
                            <form class="general_form" method="POST" action="{{url($prefix.'branches/update-branch')}}" id="updatebranch">
                                @csrf
                                <input type="hidden" name="branch_id" value="{{$getbranch->id}}">

                                <div class="form-group mb-4">
                                    <label for="exampleFormControlInput2">Branch Name</label>
                                    <input type="text" class="form-control" name="name" value="{{old('name',isset($getbranch->name)?$getbranch->name:'')}}" placeholder="Name">
                                </div>
                                <div class="form-group mb-4">
                                    <label for="exampleFormControlInput2">Address Line 1</label>
                                    <input type="text" class="form-control" name="address_line1" value="{{old('address_line1',isset($getbranch->address_line1)?$getbranch->address_line1:'')}}" placeholder="Address Line 1">
                                </div>
                                <div class="form-group mb-4">
                                    <label for="exampleFormControlInput2">Address Line 2</label>
                                    <input type="text" class="form-control" name="address_line2" value="{{old('address_line2',isset($getbranch->address_line2)?$getbranch->address_line2:'')}}" placeholder="Address Line 2">
                                </div>
                                <div class="form-group mb-4">
                                    <label for="exampleFormControlInput2">Address Line 3</label>
                                    <input type="text" class="form-control" name="address_line3" value="{{old('address_line3',isset($getbranch->address_line3)?$getbranch->address_line3:'')}}" placeholder="Address Line 3">
                                </div>
                                <div class="form-group mb-4">
                                    <label for="exampleFormControlInput2">GSTIN No.</label>
                                    <input type="text" class="form-control" name="gstin_number" value="{{old('gstin_number',isset($getbranch->gstin_number)?$getbranch->gstin_number:'')}}" placeholder="GSTIN No">
                                </div>
                                <div class="form-group mb-4">
                                    <label for="exampleFormControlInput2">City</label>
                                    <input type="text" class="form-control" name="city" value="{{old('city',isset($getbranch->city)?$getbranch->city:'')}}" placeholder="City">
                                </div>
                                <div class="form-group mb-4">
                                    <label for="exampleFormControlInput2">District</label>
                                    <input type="text" class="form-control" name="district" value="{{old('district',isset($getbranch->district)?$getbranch->district:'')}}" placeholder="District">
                                </div>
                                <div class="form-group mb-4">
                                    <label for="exampleFormControlInput2">Pincode</label>
                                    <input type="text" class="form-control" name="postal_code" value="{{old('postal_code',isset($getbranch->postal_code)?$getbranch->postal_code:'')}}" placeholder="Pincode">
                                </div>                                
                                <div class="form-group mb-4">
                                    <label for="exampleFormControlSelect1">Select State</label>
                                    <select class="form-control" name="state_id">
                                        <option value="">Select</option>
                                        <?php 
                                        if(count($states)>0) {
                                            foreach ($states as $k => $state) {
                                        ?>
                                            <option value="{{ $k }}" {{ $k == $getbranch->state_id ? 'selected' : ''}}>{{ucwords($state)}}</option> 
                                          <?php 
                                            }
                                        }
                                        ?>                            
                                    </select>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="exampleFormControlInput2">Consignment Note</label>
                                    <input type="text" class="form-control" name="consignment_note" value="{{old('consignment_note',isset($getbranch->consignment_note)?$getbranch->consignment_note:'')}}" placeholder="Pincode">
                                </div>
                                <div class="form-group mb-4">
                                    <label for="exampleFormControlInput2">Email ID</label>
                                    <input type="email" class="form-control" name="email" value="{{old('email',isset($getbranch->email)?$getbranch->email:'')}}" placeholder="Email">
                                </div>
                                <div class="form-group mb-4">
                                    <label for="exampleFormControlInput2">Telephone</label>
                                    <input type="text" class="form-control" name="phone" value="{{old('phone',isset($getbranch->phone)?$getbranch->phone:'')}}" placeholder="Phone">
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
                                <input type="submit" class="mt-4 mb-4 btn btn-primary">
                                <a class="btn btn-primary" href="{{ route('branches.index') }}"> Back</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection