<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

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
    return view('register');
});

Route::post('register-employee', [EmployeeController::class, 'registerEmp'])->name('registerEmp');

Route::get('/get-employees', function(){
    return view('employees');
});

Route::get('/get-all-employees', [EmployeeController::class, 'getEmployees'])->name('getEmployees');
Route::get('updateEmployee/{id}', [EmployeeController::class, 'updateEmployee']);
Route::post('update-data', [EmployeeController::class, 'updateEmp'])->name('updateEmp');
Route::get('delete-data/{id}', [EmployeeController::class, 'deleteEmp']);