<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BookingAdminController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\PricingController;
use App\Http\Controllers\Admin\AvailabilityController;
use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\Admin\ContentController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/pricing', [PageController::class, 'pricing'])->name('pricing');
Route::get('/faqs', [PageController::class, 'faqs'])->name('faqs');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/driver-recruitment', [PageController::class, 'driverRecruitment'])->name('driver.recruitment');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Booking (must be logged in)
Route::middleware(['auth'])->group(function () {
    Route::get('/bookings/create', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
});

// Admin Panel (requires admin middleware)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Bookings
    Route::get('/bookings', [BookingAdminController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/{booking}', [BookingAdminController::class, 'show'])->name('bookings.show');
    Route::patch('/bookings/{booking}/status', [BookingAdminController::class, 'updateStatus'])->name('bookings.update-status');
    Route::patch('/bookings/{booking}/payment-status', [BookingAdminController::class, 'updatePaymentStatus'])->name('bookings.update-payment-status');
    
    // Services
    Route::resource('services', AdminServiceController::class);
    
    // Pricing
    Route::get('/pricing', [PricingController::class, 'index'])->name('pricing.index');
    Route::get('/pricing/create', [PricingController::class, 'create'])->name('pricing.create');
    Route::post('/pricing', [PricingController::class, 'store'])->name('pricing.store');
    Route::get('/pricing/{pricing}/edit', [PricingController::class, 'edit'])->name('pricing.edit');
    Route::put('/pricing/{pricing}', [PricingController::class, 'update'])->name('pricing.update');
    Route::delete('/pricing/{pricing}', [PricingController::class, 'destroy'])->name('pricing.destroy');
    
    // Availability
    Route::get('/availability', [AvailabilityController::class, 'index'])->name('availability.index');
    Route::post('/availability/working-hours', [AvailabilityController::class, 'storeWorkingHours'])->name('availability.working-hours.store');
    Route::delete('/availability/working-hours/{rule}', [AvailabilityController::class, 'destroyWorkingHours'])->name('availability.working-hours.destroy');
    Route::post('/availability/blackout-dates', [AvailabilityController::class, 'storeBlackoutDate'])->name('availability.blackout-dates.store');
    Route::delete('/availability/blackout-dates/{blackoutDate}', [AvailabilityController::class, 'destroyBlackoutDate'])->name('availability.blackout-dates.destroy');
    
    // Drivers
    Route::get('/drivers', [DriverController::class, 'index'])->name('drivers.index');
    Route::get('/drivers/create', [DriverController::class, 'create'])->name('drivers.create');
    Route::post('/drivers', [DriverController::class, 'store'])->name('drivers.store');
    Route::get('/drivers/{driver}/edit', [DriverController::class, 'edit'])->name('drivers.edit');
    Route::put('/drivers/{driver}', [DriverController::class, 'update'])->name('drivers.update');
    Route::delete('/drivers/{driver}', [DriverController::class, 'destroy'])->name('drivers.destroy');
    Route::get('/drivers/applications', [DriverController::class, 'applications'])->name('drivers.applications');
    Route::post('/drivers/applications/{application}/approve', [DriverController::class, 'approveApplication'])->name('drivers.applications.approve');
    Route::post('/drivers/applications/{application}/reject', [DriverController::class, 'rejectApplication'])->name('drivers.applications.reject');
    
    // Content/Settings
    Route::get('/content', [ContentController::class, 'index'])->name('content.index');
    Route::put('/content', [ContentController::class, 'update'])->name('content.update');
    
    // Users
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::patch('/users/{user}/status', [UserController::class, 'updateStatus'])->name('users.update-status');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
