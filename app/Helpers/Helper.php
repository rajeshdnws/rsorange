<?php
namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Config;
use App\Models\Admin;
use DB;
use Illuminate\Support\Facades\Auth;

class Helper{
	/*
		Diffrent types of status key for businnes logic
	*/
	static $guard          = 'admin';
	static $guard_user     = 'web';
	static $ownerRole      = 'webite_superadmin';
	static $status_yes     = 'yes';
	static $status_no      = 'no';
	static $per_page      = 10;
	static $threshold_alert = [
    	1 =>'Hourly',
    	2 =>'Daily '
    ];
   static function getSessionData(){
		return (Auth::guard(self::$guard)->check()) ? Auth::guard(self::$guard)->user(): null;	 
 	}

 	static function getUserSessionData(){
		return (Auth::guard(self::$guard_user)->check()) ? Auth::guard(self::$guard_user)->user(): null;	 
 	}

	

}