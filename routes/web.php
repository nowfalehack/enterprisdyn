<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\UserController;

/*
|--------------------------------------------------------------------------
| PUBLIC
|--------------------------------------------------------------------------
*/

Route::get('/', fn() => view('welcome'));

/*
|--------------------------------------------------------------------------
| DASHBOARD REDIRECT (VERY IMPORTANT)
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {

    if (auth()->user()->role === 'admin') {
        return redirect('/admin/dashboard');
    }

    return redirect('/user/dashboard');

})->middleware(['auth'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| USER PANEL
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // USER DASHBOARD
    Route::get('/user/dashboard', function () {
        return view('user.dashboard');
    });

    // USER FORMS
    Route::get('/forms', [FormController::class, 'userForms']);
    Route::get('/forms/{id}', [FormController::class, 'fillForm']);

    // USER SUBMISSIONS
    Route::get('/my-submissions', [SubmissionController::class, 'userSubmissions']);

    // PROFILE
    Route::get('/profile', [ProfileController::class,'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class,'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class,'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| ADMIN PANEL
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
->middleware(['auth','admin'])
->name('admin.')
->group(function () {

 Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.delete');

    // ADMIN DASHBOARD
    //Route::view('/dashboard','admin.dashboard')->name('dashboard');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // FORMS
    Route::resource('forms', FormController::class);

    // SUBMISSIONS
    Route::resource('submissions', SubmissionController::class);

    // IMPORT
    Route::get('/import', [ImportController::class,'index'])->name('import');
    Route::post('/import-preview', [ImportController::class,'preview'])->name('import.preview');
    Route::post('/import-store', [ImportController::class,'store'])->name('import.store');

    // EXPORT
    Route::get('/export', [ExportController::class,'export'])->name('export');
});

/*
|--------------------------------------------------------------------------
| FORM SUBMISSION (PUBLIC)
|--------------------------------------------------------------------------
*/

Route::post('/form-submit/{id}', [FormController::class,'submit'])
    ->name('form.submit');

/*
|--------------------------------------------------------------------------
| AUTH ROUTES (BREEZE / JETSTREAM)
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';