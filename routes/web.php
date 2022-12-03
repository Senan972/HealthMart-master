<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Frontend\LanguageController;

use App\Http\Controllers\Frontend\IndexController;
use App\Models\User;

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
Route::group(['prefix'=> 'admin', 'middleware'=>['admin:admin']], function(){
	Route::get('/login', [AdminController::class, 'loginForm']);
	Route::post('/login',[AdminController::class, 'store'])->name('admin.login');
});

//restricted urls
Route::middleware(['auth:admin']) -> group(function(){

Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
    return view('admin.index');
})->name('dashboard') -> middleware('auth:admin');

//Routes for Admin
Route::get('/admin/logout', [AdminController::class, 'destroy']) -> name('admin.logout');
Route::get('/admin/profile', [AdminProfileController::class, 'AdminProfile']) -> name('admin.profile');
Route::get('/admin/profile/edit', [AdminProfileController::class, 'AdminProfileEdit']) -> name('admin.profile.edit');
Route::post('/admin/profile/store', [AdminProfileController::class, 'AdminProfileStore']) -> name('admin.profile.store');

Route::get('/admin/change/password', [AdminProfileController::class, 'AdminChangePassword']) -> name('admin.change.password');
Route::post('/update/change/password', [AdminProfileController::class, 'AdminUpdateChangePassword']) -> name('update.change.password');

});


//Routes for User
Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
    $id = Auth::user() -> id;
    $user = User::find($id);
    return view('dashboard', compact('user'));
})->name('dashboard');
Route::get('/', [IndexController::class, 'index']);
Route::get('/user/logout', [IndexController::class, 'UserLogout']) -> name('user.logout');
Route::get('/user/profile', [IndexController::class, 'UserProfile']) -> name('user.profile');
Route::post('/user/profile/store', [IndexController::class, 'UserProfileStore']) -> name('user.profile.store');
Route::get('/change/password', [IndexController::class, 'ChangePassword']) -> name('change.password');
Route::post('/user/password/update', [IndexController::class, 'UserPasswordUpdate']) -> name('user.password.update');



//Routes for Brand
Route::prefix('brand') -> group(function() {
Route::get('/view', [BrandController::class, 'BrandView']) -> name('all.brand');
Route::post('/store', [BrandController::class, 'BrandStore']) -> name('brand.store');
Route::get('/edit/{id}', [BrandController::class, 'BrandEdit']) -> name('brand.edit');
Route::post('/update', [BrandController::class, 'BrandUpdate']) -> name('brand.update');
Route::get('/delete/{id}', [BrandController::class, 'BrandDelete']) -> name('brand.delete');

});
//Routes for Categories
Route::prefix('category') -> group(function() {
Route::get('/view', [CategoryController::class, 'CategoryView']) -> name('all.category');
Route::post('/store', [CategoryController::class, 'CategoryStore']) -> name('category.store');
Route::get('/edit/{id}', [CategoryController::class, 'CategoryEdit']) -> name('category.edit');
Route::post('/update/{id}', [CategoryController::class, 'CategoryUpdate']) -> name('category.update');
Route::get('/delete/{id}', [CategoryController::class, 'CategoryDelete']) -> name('category.delete');

//Subcategories for Admin
Route::get('/sub/view', [SubCategoryController::class, 'SubCategoryView']) -> name('all.subcategory');
Route::post('/sub/store', [SubCategoryController::class, 'SubCategoryStore']) -> name('subcategory.store');
Route::get('/sub/edit/{id}', [SubCategoryController::class, 'SubCategoryEdit']) -> name('subcategory.edit');
Route::post('/sub/update', [SubCategoryController::class, 'SubCategoryUpdate']) -> name('subcategory.update');
Route::get('/sub/delete/{id}', [SubCategoryController::class, 'SubCategoryDelete']) -> name('subcategory.delete');

//Child categories for Admin
Route::get('/sub/child/view', [SubCategoryController::class, 'ChildCategoryView']) -> name('all.childcategory');
Route::get('/subcategory/ajax/{category_id}', [SubCategoryController::class, 'GetSubCategory']);
Route::get('/childcategory/ajax/{subcategory_id}', [SubCategoryController::class, 'GetChildCategory']);
Route::post('/sub/child/store', [SubCategoryController::class, 'ChildCategoryStore']) -> name('childcategory.store');
Route::get('/sub/child/edit/{id}', [SubCategoryController::class, 'ChildCategoryEdit']) -> name('childcategory.edit');
Route::post('/sub/child/update', [SubCategoryController::class, 'ChildCategoryUpdate']) -> name('childcategory.update');
Route::get('/sub/child/delete/{id}', [SubCategoryController::class, 'ChildCategoryDelete']) -> name('childcategory.delete');

});

//Routes for Products
Route::prefix('product') -> group(function() {
Route::get('/add', [ProductController::class, 'AddProduct']) -> name('add-product');
Route::post('/store', [ProductController::class, 'StoreProduct']) -> name('product-store');
Route::get('/manage', [ProductController::class, 'ManageProduct']) -> name('manage-product');
Route::get('/edit/{id}', [ProductController::class, 'EditProduct']) -> name('product.edit');

Route::post('/data/update', [ProductController::class, 'ProductDataUpdate']) -> name('product-update');
Route::post('/image/update', [ProductController::class, 'MultiImageUpdate']) -> name('update-product-image');
Route::post('/thumbnail/update', [ProductController::class, 'ThumbnailImageUpdate']) -> name('update-product-thumbnail');

Route::get('/multiimg/delete/{id}', [ProductController::class, 'MultiImageDelete']) -> name('product.multiimg.delete');
Route::get('/inactive/{id}', [ProductController::class, 'ProductInactive']) -> name('product.inactive');
Route::get('/active/{id}', [ProductController::class, 'ProductActive']) -> name('product.active');
Route::get('/delete/{id}', [ProductController::class, 'ProductDelete']) -> name('product.delete');

});

//Routes for slider
Route::prefix('slider') -> group(function() {
Route::get('/view', [SliderController::class, 'SliderView']) -> name('manage-slider');
Route::post('/store', [SliderController::class, 'SliderStore']) -> name('slider.store');
Route::get('/edit/{id}', [SliderController::class, 'SliderEdit']) -> name('slider.edit');
Route::post('/update', [SliderController::class, 'SliderUpdate']) -> name('slider.update');
Route::get('/delete/{id}', [SliderController::class, 'SliderDelete']) -> name('slider.delete');
Route::get('/inactive/{id}', [SliderController::class, 'SliderInactive']) -> name('slider.inactive');
Route::get('/active/{id}', [SliderController::class, 'SliderActive']) -> name('slider.active');
});

//multi language
Route::get('/language/urdu', [LanguageController::class, 'Urdu'])->name('urdu.language');
Route::get('/language/english', [LanguageController::class, 'English'])->name('english.language');

//product detals page url
Route::get('/product/details/{id}/{slug}', [IndexController::class, 'ProductDetails']);
//product tags page url
Route::get('/product/tag/{tag}', [IndexController::class, 'TagWiseProduct']);