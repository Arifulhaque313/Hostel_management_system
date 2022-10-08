<?php

use App\Http\Controllers\Frontend\HostelController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\ShopController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\NewsletterController;
use App\Models\Hostel;

;


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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session')
])->group(function () {
    Route::get('/dashboard', function () {
        $hostels = Hostel::get();
        return Inertia::render('Frontend/Home',['hostels'=>$hostels]);
    })->name('dashboard');
});

//auth registration 
Route::post('/auth/register',[AuthController::class,'store'])->name('auth.registration');

Route::get('/',[HomeController::class, 'index']);

// About
Route::get('/about', function () {
    return Inertia::render('Frontend/About');
});

// Contact
Route::get('/contact', function () {
    return Inertia::render('Frontend/Contact');
})->name('contact');

Route::post('/contactstore/store',[ContactController::class,'store'])->name('contact.store');



// Blog
Route::get('/blog',[BlogController::class,'index'])->name('blog');
Route::get('/blog/show/{slug}',[BlogController::class,'show'])->name('blog.show');



// Policy
Route::get('/policies', function () {
    return Inertia::render('Frontend/Policy');
});

// Shop menu
Route::get('/shop',[ShopController::class,'index'])->name('products.index');
Route::get('/shop/show/{slug}',[ShopController::class,'show'])->name('products.show');

Route::get('/user/profile', [ProfileController::class,'index'])->name('user.profile');
Route::put('/user/{user}/profile/', [ProfileController::class,'update'])->name('user.profile.update');

// news letter
Route::post('/news-store',[NewsletterController::class, 'store'])->name('newsletter.store');

// hostel controller 
Route::resource('hostels', HostelController::class);









