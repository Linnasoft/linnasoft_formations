<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\MainController;
use App\Http\Controllers\LoginController;

Route::group(['middleware' => 'auth'] , function(){
    Route::get('/admin-dashboard', [MainController::class, 'adminDashboard']);
    
    Route::get('/admin-formations', [MainController::class, 'adminFormations']);
    Route::get('/admin-formations/{token}', [MainController::class, 'adminSingleFormation']);

    Route::get('/delete-formation/{target}', [MainController::class, 'deleteFormation']);
    Route::post('/add_new_formation/{count_date}', [MainController::class, 'addNewFormation']);

    Route::get('/delete-student/{target}', [MainController::class, 'deleteStudent']);

    Route::get('/admin-transactions', [MainController::class, 'adminTransactions']);
    Route::get('/delete-transaction/{target}', [MainController::class, 'deleteTransaction']);
    Route::post('/add_new_transaction', [MainController::class, 'addNewTransaction']);

    Route::get('/change-formation-state/{target}', [MainController::class, 'changeFormationState']);
    Route::get('/get-student-certificate/{student}', [MainController::class, 'getCertificate']);
    Route::get('/get-all-certificates/{formation}', [MainController::class, 'getAllCertificates']);

    Route::get('/deconnexion', [LoginController::class, 'logout']);
});

Auth::routes();
Route::get('/inscrivez-vous/{token}', [MainController::class, 'StudentsInscriptionIndex']);
Route::post('/register_student/{formation}', [MainController::class, 'StudentsInscription']);

Route::get('/connexion', [LoginController::class, 'loginIndex']);
Route::post('/admin-connecting', [LoginController::class, 'login']);

Route::get('/', function() {
    return redirect('/connexion');
});

Route::get('/register', function() {
    return redirect('/');
});

Route::get('/login', function() {
    return redirect('/');
});
