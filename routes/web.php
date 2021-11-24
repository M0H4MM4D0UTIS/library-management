<?php

//use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Buki\AutoRoute\AutoRouteFacade as Route;
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
    return view('index');
});
Route::get('/dashboard', function () {
    return redirect('/home');
})->name('dashboard');
/*
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');*/

require __DIR__.'/auth.php';

//Auth::routes();
/*
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware(['auth'])->name('home');
Route::get('/home/profile', [App\Http\Controllers\HomeController::class, 'profile'])->middleware(['auth'])->name('profile');
*/

#document: https://github.com/izniburak/laravel-auto-routes
/*
Route::auto('/home', App\Http\Controllers\HomeController::class, [
    'name' => 'home',
    'middleware' => 'auth'
]);*/


Route::group(['prefix' => 'home', 'middleware' => 'auth'], function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('home.profile');
    Route::get('users', [App\Http\Controllers\HomeController::class, 'users'])->name('home.users');
    Route::get('categories', [App\Http\Controllers\HomeController::class, 'categories'])->name('home.categories');
    Route::get('members', [App\Http\Controllers\HomeController::class, 'members'])->name('home.members');
    Route::any('edituserprofile/{id}', [App\Http\Controllers\HomeController::class, 'edituserprofile'])->name('home.edituserprofile');
    Route::any('addnewuser', [App\Http\Controllers\HomeController::class, 'addnewuser'])->name('home.addnewuser');
    Route::any('addoreditcategory/{id?}', [App\Http\Controllers\HomeController::class, 'addoreditcategory'])->name('home.addoreditcategory');
    Route::any('addoreditmember/{id?}', [App\Http\Controllers\HomeController::class, 'addoreditmember'])->name('home.addoreditmember');
    Route::delete('deleteuser/{id}', [App\Http\Controllers\HomeController::class, 'deleteuser'])->name('home.deleteuser');
    Route::delete('deletemember/{id}', [App\Http\Controllers\HomeController::class, 'deletemember'])->name('home.deletemember');
    Route::delete('deletecategory/{id}', [App\Http\Controllers\HomeController::class, 'deletecategory'])->name('home.deletecategory');
    Route::patch('editprofile', [App\Http\Controllers\HomeController::class, 'editprofile'])->name('home.editprofile');
    Route::get('books', [App\Http\Controllers\HomeController::class, 'books'])->name('home.books');
    Route::any('addoreditbook/{id?}', [App\Http\Controllers\HomeController::class, 'addoreditbook'])->name('home.addoreditbook');
    Route::delete('deletebook/{id}', [App\Http\Controllers\HomeController::class, 'deletebook'])->name('home.deletebook');
    Route::any('ammanatketabjadid', [App\Http\Controllers\HomeController::class, 'ammanatketabjadid'])->name('home.ammanatketabjadid');
    Route::any('ammanatdade', [App\Http\Controllers\HomeController::class, 'ammanatdade'])->name('home.ammanatdade');
    Route::get('notifications', [App\Http\Controllers\HomeController::class, 'notifications'])->name('home.notifications');

    Route::delete('deletelended', [App\Http\Controllers\HomeController::class, 'deletelended'])->name('home.deletelended');
    Route::get('lendedchangestatus/{id}', [App\Http\Controllers\HomeController::class, 'lendedchangestatus'])->name('home.lendedchangestatus');
    Route::any('api', [App\Http\Controllers\HomeApi::class, 'index'])->name('home.api');
    Route::post('api/autocomplete/membername', [App\Http\Controllers\HomeApi::class, 'autocomplete_member_name'])->name('home.api.autocomplete.membername');
    Route::post('api/autocomplete/bookname', [App\Http\Controllers\HomeApi::class, 'autocomplete_book_name'])->name('home.api.autocomplete.bookname');

});



Auth::routes([
    'register' => false, // Disable Register Rout
    'reset' => true, // Disable Reset Password Route
    'verify' => false, // Disable Email Verification Route
]);

Route::view('/ui', 'ui.index');

