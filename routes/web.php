<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ZakatController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\QurbanController;
use App\Http\Controllers\GasController;
use App\Http\Controllers\PublikController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\HelpController;

// landing page 
Route::get('/', [PublikController::class, 'index'])->name('page_home');
Route::get('/keuangan', [PublikController::class, 'pageKeuangan'])->name('page_keuangan');
Route::get('/program&layanan', [PublikController::class, 'pageProgramLayanan'])->name('page_program&layanan');
// login 
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'enterDashboard']);
});
// logout
Route::get('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');
    // route dashboard
Route::prefix('admin')->middleware('auth')->group(function () {
    //route dashboard
    Route::controller(DashboardController::class)->group(function (){
        Route::get('/dashboard',  'index')->name('dashboard');
        Route::post('/dashboard/report-pdf',  'exportBulanan')->name('dashboard_export');
        Route::delete('/dashboard/delete',  'deleteBulan');
    });
    //route keuangan
    Route::controller(KeuanganController::class)->group(function () {
        Route::get('/keuangan', 'index')->name('keuangan');
        Route::get('/keuangan/create', 'createKeuangan')->name('create_dataKeuangan');
        Route::post('/keuangan', 'storeKeuangan');
        Route::get('/keuangan/{id}/edit', 'editKeuangan')->name('edit_dataKeuangan');
        Route::patch('/keuangan', 'updateKeuangan');
        Route::delete('/keuangan/delete', 'deleteKeuangan')->name('delete_dataKeuangan');
        Route::get('/keuangan/report-pdf', 'reportPDF')->name('laporan_keuangan');
    });
    // route GAS (gerakan amal sholeh)
    Route::controller(GasController::class)->group(function () {
        Route::get('/gas', 'index')->name('gas');
        Route::get('/gas/create', 'createProgram')->name('create_program');
        Route::post('/gas', 'storeProgram')->name('store_program');
        Route::get('/gas/{id}/edit', 'tampilanEditProgram')->name('edit_program');
        Route::patch('/gas', 'simpanPerubahanProgram')->name('simpanPerubahan_program');
        Route::delete('/gas/{id}/delete', 'deleteProgram')->name('delete_program');
        Route::get('/gas/{id}/view', 'viewProgram')->name('view_program');
        // untuk jamaah
        Route::get('/gas/{id}/view/create', 'tambahJamaah')->name('create_jamaah');
        Route::post('/gas/{id}/view', 'storeJamaah')->name('store_jamaah');
        Route::get('/gas/{id}/view/{idJamaah}/edit', 'editJamaah')->name('edit_jamaah');
        Route::patch('/gas/{id}/view', 'updateJamaah')->name('update_jamaah');
        Route::delete('/gas/{id}/view/{idJamaah}/delete', 'deleteJamaah')->name('delete_jamaah');
        Route::get('/gas/{id}/view/reportJamaah', 'reportJamaah')->name('report_jamaah');
    });
    // route zakat
    Route::controller(ZakatController::class)->group(function () {
        Route::get('/zakat', 'index')->name('zakat');
        Route::get('/zakat/create', 'createZakat')->name('create_zakat');
        Route::post('/zakat', 'storeZakat');
        Route::get('/zakat/{id}/edit', 'editZakat')->name('edit_zakat');
        Route::patch('/zakat', 'updateZakat');
        Route::delete('/zakat/{id}/delete', 'deleteZakat');
        // view Zakat
        Route::get('/zakat/{id}/view', 'viewZakat')->name('view_zakat');
        // data muzakki
        Route::get('/zakat/{id}/view/createMuzakki', 'createMuzakki')->name('create_muzakki');
        Route::post('/zakat/{id}/view', 'storeMuzakki');   
        Route::get('/zakat/{id}/view/{idMuzakki}/edit', 'editMuzakki')->name('edit_muzakki');
        Route::patch('/zakat/{id}/view', 'updateMuzakki');
        Route::delete('/zakat/{id}/view/{idMuzakki}/delete', 'deleteMuzakki');
        Route::get('/zakat/{id}/view/reportMuzakki', 'reportMuzakki');
        // salurzakat
        Route::get('/zakat/{id}/view/salurZakat', 'salurZakat')->name('salur_zakat');
        // create Mustahik
        Route::get('/zakat/{id}/view/salurZakat/createMustahik', 'createMustahik')->name('create_mustahik');
        Route::post('/zakat/{id}/view/salurZakat', 'storeMustahik');   
        Route::get('/zakat/{id}/view/salurZakat/{idMustahik}/edit', 'editMustahik')->name('edit_mustahik');
        Route::patch('/zakat/{id}/view/salurZakat', 'updateMustahik');
        Route::delete('/zakat/{id}/view/salurZakat/{idMustahik}/delete', 'deleteMustahik');
        Route::get('/zakat/{id}/view/salurZakat/reportMustahik', 'reportMustahik');
    });
    //route qurban
    Route::controller(QurbanController::class)->group(function() {
        Route::get('/qurban', 'index')->name('qurban');
        Route::get('/qurban/create', 'createQurban')->name('create_qurban');
        Route::post('/qurban', 'storeQurban')->name('store_qurban');
        Route::get('/qurban/{id}/edit', 'editQurban')->name('edit_qurban');
        Route::patch('/qurban', 'updateQurban');
        Route::delete('/qurban/{id}/delete', 'deleteQurban');
        Route::get('/qurban/{id}/viewQurban', 'viewQurban')->name('view_qurban');
        Route::get('/qurban/{id}/viewQurban/createShohibul', 'createShohibul')->name('create_shohibul');
        Route::post('/qurban/{id}/viewQurban', 'storeShohibul');
        Route::get('/qurban/{id}/viewQurban/{idShohibul}/edit', 'editShohibul')->name('edit_shohibul');
        Route::patch('/qurban/{id}/viewQurban', 'updateShohibul');
        Route::delete('/qurban/{id}/viewQurban/{idShohibul}/delete', 'deleteShohibul');
        Route::get('/qurban/{id}/viewQurban/pengurutan', 'pengurutanShohibul')->name('pengurutan_shohibul');
        Route::get('/qurban/{id}/viewQurban/pengurutan/reportQurban', 'exportShohibul')->name('report_pengurutan');
    });
    Route::controller(settingController::class)->group(function(){
        Route::get('/setting', 'index')->name('setting');
        Route::get('/setting/profile', 'editProfile')->name('setting_profile');
        Route::patch('/setting/profile', 'updateProfile');
        Route::get('/setting/password', 'editPassword')->name('setting_password');
        Route::patch('/setting/password', 'updatePassword');
    });
    Route::get('/help', [HelpController::class, 'index'])->name('help');
});

Route::fallback(function () {
    return '404';
});