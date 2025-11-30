<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AcademicModalityController;
use App\Http\Controllers\Admin\AcademicProgramController;

Route::prefix('admin/academicos')->middleware(['auth', 'is_admin'])->name('admin.academic_modalities.')->group(function () {
    Route::get('/', [AcademicModalityController::class, 'index'])->name('index');
    Route::get('/crear', [AcademicModalityController::class, 'create'])->name('create');
    Route::post('/crear', [AcademicModalityController::class, 'store'])->name('store');
    Route::get('/{academicModality}/editar', [AcademicModalityController::class, 'edit'])->name('edit');
    Route::put('/{academicModality}/editar', [AcademicModalityController::class, 'update'])->name('update');
    Route::delete('/{academicModality}', [AcademicModalityController::class, 'destroy'])->name('destroy');

    // Programas por modalidad
    Route::get('/{modalityId}/programas', [AcademicProgramController::class, 'index'])->name('programs.index');
    Route::get('/{modalityId}/programas/crear', [AcademicProgramController::class, 'create'])->name('programs.create');
    Route::post('/{modalityId}/programas/crear', [AcademicProgramController::class, 'store'])->name('programs.store');
    Route::get('/{modalityId}/programas/{academicProgram}/editar', [AcademicProgramController::class, 'edit'])->name('programs.edit');
    Route::put('/{modalityId}/programas/{academicProgram}/editar', [AcademicProgramController::class, 'update'])->name('programs.update');
    Route::delete('/{modalityId}/programas/{academicProgram}', [AcademicProgramController::class, 'destroy'])->name('programs.destroy');
});
