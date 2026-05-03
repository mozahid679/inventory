<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductTypeController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\RequisitionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\StockInController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Settings;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Role & Permission Management
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('users', UserController::class);
});

// Route::middleware(['auth', 'can:inventory_access'])->prefix('admin')->name('admin.')->group(function () {});


Route::middleware(['auth'])->prefix('admin')->as('admin.')->group(function () {

    Route::resource('suppliers', SupplierController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);

    // Stock Management
    Route::resource('stock-ins', StockInController::class);
    Route::post('stock-ins/{stockIn}/approve', [StockInController::class, 'approve'])
        ->name('stock-ins.approve');

    // Requisition Management
    Route::resource('requisitions', RequisitionController::class);
    Route::post('requisitions/{requisition}/review', [RequisitionController::class, 'review'])->name('requisitions.review');
    Route::post('requisitions/{requisition}/approve', [RequisitionController::class, 'approve'])->name('requisitions.approve');
    Route::post('requisitions/{requisition}/acknowledge', [RequisitionController::class, 'acknowledge'])->name('requisitions.acknowledge');

    // Route::get('reports/{type?}', [ReportController::class, 'index'])->name('reports.index');
    // Reports Group
    Route::prefix('reports')->as('reports.')->group(function () {
        Route::get('/category-wise', [ReportController::class, 'categoryWise'])->name('category_wise');
        Route::get('/asset-issued-detail', [ReportController::class, 'assetIssuedDetail'])->name('asset_issued_detail');
        Route::get('/product-wise', [ReportController::class, 'productWise'])->name('product_wise');
        Route::get('/supplier-wise', [ReportController::class, 'supplierWise'])->name('supplier_wise');
        Route::get('/asset-current-status', [ReportController::class, 'assetCurrentStatus'])->name('asset_current_status');
        Route::get('/consumable-summary', [ReportController::class, 'consumableSummary'])->name('consumable_summary');
        Route::get('/consumable-stock', [ReportController::class, 'consumableStock'])->name('consumable_stock');
    });
});

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {});

Route::post('stock-ins/{stockIn}/approve', [StockInController::class, 'approve'])->name('stock-ins.approve');


Route::group(['middleware' => ['can:user_management_access']], function () {
    Route::resource('users', UserController::class);
});

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::resource('product-types', ProductTypeController::class);
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('suppliers', SupplierController::class);
    Route::resource('product-types', ProductTypeController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::get('settings/profile', [Settings\ProfileController::class, 'edit'])->name('settings.profile.edit');
    Route::put('settings/profile', [Settings\ProfileController::class, 'update'])->name('settings.profile.update');
    Route::delete('settings/profile', [Settings\ProfileController::class, 'destroy'])->name('settings.profile.destroy');
    Route::get('settings/password', [Settings\PasswordController::class, 'edit'])->name('settings.password.edit');
    Route::put('settings/password', [Settings\PasswordController::class, 'update'])->name('settings.password.update');
    Route::get('settings/appearance', [Settings\AppearanceController::class, 'edit'])->name('settings.appearance.edit');
    Route::put('settings/appearance', [Settings\AppearanceController::class, 'update'])->name('settings.appearance.update');
});

require __DIR__ . '/auth.php';
