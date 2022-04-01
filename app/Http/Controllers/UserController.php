<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\UserPermission;
use App\Models\Permission;
use DB;
use URL;
use Helper;
use Hash;
use Crypt;
use Validator;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    public $prefix;
    public $title;

    public function __construct()
    {
      $this->title =  "Users Listing";
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
        $query = User::query();
        $data = $query->with('UserRole')->orderby('id','DESC')->paginate($peritem);
        return view('Users.user-list',['data'=>$data,'prefix'=>$this->prefix])
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
        $getpermissions = Permission::all();
        $getroles = Role::all();
        $branches = Helper::getBranches();

        return view('Users.create-user',['getroles'=>$getroles, 'getpermissions'=>$getpermissions, 'branches'=>$branches, 'prefix'=>$this->prefix]);
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
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
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
        if(!empty($request->name)){
            $usersave['name']   = $request->name;
        }
        if(!empty($request->email)){
            $usersave['email']  = $request->email;
        }
        if(!empty($request->password)){
            $usersave['password'] = Hash::make($request->password);
        }

        if(!empty($request->role_id)){
            $usersave['role_id']  = $request->role_id;
        }
        $usersave['branch_id']  = $request->branch_id;
        $usersave['phone']      = $request->phone;
        $usersave['status']     = "1";

        $saveuser = User::create($usersave); 
        if($saveuser)
        {
            $userid = $saveuser->id;
            if(!empty($request->permisssion_id)){         
              foreach ($request->permisssion_id as $key => $permissionvalue){
                  $savepermissions[] = [
                    'user_id'=>$userid,
                    'permisssion_id'=>$permissionvalue,
                  ];   
                }
                UserPermission::insert($savepermissions); 
            }

            $response['success'] = true;
            $response['success_message'] = "Users Added successfully";
            $response['error'] = false;
            $response['resetform'] = true;
            $response['page'] = 'users'; 
        }else{
            $response['success'] = false;
            $response['error_message'] = "Can not created user please try again";
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
    // public function show($id)
    // {
    //    // dd("show");
    //     $user = User::find($id);
    //     return view('users.show',compact('user'));
    // }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($user)
    {
        $this->prefix = request()->route()->getPrefix();
        $id = decrypt($user); 
        $getroles = Role::all();
        $getpermissions = Permission::all();
        $allpermissioncount = Permission::all()->count();
        $getuserpermissions = UserPermission::where('user_id',$id)->get();
        $branches = Helper::getBranches();

        $u = array();
        if(count($getuserpermissions) > 0)
        {
            foreach($getuserpermissions as $us)
            {
                $u[] = $us['permisssion_id'];
            }
        }
        $getuser = User::where('id',$id)->first();
        return view('Users.update-user')->with(['prefix'=>$this->prefix,'title'=>$this->title,'getuser'=>$getuser,'getroles'=>$getroles,'getpermissions'=>$getpermissions,'getuserpermissions'=>$u,'allpermissioncount'=>$allpermissioncount,'branches'=>$branches]);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
        
    public function updateUser(Request $request)
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

        $getpass = User::where('id',$request->user_id)->get();

        $usersave['name']       = $request->name;
        $usersave['email']      = $request->email;
        $usersave['role_id']    = $request->role_id;
        $usersave['phone']      = $request->phone;
        $usersave['branch_id']  = $request->branch_id;
        if(!empty($request->password)){
            $usersave['password'] = Hash::make($request->password);
        }else if(!empty($getpass->password)){
            $usersave['password'] = $getpass->password;
        }
            
            User::where('id',$request->user_id)->update($usersave);

              $userid = $request->user_id;
              UserPermission::where('user_id',$userid)->delete();
              if(!empty($request->permisssion_id)){                
                foreach ($request->permisssion_id as $key => $permissionvalue)  {
                    $savepermissions[] = [
                      'user_id'=>$userid,
                      'permisssion_id'=>$permissionvalue,
                    ];   
                  }
                  UserPermission::insert($savepermissions); 
              }

            $getsavedusers = User::where('id',$request->user_id)->first();
            $url    =   URL::to($this->prefix.'users');

            $response['page'] = 'user-update';
            $response['success'] = true;
            $response['success_message'] = "User Updated Successfully";
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
    public function deleteUser(Request $request)
    {
        UserPermission::where('user_id',$request->userid)->delete();
        User::where('id',$request->userid)->delete();

        $response['success']         = true;
        $response['success_message'] = 'User deleted successfully';
        $response['error']           = false;
        return response()->json($response);
    }
    
}
