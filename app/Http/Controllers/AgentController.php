<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agent;
use App\Models\Bank;
use DB;
use URL;
use Helper;
use Validator;
use Image;
use Storage;

class AgentController extends Controller
{
    public function __construct()
    {
        $this->title =  "Agents Listing";
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
        $query = Agent::query();
        $agents = $query->orderBy('id','DESC')->paginate($peritem);
        return view('Agents.agent-list',['agents'=>$agents,'prefix'=>$this->prefix])
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
        return view('Agents.create-agent',['branches'=>$branches, 'prefix'=>$this->prefix]);
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
            'email' => 'required|unique:agents',
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

        $agentsave['branch_id']        = $request->branch_id;
        $agentsave['name']             = $request->name;
        $agentsave['email']            = $request->email;
        $agentsave['phone']            = $request->phone;
        $agentsave['gst_number']       = $request->gst_number;
        $agentsave['pan_number']       = $request->pan_number;
        $agentsave['agent_type']       = $request->agent_type;
        $agentsave['is_lane_approved'] = $request->is_lane_approved;
        $agentsave['address']          = $request->address;
        $agentsave['status']           = '1';

        // upload pan card image
        if($request->pan_card){
            $file = $request->file('pan_card');
            $path = 'public/images/pan_images';
            $name = Helper::uploadImage($file,$path);
            $agentsave['pan_card']  = $name;
        }

        // upload cancel cheque image
        if($request->cancel_cheque){
            $file = $request->file('cancel_cheque');
            $path = 'public/images/cancelcheque_images';
            $name = Helper::uploadImage($file,$path);
            $agentsave['cancel_cheque']  = $name;
        }

        $saveagent = Agent::create($agentsave); 
        if($saveagent)
        {
            $bankdetails['agent_id']           = $saveagent->id;
            $bankdetails['bank_name']          = $request->bank_name;
            $bankdetails['branch_name']        = $request->branch_name;
            $bankdetails['ifsc']               = $request->ifsc;
            $bankdetails['account_number']     = $request->account_number;
            $bankdetails['account_holdername'] = $request->account_holdername;
            

            $savebankdetails = Bank::create($bankdetails);

            $response['success'] = true;
            $response['success_message'] = "Agent Added successfully";
            $response['error'] = false;
            $response['resetform'] = true;
            $response['page'] = 'create-agent'; 
        }else{
            $response['success'] = false;
            $response['error_message'] = "Can not created agent please try again";
            $response['error'] = true;
        }
        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function show($agent)
    {
        $this->prefix = request()->route()->getPrefix();
        $id = decrypt($agent);
        $getagent = Agent::where('id',$id)->with('Agent','GetBranch')->first();
        return view('Agents.view-agent',['prefix'=>$this->prefix,'title'=>$this->title,'getagent'=>$getagent]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->prefix = request()->route()->getPrefix();
        $id = decrypt($id);      
        $branches = Helper::getBranches();            
        $getagent = Agent::where('id',$id)->with('Agent')->first();
        return view('Agents.update-agent')->with(['prefix'=>$this->prefix,'getagent'=>$getagent,'branches'=>$branches]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function updateAgent(Request $request)
    {
        try { 
            $this->prefix = request()->route()->getPrefix();
             $rules = array(
              'name' => 'required',
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

            $agentsave['branch_id']        = $request->branch_id;
            $agentsave['name']             = $request->name;
            $agentsave['email']            = $request->email;
            $agentsave['phone']            = $request->phone;
            $agentsave['gst_number']       = $request->gst_number;
            $agentsave['pan_number']       = $request->pan_number;
            $agentsave['agent_type']       = $request->agent_type;
            $agentsave['is_lane_approved'] = $request->is_lane_approved;
            $agentsave['address']          = $request->address;
            // $agentsave['pan_card']         = $request->pan_card;
            // $agentsave['cancel_cheque']    = $request->cancel_cheque;
            
            $saveagent = Agent::where('id',$request->agent_id)->update($agentsave);
            
            $bankdetails['bank_name']          = $request->bank_name;
            $bankdetails['branch_name']        = $request->branch_name;
            $bankdetails['ifsc']               = $request->ifsc;
            $bankdetails['account_number']     = $request->account_number;
            $bankdetails['account_holdername'] = $request->account_holdername;
            
            $savebankdetails = Bank::updateOrCreate(['agent_id'=>$request->agent_id],$bankdetails);

            $url    =   URL::to($this->prefix.'agents');

            $response['page'] = 'agent-update';
            $response['success'] = true;
            $response['success_message'] = "Agent Updated Successfully";
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
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function deleteAgent(Request $request)
    {
        Agent::where('id',$request->agentid)->delete();

        $response['success']         = true;
        $response['success_message'] = 'Agent deleted successfully';
        $response['error']           = false;
        return response()->json($response);
    }
}
