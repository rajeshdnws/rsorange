<?php
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\Admin\Auth\AuthAdminController;

Route::prefix('admin')->group(function(){

    Route::get('login',[AuthAdminController::class,'create'])->name('admin.login');
    Route::POST('login',[AuthAdminController::class,'store'])->name('admin.submit');
    Route::POST('logout',[AuthAdminController::class,'destroy'])->name('admin.logout');

Route::group(['middleware' => ['admin']],function(){
  Route::resource('user', AdminController::class);
   Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
   Route::get('change-password', [AdminController::class, 'editPassword'])->name('edit.password');
   Route::put('change-password', [AdminController::class, 'updatePassword'])->name('update.password');
   Route::get('profile-setting', [AdminController::class, 'editProfile'])->name('edit.profile');
   Route::put('profile-setting', [AdminController::class, 'updateProfile'])->name('update.profile');
  
});
});

