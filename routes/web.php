<?php

use App\Http\Controllers\Dashboard\{DashboardController,
    DistrictController,
    GroupController,
    HistoryController,
    ProfileController,
    ProvinceController,
    ReceiverController,
    StationController,
    SubmissionController,
    SubmissionReportController,
    UserController};
use App\Http\Controllers\PrintCardController;
use Illuminate\Support\Facades\{Auth, Route};

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

Auth::routes([
    'verify' => false,
    'register' => false,
    'reset' => false
]);

Route::get('/recommendation-letter', function () {
    return view('documents.recommendation-letter');
});

Route::get('/', [PrintCardController::class, 'index'])->name('card');

Route::middleware('auth')->group(function () {

    Route::post('/check-nik', [PrintCardController::class, 'checkNik'])->name('check-nik');

    Route::post('/print-card', [PrintCardController::class, 'printCard'])->name('print-card');

    Route::prefix('dashboard')->group(function () {
        Route::name('dashboard.')->group(function () {
            Route::get('/', [DashboardController::class, 'index'])->name('home');
        });

        Route::name('notifications.')->group(function () {
            Route::get('/notifications/mark-as-read', [DashboardController::class, 'markAsRead'])->name('markAsRead');
        });

        Route::name('user.')->group(function () {
            Route::get('profile', [ProfileController::class, 'index'])->name('profile');
            Route::post('profile/{user}', [ProfileController::class, 'update'])->name('updateProfile');
            Route::get('change-password', [ProfileController::class, 'showPasswordForm'])->name('showPasswordForm');
            Route::post('change-password', [ProfileController::class, 'changePassword'])->name('change-password');
            Route::prefix('users')->group(function () {
                Route::post('activate/{user}', [UserController::class, 'activate'])->name('activate');
                Route::get('inactive', [UserController::class, 'inactive'])->name('inactive');
            });
        });
        Route::name('stations.')->prefix('station')->group(function () {
            Route::post('getStationsByDistrict', [StationController::class, 'getByDistrict'])->name('getStationsByDistrict');
            Route::get('getStationsWithAjax', [StationController::class, 'getAllWithAjax'])->name('performAjax');
        });
        Route::name('provinces.')->prefix('province')->group(function () {
            Route::get('regencies/{province}', [ProvinceController::class, 'getAllRegencies'])->name('regencies');
        });
        Route::name('districts.')->prefix('district')->group(function () {
            Route::get('villages/{district}', [DistrictController::class, 'getAllVillages'])->name('villages');
        });
        Route::resources([
            'stations' => StationController::class,
            'users' => UserController::class,
            'receivers' => ReceiverController::class,
            'groups' => GroupController::class
        ], ['except' => ['show']]);
        Route::resource('submissions', SubmissionController::class)->except('update');
        Route::get('histories/print/{date}', [HistoryController::class, 'print'])->name('print-history');
        Route::resource('histories', HistoryController::class)->only('index');
        Route::name('submission-report.')->prefix('submission-report')->group(function (){
            Route::get('/', [SubmissionReportController::class, 'index'])->name('index');
            Route::get('/print/{date}', [SubmissionReportController::class, 'print'])->name('print');
        });
        Route::get('getGroupByKecamatan/{district}', [GroupController::class, 'getGroupByKecamatan'])->name('getGroupByKecamatan');

        Route::name('submission.')->group(function () {
            Route::get('download-letter/{submission}', [SubmissionController::class, 'downloadLetter'])->name('downloadLetter');
            Route::post('update-submission', [SubmissionController::class, 'updateSubmission'])->name('updateSubmission');
            Route::get('create-submission/{id}', [SubmissionController::class, 'createForm'])->name('createForm');
            Route::post('excel-upload', [SubmissionController::class, 'uploadExcelToServer'])->name('excelUpload');
            Route::get('receiver/{id}', [SubmissionController::class, 'getReceiverBySubmission'])->name('receiver');
            Route::post('receivers-upload', [SubmissionController::class, 'storeReceivers'])->name('receiverUpload');
            Route::prefix('submission')->group(function () {
                Route::prefix('unverified')->group(function () {
                    Route::get('/', [SubmissionController::class, 'unverified'])->name('unverified');
                    Route::get('{submission}', [SubmissionController::class, 'unverifiedDetail'])->name('unverified_detail');
                });
                Route::prefix('verified')->group(function () {
                    Route::get('/', [SubmissionController::class, 'verified'])->name('verified');
                    Route::get('{submission}', [SubmissionController::class, 'verifiedDetail'])->name('verified_detail');
                });
                Route::get('totalQuota/{submission}', [SubmissionController::class, 'getTotalQuota'])->name('getTotalQuota');
                Route::get('trashed', [SubmissionController::class, 'trashedSubmission'])->name('trashed');
                Route::post('restore/{id}', [SubmissionController::class, 'restoreSubmission'])->name('restore');
            });
        });
    });
});
