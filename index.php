<?php
// Khởi tạo session


require_once __DIR__ . '/env.php';
require_once __DIR__ . '/vendor/autoload.php';

use App\Controllers\Admin\AttributeController;
use App\Controllers\Admin\BrandController;
use App\Controllers\Admin\DashboardController;
use App\Controllers\Admin\PermissionController;
use App\Controllers\Admin\ProductCatalogueController;
use App\Controllers\Admin\ProductController;
use App\Controllers\Admin\ProfileController;
use App\Controllers\Admin\UserCatalogueController;
use App\Controllers\Admin\UserController;
use App\Controllers\Auth\AuthenticatedSessionController;
use App\Controllers\Frontend\HomeController;
use Libs\Helper;
use Libs\Route;
use Libs\Session;
use Middlewares\AuthMiddleware;

Session::init();
$router = new Route();




Route::get('/', [HomeController::class, 'index']);
Route::get("/admin/login", [AuthenticatedSessionController::class, 'create']);
Route::post("/admin/login", [AuthenticatedSessionController::class, 'store']);
Route::get("/register", [AuthenticatedSessionController::class, 'register']);
Route::post("/register", [AuthenticatedSessionController::class, 'storeRegister']);
Route::get("/logout", [AuthenticatedSessionController::class, 'logout']);

Route::get('/admin', [DashboardController::class, 'index'], ['auth', 'admin']);



// User Route
Route::get("/admin/user",                   [UserController::class, 'index'],           ['auth', 'admin']);
Route::get("/admin/user/create",            [UserController::class, 'create'],          ['auth', 'admin']);
Route::post("/admin/user/create",           [UserController::class, 'store'],           ['auth', 'admin']);
Route::get("/admin/user/{id}/edit",         [UserController::class, 'edit'],            ['auth', 'admin']);
Route::put("/admin/user/{id}",              [UserController::class, 'update'],          ['auth', 'admin']);
Route::destroy("/admin/user/{id}",          [UserController::class, 'deleted'],         ['auth', 'admin']);
Route::put("/admin/user/changeStatus/{id}", [UserController::class, 'changeStatus'],    ['auth', 'admin']);

/** User Catalogue */
Route::get("/admin/userCatalogue", [UserCatalogueController::class, 'index'], ['auth', 'admin']);
Route::get("/admin/userCatalogue/create", [UserCatalogueController::class, 'create'], ['auth', 'admin']);
Route::post("/admin/userCatalogue/create", [UserCatalogueController::class, 'store'], ['auth', 'admin']);
Route::get('/admin/userCatalogue/{id}/edit', [UserCatalogueController::class, 'edit'], ['auth', 'admin']);
Route::put('/admin/userCatalogue/{id}', [UserCatalogueController::class, 'update'], ['auth', 'admin']);
Route::put("/admin/userCatalogue/changeStatus/{id}", [UserCatalogueController::class, 'changeStatus'], ['auth', 'admin']);
Route::destroy("/admin/{id}/userCatalogue", [UserCatalogueController::class, 'delete'], ['auth', 'admin']);



// User Catalogue Permission
Route::get("/admin/userCatalogue/permission", [UserCatalogueController::class, 'userCataloguePermission'], ['auth', 'admin']);
Route::get("/admin/userCatalogue/storePermission", [UserCatalogueController::class, 'userCatalogueStorePermission'], ['auth', 'admin']);
Route::destroy("/admin/userCatalogue/deletePermission", [UserCatalogueController::class, 'userCatalogueDeletePermission'], ['auth', 'admin']);


// Permission Route
Route::get("/admin/permission", [PermissionController::class, 'index'], ['auth', 'admin']);
Route::get("/admin/permission/create", [PermissionController::class, 'create'], ['auth', 'admin']);
Route::post("/admin/permission/create", [PermissionController::class, 'store'], ['auth', 'admin']);


// Profile 
Route::get("/admin/profile", [ProfileController::class, 'index'], ['auth', 'admin']);
Route::post("/admin/profile", [ProfileController::class, 'update'], ['auth', 'admin']);
Route::post("/admin/profile/changePassword", [ProfileController::class, 'changePassword'], ['auth', 'admin']);

