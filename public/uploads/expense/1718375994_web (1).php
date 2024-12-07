<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\AssetsCategroyController;
use App\Http\Controllers\admin\AssetsStockController;
use App\Http\Controllers\admin\CreditdaysController;
use App\Http\Controllers\admin\ExpenseCategoryController;
use App\Http\Controllers\admin\MineController;
use App\Http\Controllers\admin\VendorManagmentController;
use App\Http\Controllers\admin\MachinaryAssetController;
use App\Http\Controllers\admin\UqcController;
use App\Http\Controllers\admin\CustomerManagmentController;
use App\Http\Controllers\admin\AssignAssetController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\ExpenseManagementController;
use App\Http\Controllers\admin\DesignationController;
use App\Http\Controllers\admin\DepartmentController;
use App\Http\Controllers\admin\SaleAssetController;
use App\Http\Controllers\admin\UnitController;
use App\Http\Controllers\admin\VolumeController;
use App\Http\Controllers\admin\EmployeeController;
use App\Http\Controllers\admin\DispatchRegisterController;
use App\Http\Controllers\admin\MeterReadingController;
use App\Http\Controllers\admin\DumperMachineRegisterController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::group(['middleware' => 'guest'], function () {

    Route::get('/', [AuthController::class, 'index'])->name('login');
    Route::post('login-post', [AuthController::class, 'login'])->name('loginpost');

    // Route::post('login', [AuthController::class,'login'])->name('login')->middleware('throttle:2,1'); // ->middleware('throttle:2,1') how many time user can hit form

    Route::get('register', [AuthController::class, 'registr_view'])->name('register');
    Route::post('register', [AuthController::class, 'registr'])->name('register');

    // Route::post('register', [AuthController::class,'registr'])->name('register')->middleware('throttle:2,1');

});

