<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Livewire\Account;
use App\Http\Livewire\Approve\DetailSertifikasi as ApproveDetailSertifikasi;
use App\Http\Livewire\Approve\Dokumen as ApproveDokumen;
use App\Http\Livewire\Approve\Sertifikasi as ApproveSertifikasi;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Passwords\Confirm;
use App\Http\Livewire\Auth\Passwords\Email;
use App\Http\Livewire\Auth\Passwords\Reset;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Auth\Verify;
use App\Http\Livewire\EmailTest;
use App\Http\Livewire\GenerateFormGli;
use App\Http\Livewire\Home;
use App\Http\Livewire\Import\ChecklistDokumen;
use App\Http\Livewire\Import\MasterData;
use App\Http\Livewire\Log;
use App\Http\Livewire\Penilaian\AssignVerifikator;
use App\Http\Livewire\Penilaian\DetailSertifikasi;
use App\Http\Livewire\Penilaian\Sertifikasi;
use App\Http\Livewire\Sertifikasi\CetakSertifikat;
use App\Http\Livewire\Sertifikasi\Data;
use App\Http\Livewire\Sertifikasi\DetailData;
use App\Http\Livewire\Sertifikasi\Dokumen;
use App\Http\Livewire\Sertifikasi\Pendaftaran;
use App\Http\Livewire\User\Approval;
use App\Http\Livewire\User\Management;
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


Route::middleware('guest')->group(function () {
    Route::get('login', Login::class)
        ->name('login');

    Route::get('register', Register::class)
        ->name('register');
});

Route::get('password/reset', Email::class)
    ->name('password.request');

Route::get('password/reset/{token}', Reset::class)
    ->name('password.reset');

Route::middleware('auth')->group(function () {

    Route::get('/', Home::class)->name('home');

    Route::prefix('sertifikasi')->group(function () {
        Route::group(['middleware' => ['role:client|super-admin']], function () {
            Route::get('/pendaftaran', Pendaftaran::class)->name('pendaftaran-sertifikasi');
            Route::get('/dokumen', Dokumen::class)->name('dokumen-sertifikasi');
        });
        Route::group(['middleware' => ['role:client|super-admin|admin']], function () {
            Route::get('/data', Data::class)->name('data-sertifikasi');
            Route::get('/data/{id}/{slug}', DetailData::class);
        });
    });

    Route::prefix('penilaian')->group(function () {
        Route::group(['middleware' => ['role:verifikator|super-admin']], function () {
            Route::get('/sertifikasi', Sertifikasi::class)->name('penilaian-sertifikasi');
            Route::get('/sertifikasi/{id}/{slug}', DetailSertifikasi::class);
        });
        Route::group(['middleware' => ['role:admin|super-admin']], function () {
            Route::get('/assign-verifikator', AssignVerifikator::class)->name('assign-verifikator');
        });
    });

    Route::prefix('approve')->group(function () {
        Route::group(['middleware' => ['role:admin|super-admin']], function () {
            Route::get('/sertifikasi', ApproveSertifikasi::class)->name('approve-sertifikasi');
            Route::get('/sertifikasi/{id}/{slug}', ApproveDetailSertifikasi::class);
        });
    });

    Route::group(['middleware' => ['role:super-admin|visitor']], function () {
        Route::get('/dokumen', ApproveDokumen::class)->name('dokumen-gli');
    });

    Route::prefix('import')->group(function () {
        Route::group(['middleware' => ['role:admin|super-admin']], function () {
            Route::get('/checklist-dokumen', ChecklistDokumen::class)->name('import-checklist-dokumen');
            Route::get('/master-data', MasterData::class)->name('master-data');
        });
    });

    Route::prefix('user')->group(function () {
        Route::group(['middleware' => ['role:super-admin']], function () {
            Route::get('/management', Management::class)->name('manage-user');
        });
        Route::group(['middleware' => ['role:admin|super-admin']], function () {
            Route::get('/approval', Approval::class)->name('approve-user');
        });
    });

    Route::get('/account', Account::class)->name('account');
    Route::get('/form-gli/{slug}', GenerateFormGli::class);
    Route::get('/test-email', EmailTest::class)->name('test-email');

    Route::group(['middleware' => ['role:super-admin']], function () {
        Route::get('/log', Log::class)->name('activity-log');
    });

    // Livewire Auth
    Route::get('email/verify', Verify::class)
        ->middleware('throttle:6,1')
        ->name('verification.notice');

    Route::get('password/confirm', Confirm::class)
        ->name('password.confirm');

    Route::get('email/verify/{id}/{hash}', EmailVerificationController::class)
        ->middleware('signed')
        ->name('verification.verify');

    Route::post('logout', LogoutController::class)->name('logout');
});

Route::get('pdf/{slug}', CetakSertifikat::class);
