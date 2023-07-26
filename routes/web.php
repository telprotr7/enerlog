<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AcController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\ControllingContoller;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\MonitoringController;

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



Route::get('/auth/test', function () {
    return view('auth.test');
});


// AUTH
Route::get('/auth/login', [AuthController::class, "index"])->name('login');
Route::post('/auth/login', [AuthController::class, 'postLogin'])->name('login.post');
Route::post('/logout/{id}', [AuthController::class, 'logout']);
Route::post('/resgister', [AuthController::class, 'registerPost'])->name('resgister.post');
Route::post('/auth/forgot-password', [AuthController::class, 'forgotPassPost'])->name('forget.password.post');
Route::get('/reset-password/{token}/{email}', [AuthController::class, 'resetPassword'])->name('reset.password');
Route::post('/reset-password', [AuthController::class, 'resetPasswordPost'])->name('reset.password.post');



// HOME
Route::get('/home', [HomeController::class, "index"])->name('home');


// MEMBERS
Route::get('/members', [MembersController::class, "index"])->name('members.all');
Route::post('/members', [MembersController::class, "addMember"])->name('members.add');
Route::delete('/members/delete/{id}', [MembersController::class, "destroyMember"]);
Route::post('/members/update/{id}', [MembersController::class, "updateMember"]);
Route::get('/members/detail-member/{id}', [MembersController::class, "detailsMember"]);


// AC
Route::get('/ac', [AcController::class, 'index']);
Route::delete('/selectedac', [AcController::class, 'deleteCheckedAc'])->name('ac.deleteSelected')->middleware('auth');
Route::get('/ac/create', [AcController::class, 'create'])->middleware('auth');
Route::post('/ac/create', [AcController::class, 'store'])->middleware('auth');
Route::get('/ac/trash', [AcController::class, 'trash'])->middleware('auth');
Route::delete('ac/trash/{id}', [AcController::class, 'restore'])->middleware('auth');
Route::get('/ac/trash/deleteAll', [AcController::class, 'deleteAll'])->middleware('auth');
Route::get('/ac/delete/{id}', [ACController::class, 'destroy'])->name('delete')->middleware('auth');
Route::get('/ac/dataacbaru/{data}', [AcController::class, 'queryDataAcBaru']);
Route::get('/ac/range/{nilai}', [ACController::class, 'queryRangeAc'])->middleware('auth');
Route::get('/ac/update/{id}', [ACController::class, 'show'])->middleware('auth');
Route::post('/ac/update/{id}', [ACController::class, 'update'])->middleware('auth');
Route::get('/ac/export', [ACController::class, 'exportDataAc'])->middleware('auth');
Route::get('/ac/listmainten', [AcController::class, 'listMainten'])->middleware('auth');



// CHART
Route::get('/chart', [ChartController::class, 'index'])->middleware('auth');
Route::post('/chart/create', [ChartController::class, 'store'])->middleware('auth');
Route::delete('/chart/delete/{id}/{tahun}', [chartController::class, 'destroy'])->middleware('auth');
Route::post('chart/update', [chartController::class, 'update']);
Route::get('/chart/search', [chartController::class, "searchChart"]);
Route::post('/chart/deleteallchart', [chartController::class, "deleteAllChart"])->name('delete.all');
Route::post('/chart/ac', [HomeController::class, 'getChart'])->name('chart.getchart');


// TASK
Route::get('/task', [TasksController::class, 'index']);
Route::get('/tasks/create', [TasksController::class, 'create'])->name('tasks.create');
Route::post('/tasks', [TasksController::class, 'store'])->name('tasks.store');
Route::get('/tasks/update/{id}', [TasksController::class, 'edit'])->name('tasks.edit');
Route::post('/tasks/update-data/{id}', [TasksController::class, 'update'])->name('tasks.update');
Route::get('/tasks/delete/{id}', [TasksController::class, 'destroy'])->name('delete')->middleware('auth');


// MONITORING
Route::get('/monitoring', [MonitoringController::class, 'index'])->name('monitoring')->middleware('auth');



// CONTROLLING
Route::get('/controlling', [ControllingContoller::class, 'index'])->name('controlling')->middleware('auth');


// ACARA
Route::resource('/kegiatan', KegiatanController::class);
Route::get('/kegiatan/range-kegiatan/{nilai}', [KegiatanController::class, 'rangeKegiatan']);
Route::get('/kegiatan/export/excel', [KegiatanController::class, 'exportDataKegiatan'])->name('kegiatan.export')->middleware('auth');

