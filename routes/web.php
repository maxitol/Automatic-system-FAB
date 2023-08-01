<?php

use App\Http\Controllers\DataBaseController;
use App\Http\Controllers\DocController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrdersController;

Route::get('/', function () {
    return view('home');
});
Route::get('/register', function () {
    return view('register');
});



Route::middleware('auth')->group(function () {
    Route::get('/home', [\App\Http\Controllers\DataBaseController::class, 'Newses'])->name('home');
    Route::post('/deleteNew', [\App\Http\Controllers\DataBaseController::class, 'deleteNew'])->name('deleteNew');
});
Route::middleware('auth')->group(function () {
    Route::get('/database', [DataBaseController::class, 'database'])->name('database');
    Route::get('/database/customers', [DataBaseController::class, 'customers'])->name('databases.customers');
    Route::get('/database/addCustomers', [DataBaseController::class, 'addNewCustomersForm'])->name('databases.addCustomers');
    Route::post('/database/addCustomers', [DataBaseController::class, 'addCustomers'])->name('addCustomers');
    Route::get('/database/contracts', [DataBaseController::class, 'contracts'])->name('databases.contracts');
    Route::get('/database/addContracts', [DataBaseController::class, 'addNewContractsForm'])->name('databases.addContracts');
    Route::post('/database/addContracts', [DataBaseController::class, 'addContracts'])->name('addContracts');
    Route::post('/database/addContract', [DocController::class, 'generateDocx'])->name('generateDocx');
    Route::get('/database/orders', [DataBaseController::class, 'orders'])->name('databases.orders');
    Route::get('/database/addOrders/{id}', [DataBaseController::class, 'addNewOrdersForm'])->name('databases.addOrders');
    Route::post('/database/addOrders/{id}', [DataBaseController::class, 'addOrders'])->name('addOrders');
    Route::post('/database/deleteOrder', [DataBaseController::class, 'deleteOrder'])->name('deleteOrder');
    Route::get('/database/editOrders/{id}', [DataBaseController::class, 'editOrdersForm'])->name('databases.editOrdersForm');
    Route::post('/database/editOrders/{id}', [DataBaseController::class, 'editOrders'])->name('databases.editOrders');
    Route::get('/database/editCustomers/{id}', [DataBaseController::class, 'editCustomersForm'])->name('databases.editCustomersForm');
    Route::post('/database/editCustomers/{id}', [DataBaseController::class, 'editCustomers'])->name('databases.editCustomers');
    Route::post('/database/deleteCustomer', [DataBaseController::class, 'deleteCustomer'])->name('deleteCustomer');
    Route::get('/database/editContracts/{id}', [DataBaseController::class, 'editContractsForm'])->name('databases.editContractsForm');
    Route::post('/database/editContracts/{id}', [DataBaseController::class, 'editContracts'])->name('databases.editContracts');
    Route::post('/database/deleteContract', [DataBaseController::class, 'deleteContract'])->name('deleteContract');
});
Route::middleware('auth')->group(function () {
    Route::get('/evaluation', function () {
        return view('orders');
    })->name('evaluation');
    Route::get('/evaluation/report', [EvaluationController::class, 'evaluationView'])->name('evaluation.report');
    Route::get('/evaluation/rules', [EvaluationController::class, 'evaluationRulesView'])->name('evaluation.rules');
    Route::post('/evaluation/reportDownload', [DocController::class, 'reportDownload'])->name('reportDownload');
});
Route::middleware('auth')->group(function () {
    Route::get('/reports', function () {
        return view('reports');
    })->name('reports');
    Route::get('/reports/reportDateOrder', [ReportController::class, 'reportDateDocument'])->name('reportDateDocument');
    Route::post('/reports/reportDateOrderSend', [ReportController::class, 'reportDateDocumentSend'])->name('reportDateDocumentSend');
    Route::get('/reports/lastChanges', [ReportController::class, 'lastChanges'])->name('lastChanges');
    Route::post('/reports/lastChangesSend', [ReportController::class, 'lastChangesSend'])->name('lastChangesSend');
    Route::get('/reports/reportSum', [ReportController::class, 'reportSum'])->name('reportSum');
    Route::post('/reports/reportSumSend', [ReportController::class, 'reportSumSend'])->name('reportSumSend');
    Route::get('/reports/reportStatus', [ReportController::class, 'reportStatus'])->name('reportStatus');
    Route::post('/reports/reportStatusSend', [ReportController::class, 'reportStatusSend'])->name('reportStatusSend');
});

Route::middleware('auth', 'admin')->group(function () {
    Route::get('/adminPanel', function () {
        return view('adminPanel');
    })->name('adminPanel');
    Route::get('/adminPanel/addNews', [\App\Http\Controllers\AdminPanelController::class, 'addNews'])->name('addNews');
    Route::get('/adminPanel/userPanel', [\App\Http\Controllers\AdminPanelController::class, 'userPanel'])->name('userPanel');
    Route::get('/adminPanel/userPanel/newUser', [\App\Http\Controllers\AdminPanelController::class, 'newUser'])->name('newUser');
    Route::post('/adminPanel/userPanel', [\App\Http\Controllers\AdminPanelController::class, 'addUser'])->name('addUser');
    Route::post('/adminPanel/addNewNews', [\App\Http\Controllers\AdminPanelController::class, 'addNewNews'])->name('addNewNews');
    Route::post('/adminPanel/deleteUser', [\App\Http\Controllers\DataBaseController::class, 'deleteUser'])->name('deleteUser');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
