<?php

namespace App\Http\Controllers;

use App\Models\Consigner;
use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\State;
use DB;
use URL;
use Helper;
use Validator;

class ConsignerController extends Controller
{
    public function __construct()
    {
      $this->title =  "Branches Listing";
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
        $query = Consigner::query();
        $consigners = $query->orderBy('id','DESC')->with('State')->paginate($peritem);
        return view('Consigners.consigner-list',['consigners'=>$consigners,'prefix'=>$this->prefix])
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
        $states = Helper::getStates();
        $branches = Helper::getBranches();
        return view('Consigners.create-consigner',['states'=>$states, 'branches'=>$branches, 'prefix'=>$this->prefix]);
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
            'nick_name' => 'required',
            'email' => 'required|unique:branches',
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
        $consignersave['nick_name']      = $request->nick_name;
        $consignersave['legal_name']     = $request->legal_name;
        $consignersave['gst_number']     = $request->gst_number;
        $consignersave['contact_name']   = $request->contact_name;
        $consignersave['phone']          = $request->phone;
        $consignersave['branch_id']      = $request->branch_id;
        $consignersave['email']          = $request->email;
        $consignersave['address_line1']  = $request->address_line1;
        $consignersave['address_line2']  = $request->address_line2;
        $consignersave['address_line3']  = $request->address_line3;
        $consignersave['city']           = $request->city;
        $consignersave['district']       = $request->district;
        $consignersave['postal_code']    = $request->postal_code;
        $consignersave['state_id']       = $request->state_id;
        $consignersave['status']         = $request->status;

        $saveconsigner = Consigner::create($consignersave); 
        if($saveconsigner)
        {
            $response['success'] = true;
            $response['success_message'] = "Consigner Added successfully";
            $response['error'] = false;
            $response['resetform'] = true;
            $response['page'] = 'create-consigner'; 
        }else{
            $response['success'] = false;
            $response['error_message'] = "Can not created consigner please try again";
            $response['error'] = true;
        }
        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Consigner  $consigner
     * @return \Illuminate\Http\Response
     */
    public function show(Consigner $consigner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Consigner  $consigner
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->prefix = request()->route()->getPrefix();
        $id = decrypt($id);      
        $states = Helper::getStates();
        $branches = Helper::getBranches();         
        $getconsigner = Consigner::where('id',$id)->first();
        return view('Consigners.update-consigner')->with(['prefix'=>$this->prefix,'getconsigner'=>$getconsigner,'states'=>$states,'branches'=>$branches]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Consigner  $consigner
     * @return \Illuminate\Http\Response
     */
    public function updateConsigner(Request $request)
    {
        try { 
            $this->prefix = request()->route()->getPrefix();
             $rules = array(
              'nick_name' => 'required',
              'email'  => 'required',
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

            $consignersave['nick_name']      = $request->nick_name;
            $consignersave['legal_name']     = $request->legal_name;
            $consignersave['gst_number']     = $request->gst_number;
            $consignersave['contact_name']   = $request->contact_name;
            $consignersave['phone']          = $request->phone;
            $consignersave['branch_id']      = $request->branch_id;
            $consignersave['email']          = $request->email;
            $consignersave['address_line1']  = $request->address_line1;
            $consignersave['address_line2']  = $request->address_line2;
            $consignersave['address_line3']  = $request->address_line3;
            $consignersave['city']           = $request->city;
            $consignersave['district']       = $request->district;
            $consignersave['postal_code']    = $request->postal_code;
            $consignersave['state_id']       = $request->state_id;
            $consignersave['status']         = $request->status;
            
            Consigner::where('id',$request->consigner_id)->update($consignersave);
            $url    =   URL::to($this->prefix.'consigners');

            $response['page'] = 'consigner-update';
            $response['success'] = true;
            $response['success_message'] = "Consigner Updated Successfully";
            $response['error'] = false;
            // $response['html'] = $html;
            $response['redirect_url'] = $url;
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
     * @param  \App\Models\Consigner  $consigner
     * @return \Illuminate\Http\Response
     */
    public function deleteConsigner(Request $request)
    {
        Consigner::where('id',$request->consignerid)->delete();

        $response['success']         = true;
        $response['success_message'] = 'Consigner deleted successfully';
        $response['error']           = false;
        return response()->json($response);
    }
}
