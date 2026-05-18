<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Middleware\ValidUser;
use App\Http\Middleware\AdminAuth;
use App\Http\Middleware\UserAuth;
use App\Http\Middleware\TestMiddleware;
use Psy\VersionUpdater\Installer;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return "Testing Route";
})->middleware(TestMiddleware::class);

// if ($request->hasFile('file')) {
//     $path = $request->file('file')->store('images', 'public');       
//    $product->image = '/storage/' . $path;        this for image but in your form hai image name is file and enctype="multipart/form-data" is mandatory.
// };

Route::view('register', 'registration')->name('register');
Route::post('registration', [UserController::class, 'sendData']);
Route::view('login', 'login')->middleware(ValidUser::class);
Route::post('login', [UserController::class, 'Authentication']);
Route::get('dashbord', [UserController::class, 'dashbord'])->middleware(ValidUser::class);
Route::get('logout', [UserController::class, 'logout']);

// one to one relationship route.
Route::get('list', [UserController::class, 'listAll']);

//one to Many relationship route.
Route::get('listAll', [UserController::class, 'OneToMany']);
Route::get('seller/{id}/products', [UserController::class, 'getsellerProducts']);

// many to one relationship 
Route::get('many-to-one', [UserController::class, 'manyToOne']);
Route::get('product/{id}/seller', [UserController::class, 'getProductsBySeller']);

//many to Many relationship..   
Route::get('many-to-many/{id}', [UserController::class, 'Manytomany']);
Route::post('/user/{id}/assign-roles', [UserController::class, 'assignRolesToUser']);

// Crud Operation.. admin routes 
Route::view('log-in', 'crudoperation.login')->name('AuthLogin');
Route::post('Authentication', [AdminController::class, 'Logincheck']);

// Route::view('form', 'crudoperation.form')->name('Form')->middleware(AdminAuth::class);
Route::get('form', [AdminController::class, 'create'])
    ->name('Form')
    ->middleware(AdminAuth::class);
// Route::get('add-category',[AdminController::class,'create']);

Route::post('add', [AdminController::class, 'addProduct']);
Route::middleware(AdminAuth::class)->group(function () {
    Route::get('listing', [AdminController::class, 'productList'])->name('listing');
    Route::put('updatefield/{id}', [AdminController::class, 'update']);
    Route::get('delete-data/{id}', [AdminController::class, 'deleteData']);
    Route::post('delete-mutiple-records', [AdminController::class, 'multipleRecodsDelete']);
    Route::get('edit-product/{id}', [AdminController::class, 'updateData']);
    Route::get('search-data', [AdminController::class, 'searchData']);
    Route::get('/log-out', [AdminController::class, 'logOut']);
});

//tags create.
Route::get('tags', [AdminController::class, 'index'])->name('tags.index');
Route::post('tag/store', [AdminController::class, 'tagStore'])->name('tagstore');
Route::get('removetags/{id}', [AdminController::class, 'removeTags'])->name('RemoveTags');

//Category Create..
Route::get('category', [AdminController::class, 'createCategory'])->name('viewcategory');
Route::post('category/store', [AdminController::class, 'categoryStore'])->name('CreateCategory');
Route::get('removecat/{id}', [AdminController::class, 'removeCategory'])->name('RemoveCategory');

//user product listing.. 
Route::get('user-login', [UserController::class, 'userLogin'])->name('user.login');
Route::post('user-login', [UserController::class, 'userAuth']);
Route::post('register', [UserController::class, 'registration']);
Route::get('product-listing', [UserController::class, 'userProductList'])->middleware(UserAuth::class)->name('product.listing');
Route::get('detailspro/{id}', [UserController::class, 'productDetails'])->name('detailspro');
Route::get('logout', [UserController::class, 'UserLogout']);
Route::get('search/product', [UserController::class, 'searchProduct'])->name('search.prodcut');

// Cart functionality
Route::post('cart/add/{id}', [CartController::class, 'addCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');    
Route::post('cart/increase/{id}',[CartController::class, 'increseQty'])->name('cart.increase');
Route::post('cart/decrease/{id}',[CartController::class, 'decreaseQty'])->name('cart.decrease');
Route::delete('/cart/remove/{id}',[CartController::class, 'removeCartItem'])->name('cart.remove');

//add mutiple images..
Route::get('multiple/{id}', [UserController::class, 'addMultipleImg'])->name('multiple');
Route::post('multiple/{id}', [UserController::class, 'sendImg'])->name('SendMultipleImg');

Route::get('/checkout', [CheckoutController::class, 'checkOut'])->name('user.checkout');
Route::post('/checkout/placeOrder', [CheckoutController::class, 'placeOrder'])->name('checkout.placeorder');

// payment
Route::post('/razorpay/verify', [CheckoutController::class, 'verifyPayment'])->name('razorpay.verify');
Route::get('razorpay', [CheckoutController::class, 'payment'])->name('razorpay.payment');

Route::get('/thankyou',function () {
    return view('thankyou');
})->name('thankyou');

// change color white image
Route::get('/get-images-by-color/{itemId}/{color}', [UserController::class, 'getImagesByColor']);
