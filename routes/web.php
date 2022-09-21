<?php

use App\Http\Controllers\Dashboard\{DashboardController,
    DistrictController,
    ProfileController,
    StationController,
    SubmissionController,
    UserController};
use App\Http\Controllers\HomeController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes([
    'verify' => false,
    'register' => false,
    'reset' => false
]);

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth'], 'prefix' => 'dashboard'], function () {
    Route::name('dashboard.')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('home');
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
        Route::get('getStationsWithAjax', [StationController::class, 'getAllWithAjax'])->name('performAjax');
    });
    Route::name('districts.')->prefix('district')->group(function () {
        Route::get('villages/{district}', [DistrictController::class, 'getAllVillages'])->name('villages');
    });
    Route::resources([
        'stations' => StationController::class,
        'users' => UserController::class
    ], ['except' => ['show']]);
    Route::resource('submissions', SubmissionController::class);
    Route::name('submission.')->group(function () {
        Route::get('create-submission/{id}', [SubmissionController::class, 'createForm'])->name('createForm');
        Route::post('excel-upload', [SubmissionController::class, 'uploadExcelToServer'])->name('excelUpload');
        Route::get('receiver/{id}', [SubmissionController::class, 'getReceiverBySubmission'])->name('receiver');
        Route::post('receivers-upload', [SubmissionController::class, 'storeReceivers'])->name('receiverUpload');
    });

});

