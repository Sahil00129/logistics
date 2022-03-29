@extends('layouts.main')
@section('content')

<div class="layout-px-spacing">
    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="widget-content widget-content-area br-6">
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="breadcrumb-title pe-3"><h5>Update Agent</h5></div>
                    
                </div>
                <div class="col-lg-12 col-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-content widget-content-area">
                            <form class="general_form" method="POST" action="{{url($prefix.'agents/update-agent')}}" id="updateagent">
                                @csrf
                                <input type="hidden" name="agent_id" value="{{$getagent->id}}">

                                <div class="form-row mb-0">
                                    <div class="form-group col-md-6">
                                        <label for="exampleFormControlInput2">Agent Name</label>
                                        <input type="text" class="form-control" name="name" value="{{old('name',isset($getagent->name)?$getagent->name:'')}}" placeholder="Name">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="exampleFormControlInput2">Select Branch</label>
                                        <select class="form-control" name="branch_id">
                                            <option value="">Select</option>
                                            <?php 
                                            if(count($branches)>0) {
                                                foreach ($branches as $k => $branch) {
                                            ?>
                                                <option value="{{ $k }}" {{ $k == $getagent->branch_id ? 'selected' : ''}}>{{ucwords($branch)}}</option> 
                                              <?php 
                                                }
                                            }
                                            ?>                            
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row mb-0">
                                    <div class="form-group col-md-6">
                                        <label for="exampleFormControlInput2">Email ID</label>
                                        <input type="email" class="form-control" name="email" value="{{old('email',isset($getagent->email)?$getagent->email:'')}}" placeholder="Email">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="exampleFormControlInput2">Phone</label>
                                        <input type="text" class="form-control mbCheckNm" name="phone" value="{{old('phone',isset($getagent->phone)?$getagent->phone:'')}}" placeholder="Phone" maxlength="10">
                                    </div>
                                </div>
                                <div class="form-row mb-0">
                                    <div class="form-group col-md-6">
                                        <label for="exampleFormControlInput2">GST No.</label>
                                        <input type="text" class="form-control" name="gst_number" value="{{old('gst_number',isset($getagent->gst_number)?$getagent->gst_number:'')}}" placeholder="">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="exampleFormControlInput2">Pan No.</label>
                                        <input type="text" class="form-control" name="pan_number" value="{{old('pan_number',isset($getagent->pan_number)?$getagent->pan_number:'')}}" placeholder="">
                                    </div>
                                </div>
                                <div class="form-row mb-0">
                                    <div class="form-group col-md-6">
                                        <label for="exampleFormControlSelect1">Agent Type</label>
                                        <select class="form-control" name="agent_type">
                                            <option value="">Select</option>
                                            <option value="1" {{$getagent->agent_type == '1' ? 'selected' : ''}}>Contracted</option>
                                            <option value="0" {{$getagent->agent_type == '0' ? 'selected' : ''}}>Non-Contracted</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="exampleFormControlSelect1">Required Lane Wise Approval</label>
                                        <select class="form-control" name="is_lane_approved">
                                            <option value="">Select</option>
                                            <option value="1" {{$getagent->is_lane_approved == '1' ? 'selected' : ''}}>Yes</option>
                                            <option value="0" {{$getagent->is_lane_approved == '0' ? 'selected' : ''}}>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="exampleFormControlInput2">Address</label>
                                    <textarea type="" class="form-control" name="address" value="{{old('address',isset($getagent->address)?$getagent->address:'')}}" placeholder="" cols="5" rows="5"></textarea>
                                </div>
                                <h4>Bank Details</h4>
                                <div class="form-row mb-0">
                                    <div class="form-group col-md-6">
                                        <label for="exampleFormControlInput2">Bank Name</label>
                                        <input type="text" class="form-control" name="bank_name" value="{{old('bank_name',isset($getagent->Agent->bank_name)?$getagent->Agent->bank_name:'')}}" placeholder="">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="exampleFormControlInput2">Branch Name</label>
                                        <input type="text" class="form-control" name="branch_name" value="{{old('branch_name',isset($getagent->Agent->branch_name)?$getagent->Agent->branch_name:'')}}" placeholder="">
                                    </div>
                                </div>
                                <div class="form-row mb-0">
                                    <div class="form-group col-md-6">
                                        <label for="exampleFormControlInput2">IFSC</label>
                                        <input type="text" class="form-control" name="ifsc" value="{{old('ifsc',isset($getagent->Agent->ifsc)?$getagent->Agent->ifsc:'')}}" placeholder="">
                                    </div> 
                                    <div class="form-group col-md-6">
                                        <label for="exampleFormControlInput2">Account No</label>
                                        <input type="text" class="form-control" name="account_number" value="{{old('account_number',isset($getagent->Agent->account_number)?$getagent->Agent->account_number:'')}}" placeholder="">
                                    </div>
                                </div>
                                <div class="form-row mb-0">
                                    <div class="form-group col-md-6">
                                        <label for="exampleFormControlInput2">Account Holder Name</label>
                                        <input type="text" class="form-control" name="account_holdername" value="{{old('account_holdername',isset($getagent->Agent->account_holdername)?$getagent->Agent->account_holdername:'')}}" placeholder="">
                                    </div>
                                </div>
                                <div class="form-row mb-0">
                                    <div class="form-group col-md-6">
                                        <label for="exampleFormControlInput2">Pan Card</label>
                                        <input type="file" class="form-control" name="pan_card" value="{{old('pan_card',isset($getagent->pan_card)?$getagent->pan_card:'')}}" placeholder="">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="exampleFormControlInput2">Cancel Cheque</label>
                                        <input type="file" class="form-control" name="cancel_cheque" value="{{old('cancel_cheque',isset($getagent->cancel_cheque)?$getagent->cancel_cheque:'')}}" placeholder="">
                                    </div>
                                </div>

                                <input type="submit" class="mt-4 mb-4 btn btn-primary">
                                <a class="btn btn-primary" href="{{ route('agents.index') }}"> Back</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection