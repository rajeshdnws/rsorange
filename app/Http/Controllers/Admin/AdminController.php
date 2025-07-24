<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;
use App\Models\Admin;
class AdminController extends Controller
{
    public function dashboard()
    {


    return view('admin.profile.dashboard');
    }
    public function editPassword(Request $request)
    {
     
        try {
            $profile  = Helper::getSessionData();
            return view('admin.profile.change-password', compact('profile'));
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => trans('message.something_wrong')]); 
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */
    public function updatePassword(Request $request)
    {   
        $profile   = Helper::getSessionData();
        $validator = Validator::make($request->all(), [
            'current_password'      => 'required|min:6',
            'password'              => 'required|min:6|same:password_confirmation',
            'password_confirmation' => 'required|min:6',
        ], [],[
            'password'              => 'new password',
            'password_confirmation' => 'confirm password'
        ]);

        if(!Hash::check($request->current_password, $profile->password)) {
            $validator->errors()->add('current_password', 'The current password is incorrect.'); 
        } else if(Hash::check($request->password, $profile->password)) {
            $validator->errors()->add('password', 'The new password must be different from the current password.'); 
        } 
        if ($validator->errors()->count() > 0) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        try {
            $profile->password = Hash::make($request->password);
            $profile->save();
            // Logout due to update password
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('login');
            //return redirect()->route('admin.edit.password')->with(['success' => trans('message.updated', ['module' => 'Password'])]);
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => trans('message.something_wrong')]); 
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function editProfile(Request $request)
    {
        try {
            $profile  = Helper::getSessionData();         
            return view('admin.profile.profile-setting', compact('profile'));
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => trans('message.something_wrong')]); 
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request)
    {
        $request->validate([
            'first_name'            => 'required|max:50',
            'last_name'             => 'required|max:50'
        ]);
        try {
            $profile             = Helper::getSessionData();
            $profile->first_name = $request->first_name;
            $profile->last_name  = $request->last_name;
            $profile->save();
            return redirect()->route('edit.profile')->with(['success' => trans('Profile has been updated successfully')]);
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => trans('message.something_wrong')]); 
        }
    }
	
	
	 public function index(Request $request)
    {
		//dd(\Request::route()->getName());
        try {
            $admins = Admin::orderBy('id','desc');
            $equals = $request->equal ?? [];
            $likes  = $request->like ?? [];
            foreach ($likes as $key1 => $like) {
                if(!empty($like)) { $admins->where($key1, 'LIKE','%'.$like.'%'); }
            }
            foreach ($equals as $key2 => $equal) {
                if(!empty($equal)) { $admins->where($key2, $equal); }
            }
            $admins = $admins->paginate(Helper::$per_page);
            return view('admin.profile.index', compact('admins','equals', 'likes'));
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => trans('message.something_wrong')]); 
        }
	    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        try {
            return view('admin.profile.admin', compact('admins'));
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => trans('message.something_wrong')]); 
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation Data
        $request->validate([
            'first_name'            => 'required|max:50',
	        'last_name'             => 'required|max:50',
            'email'                 => 'required|max:100|email|unique:admins,email',
            'username'              => 'nullable|max:100|unique:admins,username',
            'password'              => 'required|min:6|same:password_confirmation',
            'password_confirmation' => 'required|min:6',
        ], [],[
            'is_active'             => 'status',
            'password_confirmation' => 'confirm password'
        ]);
        try {
            // Create New Admin
         
            $admin = new Admin();
            $admin->first_name = $request->first_name;
            $admin->last_name  = $request->last_name;
            $admin->email      = $request->email;
            $admin->username   = $request->username ?? $request->email;
            $admin->is_active  = $request->is_active;
            $admin->password   = Hash::make($request->password);
            $admin->role    = 1;
            $admin->save();
            return redirect()->route('user.index')->with(['success' => trans('New admin user added', ['module' => 'Admin'])]);
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with(['error' => trans('message.something_wrong')]); 
        }
    }

    /**1
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        return redirect()->back()->with(['error' => trans('Something wents wrong')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
	
        try {
			$admin= Admin::whereId($id)->first();
            return view('admin.profile.admin', compact('admin'));
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => trans('Something wents wrong')]); 
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        // Validation Data
        $request->validate([
            'first_name'            => 'required|max:50',
            'last_name'             => 'required|max:50',
            'email'                 => 'required|max:100|unique:admins,email,'.$admin->id.',id',
            'username'              => 'required|max:100|unique:admins,username,'.$admin->id.',id',
            'password'              => 'nullable|min:6|same:password_confirmation',
            'password_confirmation' => 'nullable|min:6',
        ], [],[
            'is_active' => 'status'
        ]);

        try {
           
            $admin->first_name = $request->first_name;
            $admin->last_name  = $request->last_name;
            $admin->email      = $request->email;
            $admin->username   = $request->username;
            $admin->is_active  = $request->is_active;
            if($request->password) {
                $admin->password   = Hash::make($request->password);
            }
            $admin->save();
            return redirect()->route('user.index')->with(['success' => trans('Admin profile updated', ['module' => 'Admin'])]);
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with(['error' => trans('message.something_wrong')]); 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
       try {
        $admin->delete();
        return redirect()->route('user.index')->with('success', 'Admin deleted successfully.');
    } catch (\Exception $e) {
        \Log::error('Admin Delete Failed: '.$e->getMessage());
        return redirect()->back()->with('error', 'Something went wrong while deleting the admin.');
    }
    }

}


    // public function removeMulti(Request $request)
    // {
    //     try {
    //         if($request->selected_id){
    //             Admin::whereIn('id', Helper::explodeData($request->selected_id))->whereOrganizationId(Helper::$value_zero)->delete();
    //             return redirect()->route('admin.admins.index')->with(['success' => trans('message.deleted', ['module' => 'Admin'])]);
    //         } 
    //         return redirect()->back()->with(['error' => trans('message.invalid_input_rec')]); 
    //     } catch (Exception $e) {
    //         return redirect()->back()->with(['error' => trans('message.something_wrong')]); 
    //     } 
    // }

