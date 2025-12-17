<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ClaimController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;


// Redirect root ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// Halaman About (tidak perlu auth)
Route::get('/about', function () {
    return view('about');
})->name('about');


// ===============================
//     ROUTE USER LOGIN & VERIFIED
// ===============================
Route::middleware(['auth', 'verified'])->group(function () {

    // ---------------------------
    //  DASHBOARD
    // ---------------------------
    Route::get('/dashboard', [ItemController::class, 'dashboard'])->name('dashboard');
    Route::post('/dashboard', [ItemController::class, 'store'])->name('dashboard.store');

    // ---------------------------
    //  PROFIL USER
    // ---------------------------
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

    // update data profil (nama, email, no HP, foto)
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // 🔐 update password (form "Perbarui Password")
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

    // hapus akun
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 🔔 update preferensi notifikasi profil
    Route::put(
        '/profile/notifications',
        [ProfileController::class, 'updateNotifications']
    )->name('profile.notifications.update');

    // ---------------------------
    //  ITEMS (barang hilang/ditemukan)
    // ---------------------------

    // Form lapor barang ditemukan
    Route::get('/items/create-found', [ItemController::class, 'createFound'])->name('items.createFound');

    // List tambahan (tidak bertabrakan dengan resource)
    Route::get('/items/all', [ItemController::class, 'allItems'])->name('items.all');
    Route::get('/items/found', [ItemController::class, 'foundItems'])->name('items.found');

    // Resource utama items
    Route::resource('items', ItemController::class)->except(['create']);

    // Klaim
    Route::post('/items/{item}/claim', [ClaimController::class, 'submitClaim'])->name('items.claim');
    Route::get('/claims', [ClaimController::class, 'index'])->name('claims.index');
    Route::get('/claims/pending', [ClaimController::class, 'Pending'])->name('claims.pending');
    Route::post('/claims/{claim}/verify', [ClaimController::class, 'verify'])->name('claims.verify');

    // ---------------------------
    //  NOTIFIKASI
    // ---------------------------
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [NotificationController::class, 'markAll'])->name('notifications.readAll');
    Route::delete('/notifications/{id}/delete', [NotificationController::class, 'destroy'])->name('notifications.delete');
    Route::delete('/notifications', [NotificationController::class, 'deleteAll'])->name('notifications.deleteAll');
});


// ===============================
//     ADMIN ROUTES
// ===============================
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard admin
    Route::get('/admin/homepage', [AdminController::class, 'index'])->name('admin.homepage');

    // Barang Hilang
    Route::get('/admin/items/{id}/edit', [AdminController::class, 'editItem'])->name('admin.items.edit');
    Route::put('/admin/items/{id}', [AdminController::class, 'updateItem'])->name('admin.items.update');
    Route::delete('/admin/items/{id}', [AdminController::class, 'destroyItem'])->name('admin.items.destroy');

    // Barang ditemukan
    Route::get('/admin/items/{id}/edit-found', [AdminController::class, 'editFoundItem'])->name('admin.items.edit-found');
    Route::put('/admin/items/{id}/update-found', [AdminController::class, 'updateFoundItem'])->name('admin.items.update-found');
    Route::delete('/admin/items/{id}/destroy-found', [AdminController::class, 'destroyFoundItem'])->name('admin.items.destroy-found');

    // Users
    Route::get('/admin/users/{id}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/admin/users/{id}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/admin/users/{id}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');
});


// ===============================
//     LOGIN & REGISTER
// ===============================
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    Route::get(
        '/register',
        [\App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm']
    )->name('register');

    Route::post(
        '/register',
        [\App\Http\Controllers\Auth\RegisterController::class, 'register']
    );
});

// LOGOUT
Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');


require __DIR__ . '/auth.php';
