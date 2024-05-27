<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//login signup routes

Route::post('signup', [AuthController::class, 'signup'])->name('signup');
Route::post('signin', [AuthController::class, 'signin']);


//feedback route
use App\Http\Controllers\FeedbackController;

Route::post('/feedback', [FeedbackController::class, 'store']);
Route::get('/feedbackentry',[FeedbackController::class,'show']);

//appopintments
use App\Http\Controllers\AppointmentController;

Route::post('/appointments', [AppointmentController::class,'store']);
Route::get('/Getappointments/{id}',[AppointmentController::class,'GetAppointment']);
Route::delete('/Delappointments/{id}',[AppointmentController::class,'DeleteAppointment']);
Route::post('/updateappoint/{id}',[AppointmentController::class,'UpdateAppointment']);
Route::get('/appointmentsentry',[AppointmentController::class,'show']);
Route::post('/Updateprogress/{id}',[AppointmentController::class,'Updateprogress']);

//contact us
use App\Http\Controllers\ContactUsController;
Route::post('/contact', [ContactUsController::class,'store']);
Route::get('/contactentry',[ContactUsController::class,'show']);



