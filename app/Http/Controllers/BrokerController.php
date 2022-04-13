<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Broker;
use App\Models\Bank;
use DB;
use URL;
use Auth;
use Helper;
use Validator;
use Image;
use Storage;

class BrokerController extends Controller
{
    public function __construct()
    {
        $this->title =  "Brokers Listing";
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
        $query = Broker::query();
        $authuser = Auth::user();
        if($authuser->role_id == 2){
            $brokers = $query->where('branch_id',$authuser->branch_id)->orderBy('id','DESC')->paginate($peritem);
        }else{
            $brokers = $query->orderBy('id','DESC')->paginate($peritem);
        }
        return view('Brokers.broker-list',['brokers'=>$brokers,'prefix'=>$this->prefix])
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
        $branches = Helper::getBranches();
        return view('Brokers.create-broker',['branches'=>$branches, 'prefix'=>$this->prefix]);
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
            'email' => 'required|unique:brokers',
            'pan_card' => 'mimes:jpg,jpeg,png|max:4096',
            'cancel_cheque' => 'mimes:jpg,jpeg,png|max:4096',
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

        $brokersave['branch_id']        = $request->branch_id;
        $brokersave['name']             = $request->name;
        $brokersave['email']            = $request->email;
        $brokersave['phone']            = $request->phone;
        $brokersave['gst_number']       = $request->gst_number;
        $brokersave['pan_number']       = $request->pan_number;
        $brokersave['broker_type']      = $request->broker_type;
        $brokersave['is_lane_approved'] = $request->is_lane_approved;
        $brokersave['address']          = $request->address;
        $brokersave['status']           = '1';

        // upload pan card image
        if($request->pan_card){
            $file = $request->file('pan_card');
            $path = 'public/images/pancard_images';
            $name = Helper::uploadImage($file,$path);
            $brokersave['pan_card']  = $name;
        }
        // upload cancel cheque image
        if($request->cancel_cheque){
            $file = $request->file('cancel_cheque');
            $path = 'public/images/cancelcheque_images';
            $name = Helper::uploadImage($file,$path);
            $brokersave['cancel_cheque']  = $name;
        }
        $savebroker = Broker::create($brokersave);
        if($savebroker)
        {
            $bankdetails['broker_id']          = $savebroker->id;
            $bankdetails['bank_name']          = $request->bank_name;
            $bankdetails['branch_name']        = $request->branch_name;
            $bankdetails['ifsc']               = $request->ifsc;
            $bankdetails['account_number']     = $request->account_number;
            $bankdetails['account_holdername'] = $request->account_holdername;
            $bankdetails['status']             = "0";
            
            $savebankdetails = Bank::create($bankdetails);

            $response['success'] = true;
            $response['success_message'] = "Broker Added successfully";
            $response['error'] = false;
            $response['resetform'] = true;
            $response['page'] = 'create-broker'; 
        }else{
            $response['success'] = false;
            $response['error_message'] = "Can not created broker please try again";
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
    public function show($broker)
    {
        $this->prefix = request()->route()->getPrefix();
        $id = decrypt($broker);
        // $getbroker = Broker::where('id',$id)->with('BankDetail','GetBranch')->first();
        $getbroker = Broker::where('id',$id)->with('GetBranch')->with(['BankDetail'=> function($query){
            $query->where('status',0);
        }])->first();

        return view('Brokers.view-broker',['prefix'=>$this->prefix,'title'=>$this->title,'getbroker'=>$getbroker]);
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
        $branches = Helper::getBranches();            
        // $getbroker = Broker::where('id',$id)->with('BankDetail')->first();
        $getbroker = Broker::where('id',$id)->with(['BankDetail'=> function($query){
            $query->where('status',0);
        }])->first();
        return view('Brokers.update-broker')->with(['prefix'=>$this->prefix,'getbroker'=>$getbroker,'branches'=>$branches]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateBroker(Request $request)
    {
        try { 
            $this->prefix = request()->route()->getPrefix();
            $rules = array(
                'name' => 'required',
                'email'  => 'required',
                'pan_card' => 'mimes:jpg,jpeg,png|max:4096',
                'cancel_cheque' => 'mimes:jpg,jpeg,png|max:4096',
            );

            $validator = Validator::make($request->all(),$rules);

            if($validator->fails())
            {
                $errors                  = $validator->errors();
                $response['success']     = false;
                $response['formErrors']  = true;
                $response['errors']      = $errors;
                return response()->json($response);
            }

            $brokersave['branch_id']        = $request->branch_id;
            $brokersave['name']             = $request->name;
            $brokersave['email']            = $request->email;
            $brokersave['phone']            = $request->phone;
            $brokersave['gst_number']       = $request->gst_number;
            $brokersave['pan_number']       = $request->pan_number;
            $brokersave['broker_type']       = $request->broker_type;
            $brokersave['is_lane_approved'] = $request->is_lane_approved;
            $brokersave['address']          = $request->address;
            
            // upload pan_card images
            if($request->pan_card){
                $file = $request->file('pan_card');
                $path = 'public/images/pancard_images';
                $name = Helper::uploadImage($file,$path); 
                $brokersave['pan_card']  = $name;
            }

            // upload cancel_cheque images
            if($request->cancel_cheque){   
                $file = $request->file('cancel_cheque');
                $path = 'public/images/cancelcheque_images';
                $name = Helper::uploadImage($file,$path); 
                $brokersave['cancel_cheque']  = $name;
            }
            
            $savebroker = Broker::where('id',$request->broker_id)->update($brokersave);
            if($savebroker)
            {
                $bankdetails['bank_name']          = $request->bank_name;
                $bankdetails['branch_name']        = $request->branch_name;
                $bankdetails['ifsc']               = $request->ifsc;
                $bankdetails['account_number']     = $request->account_number;
                $bankdetails['account_holdername'] = $request->account_holdername;
                $bankdetails['status']             = "0";
                
                $savebankdetails = Bank::updateOrCreate(['broker_id'=>$request->broker_id],$bankdetails);

                $url    =   URL::to($this->prefix.'brokers');

                $response['page'] = 'broker-update';
                $response['success'] = true;
                $response['success_message'] = "Broker Updated Successfully";
                $response['error'] = false;
                $response['redirect_url'] = $url;
            }
        }catch(Exception $e) {
            $response['error'] = false;
            $response['error_message'] = $e;
            $response['success'] = false;
            $response['redirect_url'] = $url;   
        }
        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteBroker(Request $request)
    {
        Broker::where('id',$request->brokerid)->delete();

        $response['success']         = true;
        $response['success_message'] = 'Broker deleted successfully';
        $response['error']           = false;
        return response()->json($response);
    }

    // Delete pancard and cancel cheque image from edit view
    public function deletebrokerImage(Request $request)
    {
        if($request->cancelchequeimg=="del-pancardimg") {
            $path = 'public/images/pancard_images';
            $image_path=Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix().$path;   
            $getimagename = Broker::where('id',$request["brokerimgid"])->first(); 

            $image_path=$image_path.'/'.$getimagename->pan_card;
            if (\File::exists($image_path)) {

                unlink($image_path);
            }
            $deleteimage = Broker::where('id',$request->brokerimgid)->update(['pan_card'=>null]); 

            $response['success']         = true;
            $response['success_message'] = 'Pancard Image deleted successfully';
            $response['error']           = false;
            $response['delpan_card']     = "delpan_card";

        } else {
            $path = 'public/images/cancelcheque_images';
            $image_path=Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix().$path;      
            $getimagename = Broker::where('id',$request["brokerimgid"])->first();

            $image_path = $image_path.'/'.$getimagename->cancel_cheque;
            if (\File::exists($image_path)) {
                unlink($image_path);
            }
            $deleteimage = Broker::where('id',$request->brokerimgid)->update(['cancel_cheque'=>null]);

            $response['success']         = true;
            $response['success_message'] = 'Cancel cheque Image deleted successfully';
            $response['error']           = false;
        }
      return response()->json($response);     
    }

}
