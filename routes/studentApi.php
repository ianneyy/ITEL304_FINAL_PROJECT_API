<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiControllers\ApiMyReservationController;
use App\Http\Controllers\ApiControllers\ApiUniformsController;
use App\Http\Controllers\ApiControllers\ApiQrCodeController;
use App\Http\Controllers\ApiControllers\ApiReserveController;


Route::get('/requestStudentShowUniformDetails/{id}', [ApiUniformsController::class, 'apiShowDetails'] );

Route::post('/requestStudentToCartWishlistUniform/{userId}', [ApiReserveController::class, 'apiReserve'] );

Route::get('/requestStudentShowReserveRequest', [ApiReserveController::class, 'apiShowReserve']);

Route::get('/requestStudentContinueShoping/{id}', [ApiReserveController::class, 'apiContinueShopping']);

Route::post('/requestStudentAddReservation/{userId}', [ApiReserveController::class, 'apiAddReserve']);

//walang ginagawa to, wag burahin para d masira
Route::get('/qrcode-scanner/{id}', [ApiQrCodeController::class, 'apiShow'])->name('apiQrcode.show');

Route::get('/requestStudentShowQr/{userId}', [ApiQrCodeController::class, 'apiShowQrCode']);

Route::get('/requestStudentReservation/{userId}', [ ApiMyReservationController::class, 'apiShowMyReservation']);

Route::get('/requestStudentCancelUniform/{id}', [ApiUniformsController::class, 'apiCancelReservation']);

Route::get('/requestStudentViewQr/{userId}/{id}', [ApiQrCodeController::class, 'apiShowQrCodebyID']);

Route::get('/requestStudentAnnouncement', [ApiUniformsController::class, 'apiShowAnnouncement']);

Route::get('/requestStudentShowMessageForm/{userId}', [ApiUniformsController::class, 'apiShowMessageForm']);

Route::post('/requestStudentMessage', [ApiUniformsController::class, 'apiAddMessage']);