Route::group(['middleware' => 'auth'], function () {

    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('changepassword/{id}', [AuthController::class, 'changepassword'])->name('change-password');
    Route::post('post-changepassword', [AuthController::class, 'postchangepassword'])->name('post-change-password');

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ------Assets Category------
    Route::get('assets-category', [AssetsCategroyController::class, 'index'])->name('assets-category');
    Route::post('add-assets-category', [AssetsCategroyController::class, 'addCategory'])->name('add-assets-category');
    Route::post('update-assets-category/{id}', [AssetsCategroyController::class, 'update'])->name('update-assets-category');
    Route::get('delete-assets-category/{id}', [AssetsCategroyController::class, 'delete'])->name('delete-assets-category');

    //----------------Department--------------
    Route::resource("unit",UnitController::class)->names([
        'index' => 'unit'
    ]);

    //------credit_daysh------
    Route::get('credit-days', [CreditdaysController::class, 'index'])->name('credit-days');
    Route::post('add-credit-daysh', [CreditdaysController::class, 'store'])->name('add-credit-daysh');
    Route::post('update-days/{id}', [CreditdaysController::class, 'update'])->name('update-days');
    Route::get('delete-days/{id}', [CreditdaysController::class, 'delete'])->name('delete-days');

    //------expense_category------
    Route::get('expense-category', [ExpenseCategoryController::class, 'index'])->name('expense-category');
    Route::post('add-expense-category', [ExpenseCategoryController::class, 'store'])->name('add-expense-category');
    Route::post('update-expense-category', [ExpenseCategoryController::class, 'update'])->name('update-expense-category');
    Route::get('delete-expense-category/{id}', [ExpenseCategoryController::class, 'delete'])->name('delete-expense-category');


    ///   ------mine------
      Route::get('mine', [MineController::class, 'list'])->name('mine');
    Route::get('add-mine', [MineController::class, 'add'])->name('add-mine');
    Route::post('store-mine', [MineController::class, 'store'])->name('store-mine');
    Route::get('edit-mine/{id}', [MineController::class, 'edit'])->name('edit-mine');
    Route::post('update-mine', [MineController::class, 'update'])->name('update-mine');
    Route::get('delete-mine/{id}', [MineController::class, 'delete'])->name('delete-mine');

    Route::post('get-state-by-cites', [MineController::class, 'getCity'])->name('getCity');

    //Customer Managment
    Route::get('/customer-managment', [CustomerManagmentController::class, 'index'])->name('customer-managment');
    Route::post('/add-customer-managment', [CustomerManagmentController::class, 'store'])->name('add-customer-managment');
    Route::post('update-customer-managment/{id}', [CustomerManagmentController::class, 'update'])->name('update-customer-managment');
    Route::get('delete-customer-managment/{id}', [CustomerManagmentController::class, 'delete'])->name('delete-customer-managment');
    Route::post('get-state-by-cites', [CustomerManagmentController::class, 'getCity']);

    //vendor Managment
    Route::get('/vendor-managment', [VendorManagmentController::class, 'index'])->name('vendor-managment');
    Route::post('/add-vendor-managment', [VendorManagmentController::class, 'store'])->name('add-vendor-managment');
    Route::post('update-vendor-managment/{id}', [VendorManagmentController::class, 'update'])->name('update-vendor-managment');
    Route::get('delete-vendor-managment/{id}', [VendorManagmentController::class, 'delete'])->name('delete-vendor-managment');
    Route::post('get-state-by-cites', [VendorManagmentController::class, 'getCity']);


    ///// Quc ////
    Route::get('/quc-managment', [UqcController::class, 'index'])->name('quc-managment');
    Route::post('/quc-store-managment', [UqcController::class, 'store'])->name('quc-store-managment');
    Route::get('/quc-edit-managment', [UqcController::class, 'edit'])->name('quc-edit-managment');
    Route::post('/quc-update-managment', [UqcController::class, 'update'])->name('quc-update-managment');
    Route::get('/quc-delete-managment/{id}', [UqcController::class, 'delete'])->name('quc-delete-managment');


    //// mine machinary assets list //
    Route::get('/machinery-assets', [MachinaryAssetController::class, 'list'])->name('machinery-assets');
    Route::get('/machinery-assets-add', [MachinaryAssetController::class, 'add'])->name('machinery-assets-add');
    Route::post('/machinery-assets-store', [MachinaryAssetController::class, 'store'])->name('machinery-assets-store');
    Route::get('/machinery-assets-edit/{id}', [MachinaryAssetController::class, 'edit'])->name('machinery-assets-edit');
    Route::post('/machinery-assets-update', [MachinaryAssetController::class, 'update'])->name('machinery-assets-update');
    Route::get('/machinery-assets-deletet/{id}', [MachinaryAssetController::class, 'delete'])->name('machinery-assets-delete');
    Route::get('/machinery-assets-view', [MachinaryAssetController::class, 'view'])->name('machinery-assets-view');
    Route::get('get-assets-name',[SaleAssetController::class, 'getAssetsName'])->name("get-assets-name");
    Route::resource("assets-assign",SaleAssetController::class)->names([
        'index' => 'assets-assign'
    ]);
    Route::get("/assets-stock",[AssetsStockController::class,'index'])->name('assets-stock');
    //Assign Asset
    Route::get('/assign-asset', [AssignAssetController::class, 'index'])->name('assign-asset');
    Route::post('/add-assign-asset', [AssignAssetController::class, 'store'])->name('add-assign-asset');
    Route::get('/edit-assign-asset', [AssignAssetController::class, 'edit'])->name('edit-assign-asset');
    Route::post('/update-assign-asset', [AssignAssetController::class, 'update'])->name('update-assign-asset');
    Route::get('/delete-assign-asset/{id}', [AssignAssetController::class, 'delete'])->name('delete-assign-asset');
    Route::get('/view-assign-asset', [AssignAssetController::class, 'view'])->name('view-assign-asset');

    ///product///
    Route::get('/product', [ProductController::class, 'index'])->name('product');
    Route::post('/add-product', [ProductController::class, 'store'])->name('add-product');
    Route::get('/edit-product', [ProductController::class, 'edit'])->name('edit-product');
    Route::post('/update-product', [ProductController::class, 'update'])->name('update-product');
    Route::get('/view-product', [ProductController::class, 'viewproduct'])->name('view-product');
    Route::get('/delete-product/{id}', [ProductController::class, 'delete'])->name('delete-product');



     //// Expense  ///
    Route::get('/expense', [ExpenseManagementController::class, 'list'])->name('expense');
    Route::post('/expense-store', [ExpenseManagementController::class, 'store'])->name('store-expense');
    Route::get('/expense-edit', [ExpenseManagementController::class, 'edit'])->name('edit-expense');
    Route::post('/expense-update', [ExpenseManagementController::class, 'update'])->name('update-expense');
    Route::get('/view-expense', [ExpenseManagementController::class, 'view'])->name('view-expense');
    Route::get('/expense-delete/{id}', [ExpenseManagementController::class, 'delete'])->name('delete-expense');

    //department
    Route::get('/department', [DepartmentController::class, 'index'])->name('department');
    Route::post('/add-department', [DepartmentController::class, 'store'])->name('add-department');
    Route::get('/edit-department', [DepartmentController::class, 'edit'])->name('edit-department');
    Route::post('/update-department', [DepartmentController::class, 'update'])->name('update-department');
    Route::get('/delete-department/{id}', [DepartmentController::class, 'delete'])->name('delete-department');

      //designation
      Route::get('/designation', [DesignationController::class, 'index'])->name('designation');
      Route::post('/add-designation', [DesignationController::class, 'store'])->name('add-designation');
      Route::get('/edit-designation', [DesignationController::class, 'edit'])->name('edit-designation');
      Route::post('/update-designation', [DesignationController::class, 'update'])->name('update-designation');
      Route::get('/delete-designation/{id}', [DesignationController::class, 'delete'])->name('delete-designation');
      
          //volume
      Route::get('/volume', [VolumeController::class, 'index'])->name('volume');
      Route::post('/add-volume', [VolumeController::class, 'store'])->name('volume.store');
      Route::get('/edit-volume', [VolumeController::class, 'edit'])->name('volume.edit');
      Route::post('/update-volume', [VolumeController::class, 'update'])->name('volume.update');
      Route::get('/delete-volume/{id}', [VolumeController::class, 'delete'])->name('volume.delete');

      
      //employee
      Route::get('/employee', [EmployeeController::class, 'index'])->name('employee');
      Route::post('/add-employee', [EmployeeController::class, 'store'])->name('employee.store');
      Route::get('/edit-employee', [EmployeeController::class, 'edit'])->name('employee.edit');
      Route::post('/update-employee', [EmployeeController::class, 'update'])->name('employee.update');
      Route::get('/delete-employee/{id}', [EmployeeController::class, 'delete'])->name('employee.delete');
      
      
    // Daily REgistr
    Route::resource("dispatch-register",DispatchRegisterController::class)->names([
        'index' => 'dispatch-register'
    ]);
    
    // Meter Reading Registr
        Route::resource("meter-reading",MeterReadingController::class)->names([
            'index' => 'meter-reading'
        ]);
    
    // Dumper & M/C Working Register
    Route::get('/dumpermachine-register', [DumperMachineRegisterController::class, 'index'])->name('dumpermachine-register');
    Route::post('/add-dumpermachine-register', [DumperMachineRegisterController::class, 'store'])->name('dumpermachine-register.store');
    Route::get('/edit-dumpermachine-register', [DumperMachineRegisterController::class, 'edit'])->name('dumpermachine-register.edit');
    Route::post('/update-dumpermachine-register', [DumperMachineRegisterController::class, 'update'])->name('dumpermachine-register.update');
    Route::get('/delete-dumpermachine-register/{id}', [DumperMachineRegisterController::class, 'delete'])->name('dumpermachine-register.delete');
   

});
