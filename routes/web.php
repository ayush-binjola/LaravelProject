<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\adminHome\adminController;
use App\Http\Controllers\ExportExcels;
use App\Http\Controllers\PasswordReset\ResetPass;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('admin/home', [adminController::class, 'adminHome'])->name('admin.home')->middleware('role:admin');

// Routes for admin Control Panel
Route::prefix('admin')->middleware('role:admin')->group(function(){
    // Route for add user
        Route::view('adminAdd','admin/addUser')->name('admin.addUser');
        Route::post('adminadded',[adminController::class,'addUser'])->name('admin.added');
    // EDIT USER
        Route::get('adminEditUser/{id}',[adminController::class,'showUser']);
        Route::post('edit',[adminController::class,'editUser'])->name('admin.edit');
    // DELETE USER
        Route::get('/delete/{id}',[adminController::class,'delete']);
    // MALLS
    // Add malls
        Route::get('addMalls',[adminController::class,'addMalls'])->name('admin.addMall');
        Route::Post('addMallsData',[adminController::class,'addMallData'])->name('admin.addMallData');
        Route::get('showMalls',[adminController::class,'showMalls'])->name('mallList');
        Route::get('getMall/{id}',[adminController::class,'getMall']);
        Route::post('mallEdit',[adminController::class,'editMall'])->name('malls.edit');
        Route::get('deleteMall/{id}',[adminController::class,'deleteMall']);
                    // PASSWORD AND RESET FUNCTIONALITY
        Route::get('forget',[ResetPass::class,'showResetPage'])->name('users.forget');
        Route::post('recover',[ResetPass::class,'resetPass'])->name('reset.mail');
        Route::get('resetLink/{token}',[ResetPass::class,'showPassword'])->name('showLinnk.resetPass');
        Route::post('submitResetPass',[ResetPass::class,'submitResetPass'])->name('change.password');

// BRANDS
        Route::get('viewBrands',[adminController::class,'viewBrands'])->name('brands.home');
        Route::get('viewAddBrands',[adminController::class,'showAddbrands'])->name('add.brandsView');
        Route::post('submitBrands',[adminController::class,'submitBrands'])->name('add.brands');
        Route::get('editBrands/{id}',[adminController::class,'showEditPageBrands'])->name('edit.page');
        Route::post('getEditMall',[adminController::class,''])->name('editMall');

});

// SUPER ADMIN CONTROLLS



//  PDF AND EXCEL CREATION
Route::get('exportExcel',[ExportExcels::class,'exportMall'])->name('exportEx');
