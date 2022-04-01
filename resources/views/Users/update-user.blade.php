@extends('layouts.main')
@section('content')

<div class="layout-px-spacing">
    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="widget-content widget-content-area br-6">
                <div class="col-lg-12 col-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">                                
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Update User</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            
                            <form class="general_form" method="POST" action="{{url($prefix.'users/update-user')}}" id="updateuser" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="user_id" value="{{$getuser->id}}">
                                
                                <div class="form-group mb-4">
                                    <label for="exampleFormControlInput2">Name</label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="{{old('name',isset($getuser->name)?$getuser->name:'')}}">
                                </div>
                                <div class="form-group mb-4">
                                    <label for="exampleFormControlInput2">Email address</label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="{{old('email',isset($getuser->email)?$getuser->email:'')}}">
                                </div>
                                <div class="form-group mb-4">
                                    <label for="exampleFormControlInput2">Password</label>
                                    <input type="text" class="form-control" name="password" id="password" placeholder="Password" value="{{old('user_password',isset($getuser->user_password)?$getuser->user_password:'')}}">
                                </div>
                                <div class="form-group mb-4">
                                    <label for="exampleFormControlInput2">Phone</label>
                                    <input type="text" class="form-control mbCheckNm" name="phone" id="phone" placeholder="" value="{{old('phone',isset($getuser->phone)?$getuser->phone:'')}}"  maxlength="10">
                                </div>
                                <div class="form-group mb-4">
                                    <label for="exampleFormControlSelect1">Select Role</label>
                                    <select name="role_id" class="form-control" id="role_id">
                                        <?php
                                        foreach ($getroles as $key => $getrole) {
                                        ?>
                                            <option value="{{$getrole->id}}" {{$getuser->role_id == $getrole->id ? 'selected' : ''}}>{{ucwords($getrole->name)}}</option>
                                        <?php } ?>                           
                                    </select>
                                </div>
                                <div class="form-group mb-4">
                                        <label for="exampleFormControlSelect1">Branch</label>
                                        <select class="form-control" name="branch_id">
                                            <option value="">Select Branch</option>
                                            <?php 
                                            if(count($branches)>0) {
                                                foreach ($branches as $k => $branch) {
                                            ?>
                                                <option value="{{ $k }}" {{ $k == $getuser->branch_id ? 'selected' : ''}}>{{ucwords($branch)}}</option>
                                              <?php 
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                <div class="form-group mb-4">
                                    <hr class="brown-border">
                                    <h4 class="mt-3 mb-3">Permissions</h4>
                                    <div class="permis checkbox selectAll"> 
                                        <label class="check-label">
                                            <?php 
                                            $usercount = count($getuserpermissions);
                                             ?>
                                            <input id="ckbCheckAll" type="checkbox" {{ ($allpermissioncount == $usercount) ? "checked" : "" }}>
                                            <span>Select All</span>
                                            <span class="checkmark" ></span>
                                        </label>
                                        <div class="row">                        
                                          <?php
                                            if(count($getpermissions)>0) {             
                                                foreach ($getpermissions as $key => $getpermission) {  
                                            ?> 
                                            <div class="col-lg-2 mt-2">
                                                <div class="checkbox">
                                                    <label class="check-label">{{ucfirst($getpermission->name)}}
                                                        <input <?php if(in_array($getpermission->id,$getuserpermissions)){ echo "checked"; } ?> type="checkbox" name="permisssion_id[]" class="chkBoxClass"     value="{{ $getpermission->id }}" {{$getuser->role_id == $getrole->id ? 'selected' : ''}} >
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </div>
                                            </div>
                                             <?php                             
                                                }  
                                            }                    
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                
                                <input type="submit" name="time" class="mt-4 mb-4 btn btn-primary">
                                <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
                            </form>            

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection