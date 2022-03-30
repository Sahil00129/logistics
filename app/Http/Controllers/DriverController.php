<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Driver;
use DB;
use URL;
use Helper;
use Validator;
use Image;
use Storage;

class DriverController extends Controller
{
    public function __construct()
    {
        $this->title =  "Drivers Listing";
        $this->segment = \Request::segment(2);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->prefix = request()->route()->getPrefix();
        $peritem = 20;
        $query = Driver::query();
        $drivers = $query->orderBy('id','DESC')->paginate($peritem);
        return view('Drivers.driver-list',['drivers'=>$drivers,'prefix'=>$this->prefix])
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->prefix = request()->route()->getPrefix();
        return view('Drivers.create-driver',['prefix'=>$this->prefix]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->prefix = request()->route()->getPrefix();
        $rules = array(
            'name' => 'required',
            'license_image' => 'mimes:jpg,jpeg,png|max:4096',
        );
        $validator = Validator::make($request->all(),$rules);
    
        if($validator->fails())
        {
            $errors                  = $validator->errors();
            $response['success']     = false;
            $response['validation']  = false;
            $response['formErrors']  = true;
            $response['errors']      = $errors;
            return response()->json($response);
        }

        $driversave['name']             = $request->name;
        $driversave['phone']            = $request->phone;
        $driversave['license_number']   = $request->license_number;
        $driversave['status']           = '1';

        // upload pan card image
        if($request->license_image){
            $file = $request->file('license_image');
            $path = 'public/images/driverlicense_images';
            $name = Helper::uploadImage($file,$path);
            $driversave['license_image']  = $name;
        }

        $savedriver = Driver::create($driversave); 
        if($savedriver)
        {

            $response['success'] = true;
            $response['success_message'] = "Driver Added successfully";
            $response['error'] = false;
            $response['resetform'] = true;
            $response['page'] = 'create-driver'; 
        }else{
            $response['success'] = false;
            $response['error_message'] = "Can not created driver please try again";
            $response['error'] = true;
        }
        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->prefix = request()->route()->getPrefix();
        $id = decrypt($id);            
        $getdriver = Driver::where('id',$id)->first();
        return view('Drivers.update-driver')->with(['prefix'=>$this->prefix,'getdriver'=>$getdriver]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateDriver(Request $request)
    {
        try { 
            $this->prefix = request()->route()->getPrefix();
             $rules = array(
              'name' => 'required',
              'license_image' => 'mimes:jpg,jpeg,png|max:4096',
            );

            $validator = Validator::make($request->all(),$rules);

            if($validator->fails())
            {
                $errors                 = $validator->errors();
                $response['success']    = false;
                $response['formErrors'] = true;
                $response['errors']     = $errors;
                return response()->json($response);
            }

            $driversave['name']           = $request->name;
            $driversave['phone']          = $request->phone;
            $driversave['license_number'] = $request->license_number;
            
            $savedriver = Driver::where('id',$request->driver_id)->update($driversave);

            $url    =   URL::to($this->prefix.'drivers');

            $response['page']            = 'driver-update';
            $response['success']         = true;
            $response['success_message'] = "Driver Updated Successfully";
            $response['error']           = false;
            $response['redirect_url']    = $url;
            // $response['html'] = $html;
        }catch(Exception $e) {
            $response['error']         = false;
            $response['error_message'] = $e;
            $response['success']       = false;
            $response['redirect_url']  = $url;   
        }
        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteDriver(Request $request)
    {
        Driver::where('id',$request->driverid)->delete();

        $response['success']         = true;
        $response['success_message'] = 'Driver deleted successfully';
        $response['error']           = false;
        return response()->json($response);
    }
}
