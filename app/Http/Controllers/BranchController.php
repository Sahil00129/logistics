<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\State;
use DB;
use URL;
use Helper;
use Validator;

class BranchController extends Controller
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
        $query = Branch::query();
        $branches = $query->orderBy('id','DESC')->with('State')->paginate($peritem);
        return view('Branch.branch-list',['branches'=>$branches,'prefix'=>$this->prefix])
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
        return view('Branch.create-branch',['states'=>$states, 'prefix'=>$this->prefix]);
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
            // 'email'      => ['required', 'string', 'email', 'max:255', 'unique:users'],
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

        $branchsave['name']             = $request->name;
        $branchsave['address_line1']    = $request->address_line1;
        $branchsave['address_line2']    = $request->address_line2;
        $branchsave['address_line3']    = $request->address_line3;
        $branchsave['gstin_number']     = $request->gstin_number;
        $branchsave['city']             = $request->city;
        $branchsave['district']         = $request->district;
        $branchsave['postal_code']      = $request->postal_code;
        $branchsave['state_id']         = $request->state_id;
        $branchsave['consignment_note'] = $request->consignment_note;
        $branchsave['email']            = $request->email;
        $branchsave['phone']            = $request->phone;
        $branchsave['status']           = $request->status;          

        $savebranch = Branch::create($branchsave); 
        if($savebranch)
        {
            $response['success'] = true;
            $response['success_message'] = "Branch Added successfully";
            $response['error'] = false;
            $response['resetform'] = true;
            $response['page'] = 'create-branch'; 
        }else{
            $response['success'] = false;
            $response['error_message'] = "Can not created branch please try again";
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
    public function show($branch)
    {
        $this->prefix = request()->route()->getPrefix();
        $id = decrypt($branch);
        $getbranch = Branch::where('id',$id)->with('GetState')->first();
        return view('Branch.view-branch',['prefix'=>$this->prefix,'title'=>$this->title,'getbranch'=>$getbranch]);
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
        $states = Helper::getStates();            
        $getbranch = Branch::where('id',$id)->first();
        return view('Branch.update-branch')->with(['prefix'=>$this->prefix,'getbranch'=>$getbranch,'states'=>$states]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateBranch(Request $request)
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

            $branchsave['name']             = $request->name;
            $branchsave['address_line1']    = $request->address_line1;
            $branchsave['address_line2']    = $request->address_line2;
            $branchsave['address_line3']    = $request->address_line3;
            $branchsave['gstin_number']     = $request->gstin_number;
            $branchsave['city']             = $request->city;
            $branchsave['district']         = $request->district;
            $branchsave['postal_code']      = $request->postal_code;
            $branchsave['state_id']         = $request->state_id;
            $branchsave['consignment_note'] = $request->consignment_note;
            $branchsave['email']            = $request->email;
            $branchsave['phone']            = $request->phone;
            $branchsave['status']           = $request->status;
            
            Branch::where('id',$request->branch_id)->update($branchsave);
            $url    =   URL::to($this->prefix.'branches');

            $response['page'] = 'branch-update';
            $response['success'] = true;
            $response['success_message'] = "Branch Updated Successfully";
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteBranch(Request $request)
    {
        Branch::where('id',$request->branchid)->delete();

        $response['success']         = true;
        $response['success_message'] = 'Branch deleted successfully';
        $response['error']           = false;
        return response()->json($response);
    }
}
