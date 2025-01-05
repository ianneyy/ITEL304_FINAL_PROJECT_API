<?php

use App\Http\Controllers\MyReservationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\QrCodeController;

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UniformsController;
use App\Http\Controllers\ReserveController;
use App\Http\Controllers\Student\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\DB;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Landing page
Route::get('/', [UniformsController::class, 'showUniforms']);

Route::get('/uniforms', function () {
    return view('pages.uniforms');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/student-auth.php';





// ADMIN ROUTES
Route::get('/dashboard', [AdminController::class, 'showDashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/admin-reservation', [AdminController::class, 'showAdminReservation']);

Route::get('/paid-reservation/{id}', [AdminController::class, 'paidReservation']);

Route::get('/inventory', [UniformsController::class, 'showUniformsTable'])
    ->middleware(['auth', 'verified'])
    ->name('inventory');

Route::get('/add_uniforms', [UniformsController::class, 'showAddForm']);

Route::post('/add-uniform', [UniformsController::class, 'addUniform']);

Route::get('/edit-uniforms-form/{id}', [UniformsController::class, 'showEditForm']);

Route::post('/update-uniform/{id}', [AdminController::class, 'updateUniform']);

// Route::get('/delete-uniforms/{productId}/{sizeId}', [UniformsController::class, 'deleteUniforms']);

Route::get('/sales', [SalesController::class, 'showSales']);

Route::get('/wishlist', [AdminController::class, 'showWishlist']);

Route::get('/announcement', [AdminController::class, 'showAdminAnnouncement'])
    ->middleware(['auth', 'verified'])
    ->name('announcement');

Route::post('/add-announcement', [AdminController::class, 'addAnnouncement']);

Route::get('/messages', [AdminController::class, 'showMessages']);

Route::post('/reply/{id}', [AdminController::class, 'sendReply']);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/qrcode-scanner', [AdminController::class, 'showQrScanner'])->name('admin.qrcode-scanner');
});

Route::post('/paid-qr-reservation/{id}', [AdminController::class, 'paidQrReservation']);





//STUDENTS ROUTES

Route::get('/student/uniforms', [UniformsController::class, 'showUniforms']);

Route::get('/student/uniforms/view-details/{id}', [UniformsController::class, 'showDetails'])->name('pages.view-details');

Route::post('/reservation-form', [ReserveController::class, 'reserve']);

Route::get('/fill-up-form', [ReserveController::class, 'showReserve']);

Route::get('/continue-shopping/{id}', [ReserveController::class, 'continueShopping']);

Route::post('/add-reservation', [ReserveController::class, 'addReserve'])->name('reservation.add');

Route::get('/qrcode-scanner/{id}', [QrCodeController::class, 'show'])->name('qrcode.show');

Route::get('/student/qrcode', [QrCodeController::class, 'showQrCode']);

Route::get('/student/reservation', [MyReservationController::class, 'showMyReservation']);

Route::get('/cancel-reservation/{id}', [UniformsController::class, 'cancelReservation']);

Route::get('/student/view-qr/{id}', [QrCodeController::class, 'showQrCodebyID']);

Route::get('/student/size_guide', function () {
    return view('pages.size_guide');
});

Route::get('/student/announcement', [UniformsController::class, 'showAnnouncement']);

Route::get('/student/help', function () {
    return view('pages.help');
});

Route::get('/student/contact-us', [UniformsController::class, 'showMessageForm']);

Route::post('/student/contact-us/send-message', [UniformsController::class, 'addMessage']);





// Authentication
Route::prefix('student')->middleware('auth:student')->group(function () {
    // Route::get('/uniforms', [UniformsController::class, 'showUniforms']);
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('student.logout');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});







Route::get('/admin/reservation-details', [AdminController::class, 'getReservationDetails']);


// Route::get('/delete-product/{productId}', [UniformsController::class, 'deleteProduct']);



Route::post('/continue-fill-up', [ReserveController::class, 'sendToFillUpForm']);

Route::get('/delete-cart/{id}', [CartController::class, 'deleteCart']);
Route::get('/delete-wishlist/{id}', [WishlistController::class, 'deleteWishlist']);





// //Route::get('/design', [UniformsController::class, 'index']);

// // Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');

// // Route::post('/reservations', [ReserveController::class, 'store'])->name('reservations.store');


// // Route::get('/announcement', [AdminController::class, 'showAdminAnnouncement']);

// // Route::get('/student/contact-us', function () {
// //     return view('pages.contact_us');
// // });
