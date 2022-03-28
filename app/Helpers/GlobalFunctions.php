<?php
namespace App\Helpers;
use DOMDocument;
use DB;
use Mail;
use Session;
use Redirect;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Branch;
use App\Models\State;
use App\Models\Consigner;
use URL;
use Crypt;
use Storage;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;

class GlobalFunctions {

  // function for get lead status ///

    public static function getBranches(){
        $branches = Branch::where('status',1)->orderby('name','ASC')->pluck('name','id');
        return $branches;
    }

    public static function getStates(){
        $states = State::where('status',1)->orderby('name','ASC')->pluck('name','id');
        return $states;
    }

    public static function getConsigners(){
        $consigners = Consigner::where('status',1)->orderby('nick_name','ASC')->pluck('nick_name','id');
        return $consigners;
    }

}