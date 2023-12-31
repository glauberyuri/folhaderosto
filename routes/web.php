<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CallsPageController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

// CHECK LIST PAGE RECEPÇÃO
Route::get('/checklistrecep', function () {
    return view('CheckListRecepPage');
});

Route::get('/relatoriofolhaderosto', function () {
    return view('RelatoriosFolhaRosto');
});

Route::get('/checklistrecep/{id}', [CallsPageController::class, 'getCheckList'] );


//Farmacia Hospitalar

Route::get('/listpharmacy_requests', [CallsPageController::class, 'tableRequest']);
Route::get('/pharmacy_requests', [CallsPageController::class, 'getRequests']);
Route::get('pharmacy_request/{id}', [CallsPageController::class, 'pharmacyRequest'])->name('pharmacy.pharmacyRequest');

// Atendimentos
Route::get('/atendimentos', [CallsPageController::class, 'list']);
Route::get('/integra', [CallsPageController::class, 'integraDRG']);

Route::post('upload', [CallsPageController::class, 'uploadPost'] );
Route::get('readCsv', [CallsPageController::class, 'readCsv'] );
Route::get('/atendimento/{id}', [CallsPageController::class, 'show']);

