<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeoController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CrawlController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProxyController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\NotificationController;

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

Route::get('/', [SeoController::class, 'index'])->name('home_index');
Route::get('/bai-viet', [SeoController::class, 'blog'])->name('blog');
Route::get('/bai-viet/{slug}', [SeoController::class, 'show'])->name('seo.posts.show');
Route::get('/lien-he', [SeoController::class, 'lien_he'])->name('lien_he');
Route::post('/submit_lien_he', [SeoController::class, 'submit_lien_he'])->name('submit_lien_he');

Auth::routes(['verify' => true]);


Route::middleware(['auth', 'verified'])->group(function () {
    

    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/my/orders', [App\Http\Controllers\HomeController::class, 'my_orders'])->name('my_orders');
    Route::get('/orders/export', [App\Http\Controllers\HomeController::class, 'export'])->name('orders.export');
    Route::get('/orders/xoay/{id}', [App\Http\Controllers\HomeController::class, 'xoay'])->name('xoay');
    Route::post('/update/xoay/{id}', [App\Http\Controllers\HomeController::class, 'update'])->name('update.proxy');

    Route::get('/dich-vu/{proxy_type}', [ProxyController::class, 'show'])->name('proxy.show');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::post('/extend/run/{id}', [ProxyController::class, 'extend'])->name('extend.run');

    Route::get('/user/payment', [UserController::class, 'payment'])->name('user.payment');
    Route::get('/user/token', [UserController::class, 'showToken'])->name('user.token');
    Route::post('/user/token/regenerate', [UserController::class, 'regenerateToken'])->name('user.token.regenerate');

    Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');
    Route::get('/my/transactions', [TransactionController::class, 'index_my'])->name('my.transactions.index');
    Route::get('/transactions', [BankController::class, 'index'])->name('my.trans.index');
    Route::post('/vietqr/generate', [BankController::class, 'generate']);


    Route::get('/admin/users', [UserController::class, 'index'])->name('users.index')->middleware('checkrole:1');
    Route::post('/admin/users/update/{id}', [UserController::class, 'update'])->name('users.update')->middleware('checkrole:1');
    Route::post('/admin/users/updateMoney/{id}', [UserController::class, 'updateMoney'])->name('users.updateMoney')->middleware('checkrole:1');
    Route::post('/admin/users/change-password/{id}', [UserController::class, 'changePassword'])->name('users.changePassword')->middleware('checkrole:1');

    Route::prefix('admin')->group(function () {
        Route::get('/crawl', [CrawlController::class, 'index'])->name('crawl.index');
        Route::post('/crawl', [CrawlController::class, 'crawl'])->name('crawl.submit');

        Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
        Route::post('orders/{id}', [OrderController::class, 'update'])->name('orders.update');

        Route::get('transactions', [TransactionController::class, 'index'])->name('transactions.index');
        Route::post('transactions/{id}', [TransactionController::class, 'update'])->name('transactions.update');

        Route::get('/configs', [ConfigController::class, 'index'])->name('configs.index');
        Route::post('/configs/update', [ConfigController::class, 'update'])->name('configs.update');
        Route::post('/configs/update_note', [ConfigController::class, 'update_note'])->name('configs.update_note');
        Route::post('/configs/update_web', [ConfigController::class, 'update_web'])->name('configs.update_web');

        Route::get('/list-api', [ProxyController::class, 'api_index'])->name('api.index');
        Route::post('/api/update/{id}', [ProxyController::class, 'api_update'])->name('api.update');
        Route::post('/api/run/{id}', [ProxyController::class, 'api_run'])->name('api.run');

        Route::get('/proxy', [ProxyController::class, 'index'])->name('proxy.index');
        Route::post('/proxy/create', [ProxyController::class, 'create'])->name('proxy.create');
        Route::post('/proxy/update/{id}', [ProxyController::class, 'update'])->name('proxy.update');

        Route::resource('posts', PostController::class);
        Route::resource('notifications', NotificationController::class);

    })->middleware('checkrole:1');
});
