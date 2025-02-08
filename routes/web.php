<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobTitleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});
Route::get('/dashboard',[HomeController::class,'index'])->name('dashboard');
Route::prefix('master')->name('master.')->group(function (){
    Route::prefix('department')->name('department.')->group(function (){
        Route::get('/',[DepartmentController::class,'index'])->name('index');
        Route::get('/data',[DepartmentController::class, 'getData'])->name('data');
        Route::post('/add',[DepartmentController::class,'store'])->name('store');
        Route::get('/edit/{id}',[DepartmentController::class,'edit'])->name('edit');
        Route::put('/update/{id}',[DepartmentController::class,'update'])->name('update');
        Route::delete('/delete/{id}',[DepartmentController::class,'destroy'])->name('delete');
    });

    Route::prefix('jobtitle')->name('jobtitle.')->group(function (){
        Route::get('/',[JobTitleController::class,'index'])->name('index');
        Route::get('/data',[JobTitleController::class, 'getData'])->name('data');
        Route::post('/add',[JobTitleController::class,'store'])->name('store');
        Route::get('/edit/{id}',[JobTitleController::class,'edit'])->name('edit');
        Route::put('/update/{id}',[JobTitleController::class,'update'])->name('update');
        Route::delete('/delete/{id}',[JobTitleController::class,'destroy'])->name('delete');
    });
});
Route::prefix('employee')->name('employee.')->group(function (){
    Route::get('/',[EmployeeController::class,'index'])->name('index');
    Route::get('/modal/{id}', [EmployeeController::class, 'show'])->name('show');
    Route::get('/data',[EmployeeController::class, 'getData'])->name('data');
    Route::post('/add',[EmployeeController::class,'store'])->name('store');
    Route::get('/edit/{id}',[EmployeeController::class,'edit'])->name('edit');
    Route::put('/update/{id}',[EmployeeController::class,'update'])->name('update');
    Route::delete('/delete/{id}',[EmployeeController::class,'destroy'])->name('delete');
});
