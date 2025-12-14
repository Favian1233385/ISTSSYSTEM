<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\EventController;

Route::middleware(['auth', 'is_admin'])->prefix('admin/events')->name('admin.events.')->group(function () {
    Route::get('/', [EventController::class, 'index'])->name('index');
    Route::get('/crear', [EventController::class, 'create'])->name('create');
    Route::post('/crear', [EventController::class, 'store'])->name('store');
    Route::get('/{event}/editar', [EventController::class, 'edit'])->name('edit');
    Route::put('/{event}/editar', [EventController::class, 'update'])->name('update');
    Route::delete('/{event}', [EventController::class, 'destroy'])->name('destroy');
});
