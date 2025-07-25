<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Models\Organization;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;

class AdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $admins = Admin::whereOrganizationId(Helper::$value_zero)->whereHas('role', function ($query){
                $query->whereName(Helper::$ownerRole);
            })->orderBy('id','desc');
            $equals = $request->equal ?? [];
            $likes  = $request->like ?? [];
            foreach ($likes as $key1 => $like) {
                if(!empty($like)) { $admins->where($key1, 'LIKE','%'.$like.'%'); }
            }
            foreach ($equals as $key2 => $equal) {
                if(!empty($equal)) { $admins->where($key2, $equal); }
            }
            $admins = $admins->paginate(Helper::$per_page);
            return view('backend.pages.admins.index', compact('admins','equals', 'likes'));
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
            $admin  = new Admin();
            return view('backend.pages.admins.form', compact('admin'));
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
            'email'                 => 'required|max:100|email|unique:admins,email,NULL,id,organization_id,'.Helper::$value_zero.'|'.Helper::$emailRegex,
            'username'              => 'nullable|max:100|unique:admins,username,NULL,id,organization_id,'.Helper::$value_zero,
            'password'              => 'required|min:6|same:password_confirmation',
            'password_confirmation' => 'required|min:6',
        ], [],[
            'is_active'             => 'status',
            'password_confirmation' => 'confirm password'
        ]);
        try {
            // Create New Admin
            $role  = Role::select(['id'])->where(['name' => Helper::$ownerRole])->whereOrganizationId(Helper::$value_zero)->first();
            $admin = new Admin();
            $admin->first_name = $request->first_name;
            $admin->last_name  = $request->last_name;
            $admin->email      = $request->email;
            $admin->username   = $request->username ?? $request->email;
            $admin->is_active  = $request->is_active;
            $admin->password   = Hash::make($request->password);
            $admin->role_id    = $role->id;
            $admin->save();
            return redirect()->route('admin.admins.index')->with(['success' => trans('message.created', ['module' => 'Admin'])]);
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
    public function show(Module $admin)
    {
        return redirect()->back()->with(['error' => trans('message.something_wrong')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        try {
            return view('backend.pages.admins.form', compact('admin'));
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
    public function update(Request $request, Admin $admin)
    {
        // Validation Data
        $request->validate([
            'first_name'            => 'required|max:50',
            'last_name'             => 'required|max:50',
            'email'                 => 'required|max:100|email|unique:admins,email,'.$admin->id.',id,organization_id,'.Helper::$value_zero.'|'.Helper::$emailRegex,
            'username'              => 'required|max:100|unique:admins,username,'.$admin->id.',id,organization_id,'.Helper::$value_zero,
            'password'              => 'nullable|min:6|same:password_confirmation',
            'password_confirmation' => 'nullable|min:6',
        ], [],[
            'is_active' => 'status'
        ]);

        try {
            if($request->is_active==Helper::$status_no && $admin->id==Helper::getSessionData()->id){
                return redirect()->back()->withInput()->with(['error' => trans('message.self_inactive')]);
            }
            $admin->first_name = $request->first_name;
            $admin->last_name  = $request->last_name;
            $admin->email      = $request->email;
            $admin->username   = $request->username;
            $admin->is_active  = $request->is_active;
            if($request->password) {
                $admin->password   = Hash::make($request->password);
            }
            $admin->save();
            return redirect()->route('admin.admins.index')->with(['success' => trans('message.updated', ['module' => 'Admin'])]);
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
        return redirect()->back()->with(['error' => trans('message.something_wrong')]); 
        try {
            if($admin->organization_id==Helper::$value_zero){
                $admin->delete();
                return redirect()->route('admin.admins.index')->with(['success' => trans('message.deleted', ['module' => 'Admin'])]);
            }
            return redirect()->back()->with(['error' => trans('message.something_wrong')]); 
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => trans('message.something_wrong')]); 
        }
    }
    public function removeMulti(Request $request)
    {
        try {
            if($request->selected_id){
                Admin::whereIn('id', Helper::explodeData($request->selected_id))->whereOrganizationId(Helper::$value_zero)->delete();
                return redirect()->route('admin.admins.index')->with(['success' => trans('message.deleted', ['module' => 'Admin'])]);
            } 
            return redirect()->back()->with(['error' => trans('message.invalid_input_rec')]); 
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => trans('message.something_wrong')]); 
        } 
    }

}
