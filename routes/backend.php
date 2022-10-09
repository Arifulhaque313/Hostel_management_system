<?php

use App\Http\Controllers\Backend\BlogCategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\BookHostelController;
use App\Http\Controllers\Backend\InboxController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\NewsletterController;
use App\Http\Controllers\Backend\HostelController;
use App\Http\Controllers\Backend\ProfileController;
use App\Models\BookHostel;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

Route::get('/dashboard', function () {

    if ( Auth::user()->email_verified_at === null ){
        return redirect()->route('verification.notice');
    }
            
    return Inertia::render('Backend/Dashboard');
})->name('dashboard');


//----Blog Route----//
Route::resource('blogs', BlogController::class);
Route::resource('blog-categories', BlogCategoryController::class);

//----User Route----//
Route::resource('users', UserController::class);

// //----Role Route----//
Route::resource('roles', RoleController::class);

//User Profile
Route::get('/user/{user}/profile', [ProfileController::class,'index'])->name('profile.show');
Route::put('/user/{user}', [ProfileController::class,'update'])->name('profile.update');


//Inbox Route
Route::get('/inbox', [InboxController::class,'index'])->name('inbox');
Route::get('/inbox/{contact}/show', [InboxController::class,'show'])->name('inbox.show');
Route::delete('/inbox/{contact}/delete', [InboxController::class,'destroy'])->name('inbox.destroy');

// newsletter 
Route::get('/newsletter',[NewsletterController::class, 'index'])->name('newsletter.index');
Route::delete('/newsletter/{id}/destroy',[NewsletterController::class, 'destroy'])->name('newsletter.destroy');

//Hostel 
Route::resource('hostels', HostelController::class);
//booking
Route::resource('bookings', BookHostelController::class);









