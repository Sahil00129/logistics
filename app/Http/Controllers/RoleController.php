<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use DB;
use URL;
use Validator;

class RoleController extends Controller
{
    public $prefix;
    public $title;

    public function __construct()
    {
      $this->title =  "Roles Listing";
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
        $query = Role::query();
        $roles = $query->orderBy('id','DESC')->paginate($peritem);
        return view('Roles.role-list',['roles'=>$roles,'prefix'=>$this->prefix])
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addRole(Request $request)
    {
        if(!empty($request->id)){
            $rules = array(
                'name'     => 'required|unique:roles,id',
            );
        }else{
            $rules = array(
                'name'     => 'required|unique:roles',
            );
        }
        $inputs = $request->all();
        $inputs['name'] = $request->name;

        $validator = Validator::make($request->all() , $rules);
        if ($validator->fails())
        {
            $a['name'] ="This name already exists";
            $errors                  = $validator->errors();
            $response['success']     = false;
            $response['formErrors']  = true;
            $response['errors']      = $a;
            return response()->json($response);
        }

        if(!empty($request->name)){
            $role['name'] = $request->name;
        }
        $role['slug'] = $request->name;
        $role['status'] = "1";
        $saverole = Role::updateOrCreate(['id'=>$request->id],$role);
        if($saverole){
            $getRoles = Role::where('status','1')->orderby('id','desc')->pluck('id','name')->toArray();
            $url    =   URL::to($this->prefix.'roles');
           
            $response['success'] = true;
            $response['page'] = 'role';
            $response['rolepage'] = $request->rolepage;
            $response['data'] = $saverole;
            $response['alldata'] = $getRoles;
             $response['success_message'] = "Role added successfully";
            $response['error'] = false;
            $response['redirect_url'] = $url;
        }else{
            $response['success'] = false;
            $response['error_message'] = "Can not added role please try again";
            $response['error'] = true;
        }
        return response()->json($response);
        
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editRole(Request $request)
    {
        $getdata = Role::where('id',$request->id)->first();
        return response()->json(['data'=>$getdata,'success'=>true]);
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
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);
    
        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();
    
        $role->syncPermissions($request->input('permission'));
    
        return redirect()->route('roles.index')
                        ->with('success','Role updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("roles")->where('id',$id)->delete();
        return redirect()->route('roles.index')
                        ->with('success','Role deleted successfully');
    }
}
