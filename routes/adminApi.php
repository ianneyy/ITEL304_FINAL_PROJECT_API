<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiControllers\ApiAdminController;
use App\Http\Controllers\ApiControllers\ApiUniformsController;
use App\Http\Controllers\ApiControllers\ApiSalesController;


Route::get('/requestAdminDashboard', [ApiAdminController::class, 'apiAdminDashoard']);

Route::get('/requestAdminReservation', [ApiAdminController::class, 'apiShowAdminReservation']);

Route::get('/requestAdminPaidReservation/{id}', [ApiAdminController::class, 'apiPaidReservation']);

Route::get('/requestAdminInventory', [ApiUniformsController::class, 'apiShowUniformTable']);

Route::post('/requestAdminAddUniform', [ApiUniformsController::class, 'apiAddUniform']);

Route::get('/requestEditAdminUniformForm/{id}', [ApiUniformsController::class, 'apiShowEditForm']);

Route::post('/requestUpdateUniform/{id}', [ApiAdminController::class, 'apiUpdateUniform']);

Route::get('/requestAdminDeleteUniform/{productId}/{sizeId}', [ApiUniformsController::class, 'apiDeleteUniforms']);

Route::get('/requestAdminDeleteProduct/{productId}', [ApiUniformsController::class, 'deleteProduct']);

Route::get('/requestAdminSales', [ApiSalesController::class, 'apiShowSales']);

Route::get('/requestAdminWishlist', [ApiAdminController::class, 'apiShowWishlist']);

Route::get('/requestAdminAnnouncement', [ApiAdminController::class, 'apiShowAdminAnnouncement']);

Route::post('/requestAdminAddAnnouncement', [ApiAdminController::class, 'apiAddAnnouncement']);

Route::get('/requestAdminMessages', [ApiAdminController::class, 'apiShowMessages']);

Route::post('/requestAdminReply/{id}', [ApiAdminController::class, 'apiSendReply']);

Route::post('/requestAdminQrPay/{id}', [ApiAdminController::class, 'apiPaidQrReservation']);
