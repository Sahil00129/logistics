<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use DB;
use URL;
use Validator;

class PermissionController extends Controller
{
    public function __construct()
    {
      $this->title =  "Permissions Listing";
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
        $query = Permission::query();
        $permissions = $query->orderBy('id','DESC')->paginate($peritem);
        return view('Permissions.permission-list',['permissions'=>$permissions,'prefix'=>$this->prefix])
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
}