// Brands
Route::get("/admin/brand", [BrandController::class, 'index'], ['auth', 'admin']);
Route::get("/admin/brand/create", [BrandController::class, 'create'], ['auth', 'admin']);
Route::post("/admin/brand/create", [BrandController::class, 'store'], ['auth', 'admin']);
Route::get("/admin/brand/{id}/edit", [BrandController::class, 'edit'], ['auth', 'admin']);
Route::put("/admin/brand/{id}/edit", [BrandController::class, 'update'], ['auth', 'admin']);
Route::destroy("/admin/brand/{id}", [BrandController::class, 'delete'], ['auth', 'admin']);
Route::put("/admin/brand/changeStatus/{id}", [BrandController::class, 'changeStatus'], ['auth', 'admin']);
Route::put("/admin/brand/changeStatusIsFeature/{id}", [BrandController::class, 'changeStatusIsFeature'], ['auth', 'admin']);

// Product Catalogue
Route::get("/admin/productCatalogue", [ProductCatalogueController::class, 'index'], ['auth', 'admin']);
Route::get("/admin/productCatalogue/create", [ProductCatalogueController::class, 'create'], ['auth', 'admin']);
Route::post("/admin/productCatalogue/create", [ProductCatalogueController::class, 'store'], ['auth', 'admin']);
Route::get("/admin/productCatalogue/{id}/edit", [ProductCatalogueController::class, 'edit'], ['auth', 'admin']);
Route::put("/admin/productCatalogue/{id}/edit", [ProductCatalogueController::class, 'update'], ['auth', 'admin']);
Route::destroy("/admin/productCatalogue/{id}", [ProductCatalogueController::class, 'delete'], ['auth', 'admin']);
Route::put("/admin/productCatalogue/changeStatus/{id}", [ProductCatalogueController::class, 'changeStatus'], ['auth', 'admin']);
Route::put("/admin/productCatalogue/changeStatusIsFeature/{id}", [ProductCatalogueController::class, 'changeStatusIsFeature'], ['auth', 'admin']);

// Attribute
Route::get("/admin/attribute", [AttributeController::class, 'index'], ['auth', 'admin']);
Route::get("/admin/getAttributeValue/{id}", [AttributeController::class, 'getAttributeValueByIdAttribute'], ['auth', 'admin']);
Route::get("/admin/attribute/create", [AttributeController::class, 'create'], ['auth', 'admin']);
Route::post("/admin/attribute/create", [AttributeController::class, 'store'], ['auth', 'admin']);
Route::get("/admin/attribute/{id}/edit", [AttributeController::class, 'edit'], ['auth', 'admin']);
Route::put("/admin/attribute/{id}/edit", [AttributeController::class, 'update'], ['auth', 'admin']);
Route::destroy("/admin/attribute/{id}", [AttributeController::class, 'delete'], ['auth', 'admin']);

// Attribute value
Route::post("/admin/attribute/value/store", [AttributeController::class, 'storeValue'], ['auth', 'admin']);
Route::get("/admin/attribute/value/{id}/edit", [AttributeController::class, 'editValue'], ['auth', 'admin']);
Route::put("/admin/attribute/value/{id}/edit", [AttributeController::class, 'updateValue'], ['auth', 'admin']);
Route::destroy("/admin/attribute/value/{id}", [AttributeController::class, 'deleteValue'], ['auth', 'admin']);

// Product
Route::get("/admin/product", [ProductController::class, 'index'], ['auth', 'admin']);
Route::get("/admin/product/create", [ProductController::class, 'create'], ['auth', 'admin']);
Route::post("/admin/product/create", [ProductController::class, 'store'], ['auth', 'admin']);
Route::get("/admin/product/{id}/edit", [ProductController::class, 'edit'], ['auth', 'admin']);
Route::put("/admin/product/{id}/edit", [ProductController::class, 'update'], ['auth', 'admin']);



$router->resolve();
