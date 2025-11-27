<?php
// routes/web.php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AboutController;

// ...existing routes...

// Admin About CRUD
Route::prefix('admin')->middleware(['auth', 'is_admin'])->group(function () {
    Route::resource('about', AboutController::class)->names('about');
});
