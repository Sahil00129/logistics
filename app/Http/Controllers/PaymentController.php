<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VehicleCapacity;
use App\Models\Maplocation;
use App\Models\PaymentHistory;
use App\Models\StopHistory;
use App\Models\Branch;
use App\Models\User;
use GoogleMaps;
use Validator;
use Auth;
use DB;

class PaymentController extends Controller
{
    public $prefix;
    public $title;
    public $segment;

    public function __construct()
    {
      $this->title =  "Payments";
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
        $query = Maplocation::query();
        $payments = $query->orderBy('id','DESC')->with('PaymentHistory')->paginate($peritem);
        // dd($payments);
        return view('Payments.payment-list',['prefix'=>$this->prefix,'title'=>$this->title,'segment'=>$this->segment,'payments'=>$payments])->with('i', ($request->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->prefix = request()->route()->getPrefix();

        $vehicle_capacity = VehicleCapacity::get();
        return view('Payments.create-payment',['prefix'=>$this->prefix,'title'=>$this->title,'segment'=>$this->segment,'vehicle_capacity'=>$vehicle_capacity]);        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        // dd($request->toArray());
        try{
            DB::beginTransaction();

        $this->prefix = request()->route()->getPrefix();
        $rules = array(
            'origin' => 'required',
            'destination' => 'required',
            
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
        if(!empty($request->origin)){
            $locationsave['origin']   = $request->origin;
        }
        if(!empty($request->destination)){
            $locationsave['destination']  = $request->destination;
        }
        if(!empty($request->number_stops)){
            $locationsave['number_stops']  = $request->number_stops;
        }

        $savelocation = Maplocation::create($locationsave);

        if($savelocation)
        {
            $paymentdetails['maplocation_id'] = $savelocation->id;
            $paymentdetails['vehcapacity_id'] = $request->vehcapacity_id;
            $paymentdetails['payment_type']   = $request->payment_type;
            $paymentdetails['payment_to']     = $request->payment_to;
            $paymentdetails['purchase_price'] = $request->purchase_price;
            $paymentdetails['advance_payment']= $request->advance_payment;
            $paymentdetails['pending_payment']= $request->pending_payment;

            $savepayments = PaymentHistory::create($paymentdetails);
            if(!empty($request['lr_number'])){
                foreach($request['lr_number'] as $key => $lrnum) 
                {
                    $data[$key]['payment_id'] = $savepayments->id;
                    $data[$key]['lr_number'] = $lrnum;
                    $data[$key]['lr_date'] = $request['lr_date'][$key];
                    $data[$key]['gross_wt'] = $request['gross_wt'][$key];
                    $data[$key]['truck_number'] = $request['truck_number'][$key];
                    $data[$key]['invoice_number'] = $request['invoice_number'][$key];
                }
                $savepayments->stops()->insert($data);
            }
            $response['success'] = true;
            $response['success_message'] = "Payment Added successfully";
            $response['error'] = false;
            $response['resetform'] = true;
            $response['page'] = 'payments'; 
        }else{
            $response['success'] = false;
            $response['error_message'] = "Can not created payment please try again";
            $response['error'] = true;
        }
        DB::commit();
        }catch(Exception $e){
            $response['error'] = false;
            $response['error_message'] = $e;
            $response['success'] = false;
            $response['redirect_url'] = $url;
        }
        return response()->json($response);
    }

    public function getAssigned() 
    {
        $city = explode(',', $_POST['org']);
        $id = Auth::user()->branch_id;
        $ub = User::select('branch_id')->where('branch_id', $id)->get();
        $res = $ub->toArray();
        if(!empty($res)){
            $bid = $ub[0]->branch_id;
            $ids = str_split(str_replace(',', '', $bid));
            
            $bname = Branch::select('id','name','city')->whereIn('id', $ids)->where('city', 'like', $city[0].'%')->get();
            $assigned =  $bname->toArray();
           // dd($assigned);
            if(!empty($assigned)) {
            // echo "<pre>";print_r($assigned);die;   
                return response()->json(['success'=>true]);
            }
            else{
                // echo "<p class='text-danger'>No branch assigned</p>";
                $html = "<p class='text-danger'>No branch assigned</p>";
                return response()->json(['success'=>false, 'error_msg'=>$html]);
            }
        }
        else{
            // echo "<p class='text-danger'>No branch assigned</p>";
            $html = "<p class='text-danger'>No branch assigned</p>";
            return response()->json(['success'=>false, 'error_msg'=>$html]);
        }
    }

    public function get_destination() 
    {
        $city = explode(',', $_POST['dest']);
        $bname = Branch::select('id','name','city')->where('city', 'like', $city[0].'%')->get();
        $available =  $bname->toArray();
        //echo "<pre>";print_r($available);die;
        if(!empty($available)) {
            return response()->json(['success'=>true]);
        }
        else{
            echo "<p class='text-danger'>No branch assigned in the selected city</p>";
        }

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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}


