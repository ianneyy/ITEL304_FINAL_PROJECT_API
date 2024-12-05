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

Route::get('/', function () {
    return view('welcome');
});



// Route for showing the dashboard
Route::get('/dashboard', [AdminController::class, 'showDashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Route for inventory page
Route::get('/inventory', [UniformsController::class, 'showUniformsTable'])
    ->middleware(['auth', 'verified'])
    ->name('inventory');

Route::get('/announcement', [AdminController::class, 'showAdminAnnouncement'])
    ->middleware(['auth', 'verified'])
    ->name('announcement');


// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
require __DIR__ . '/student-auth.php';


// Route::get('/uniforms', function () {
//     return view('pages.uniforms');
// });


Route::get('/student/size_guide', function () {
    return view('pages.size_guide');
});
Route::get('/student/uniforms', [UniformsController::class, 'showUniforms'] );


Route::post('/add-uniform', [UniformsController::class, 'addUniform'] );
Route::get('/add_uniforms', function () {
    return view('admin.add_uniforms');
});



Route::get('/delete-uniforms/{productId}/{sizeId}', [UniformsController::class, 'deleteUniforms']);
Route::get('/delete-product/{productId}', [UniformsController::class, 'deleteProduct']);
Route::get('/edit-uniforms-form/{id}', [UniformsController::class, 'showEditForm'] );
Route::get('/view-details/{id}', [UniformsController::class, 'showDetails'] );
Route::post('/reservation-form', [ReserveController::class, 'reserve'] );

Route::get('/fill-up-form', [ReserveController::class, 'showReserve']);
Route::get('/continue-shopping/{id}', [ReserveController::class, 'continueShopping']);

Route::prefix('student')->middleware('auth:student')->group(function () {
    // Route::get('/uniforms', [UniformsController::class, 'showUniforms']);
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('student.logout');
});
Route::get('/student/reservation', [ MyReservationController::class, 'showMyReservation']);

Route::post('/add-reservation', [ReserveController::class, 'addReserve'])->name('reservation.add');




Route::get('/admin-reservation', [AdminController::class, 'showAdminReservation']);
Route::get('/paid-reservation/{id}', [AdminController::class, 'paidReservation']);
Route::post('/paid-qr-reservation/{id}', [AdminController::class, 'paidQrReservation']);


Route::get('/student/announcement', [UniformsController::class, 'showAnnouncement']);

// Route::get('/student/contact-us', function () {
//     return view('pages.contact_us');
// });

Route::get('/student/contact-us', [UniformsController::class, 'showMessageForm']);

Route::get('/design', [UniformsController::class, 'index']);


// Route::get('/announcement', [AdminController::class, 'showAdminAnnouncement']);

Route::post('/add-announcement', [AdminController::class, 'addAnnouncement']);


Route::get('/student/help', function () {
    return view('pages.help');
});

Route::post('/student/contact-us/send-message', [UniformsController::class, 'addMessage']);
Route::post('/continue-fill-up', [ReserveController::class, 'sendToFillUpForm']);

Route::get('/delete-cart/{id}', [CartController::class, 'deleteCart']);
Route::get('/delete-wishlist/{id}', [WishlistController::class, 'deleteWishlist']);

// Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');


// Route::post('/reservations', [ReserveController::class, 'store'])->name('reservations.store');
Route::get('/qrcode-scanner/{id}', [QrCodeController::class, 'show'])->name('qrcode.show');

Route::get('/student/qrcode', [QrCodeController::class, 'showQrCode']);
Route::get('/student/view-qr/{id}', [QrCodeController::class, 'showQrCodebyID']);


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/qrcode-scanner', [AdminController::class, 'showQrScanner'])->name('admin.qrcode-scanner');
});
Route::get('/admin/reservation-details', [AdminController::class, 'getReservationDetails']);


Route::get('/messages', [AdminController::class, 'showMessages']);
Route::post('/reply/{id}', [AdminController::class, 'sendReply']);
Route::get('/cancel-reservation/{id}', [UniformsController::class, 'cancelReservation']);
Route::get('/wishlist', [AdminController::class, 'showWishlist']);
