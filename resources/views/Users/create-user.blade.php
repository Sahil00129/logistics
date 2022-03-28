@extends('layouts.main')
@section('content')

<div class="layout-px-spacing">
    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="widget-content widget-content-area br-6">
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="breadcrumb-title pe-3">Users</div>
                    <div class="ps-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0">
                                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Create new user</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- <div class="ms-auto">
                        <div class="btn-group">
                            <a href="{{ route('users.index') }}" class="btn btn-primary pull-right">All User</a>
                        </div>
                    </div> -->
                </div>
                <div class="col-lg-12 col-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">                                
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Create New User</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            {!! Form::open(array('route' => 'users.store','method'=>'POST', 'id'=>'createuser', 'class'=>'general_form')) !!}
                            <!-- <form class="general_form" method="POST" action="{{url($prefix.'users')}}" id="createuser"> -->
                                
                                <div class="form-group mb-4">
                                    <label for="exampleFormControlInput2">Name</label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                                </div>
                                <div class="form-group mb-4">
                                    <label for="exampleFormControlInput2">Email address</label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                                </div>
                                <div class="form-group mb-4">
                                    <label for="exampleFormControlInput2">Password</label>
                                    <input type="text" class="form-control" name="password" id="password" placeholder="Password">
                                </div>
                                <div class="form-group mb-4">
                                    <label for="exampleFormControlInput2">Confirm Password</label>
                                    <input type="text" class="form-control" name="confirm-password" id="confirm-password" placeholder="Confirm Password">
                                </div>
                                <div class="form-group mb-4">
                                    <label for="exampleFormControlSelect1">Select Role</label>
                                    <select name="role_id" class="form-control" id="role_id">
                                        <option value="">Select</option>
                                        <?php 
                                        if(count($getroles)>0) {
                                            foreach ($getroles as $key => $getrole) {  
                                        ?> 
                                        <option value="{{ $getrole->id }}">{{ucwords($getrole->name)}}</option> 
                                      <?php 
                                        }
                                    }
                                    ?>                            
                                    </select>
                                </div>
                                    <div class="form-group mb-4">
                                        <hr class="brown-border">
                                    <h4 class="mt-3 mb-3">Permissions</h4>
                                    <div class="checkbox selectAll">
                                        <label class="check-label">Select All
                                            <input id="ckbCheckAll" type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="permis">
                                        <div class="row">
                                            <?php 
                                            if(count($getpermissions)>0) {
                                                foreach ($getpermissions as $key => $getpermission) {  
                                            ?> 
                                            <div class="col-lg-2 mt-2">
                                                <div class="checkbox">
                                                    <label class="check-label">{{ucfirst($getpermission->name)}}
                                                        <input type="checkbox" name="permisssion_id[]" value="{{ $getpermission->id }}" class="chkBoxClass">
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
                                {!! Form::close() !!}
                            <!-- </form> -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection