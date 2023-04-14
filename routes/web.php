<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\TEController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TJController;
use App\Mail\registeredMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware'=>['auth','revalidate']], function(){

    Route::group([
        'prefix' => 'admin',
        'middleware' => 'admin',
        'as' => 'admin.'
    ], function(){
        Route::get('dashboard', [DashboardController::class, 'dashboardAdmin'])->name('dashboard');

        // Master periode
        Route::get('periode', [PeriodeController::class, 'index'])->name('periode');
        Route::post('periode/datatable', [PeriodeController::class, 'datatable'])->name('periode.datatable');
        Route::post('periode/store', [PeriodeController::class, 'store'])->name('periode.store');
        Route::delete('periode/destroy/{id}', [PeriodeController::class, 'destroy'])->name('periode.destroy');

        // English
        Route::get('toefl/english/pelatihan', [TEController::class, 'pelatihan'])->name('english.pelatihan');
        Route::post('toefl/english/pelatihan/datatable', [TEController::class, 'datatablePelatihan']);
        
        Route::get('toefl/english/test', [TEController::class, 'test'])->name('english.test');
        Route::post('toefl/english/test/datatable', [TEController::class, 'datatableTest']);
        
        Route::get('toefl/english/pelatihan_test', [TEController::class, 'pelatihan_test'])->name('english.pelatihan_test');
        Route::post('toefl/english/pelatihan_test/datatable', [TEController::class, 'datatablePelatihanTest']);
        
        // Japan
        Route::get('toefl/japan/test', [TJController::class, 'test'])->name('japan.test');
        Route::post('toefl/japan/test/datatable', [TEController::class, 'datatableTest']);

        Route::get('toefl/japan/pelatihan', [TJController::class, 'pelatihan'])->name('japan.pelatihan');
        Route::post('toefl/japan/pelatihan/datatable', [TEController::class, 'datatableTest']);

        Route::get('toefl/japan/pelatihan_test', [TJController::class, 'pelatihan_test'])->name('japan.pelatihan_test');
        Route::post('toefl/japan/pelatihan_test/datatable', [TEController::class, 'datatableTest']);
    });

    Route::group([
        'middleware' => 'user',
        'as' => 'user.'
    ], function(){
        Route::get('dashboard', [DashboardController::class, 'dashboardUser'])->name('dashboard');
        Route::post('dashboard/datatable', [DashboardController::class, 'datatableUser']);
        Route::get('toefl/pendaftaran', [PendaftaranController::class, 'create'])->name('create');
        Route::post('toefl/pendaftaran/store', [PendaftaranController::class, 'store'])->name('store');
        Route::get('toefl/invoice/{pendaftaran_id}', [PendaftaranController::class, 'invoice'])->name('invoice');
    });

    Route::post('/logout',[AuthController::class, 'logout'])->name('logout');
});

Route::redirect('/','/login');

Route::middleware('guest')->group(function(){
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/autentication', [AuthController::class, 'autentication'])->name('autentication');
});

// Let it on bellow
Route::fallback(function(){
    return abort(404);
});