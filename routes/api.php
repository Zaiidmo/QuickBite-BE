<?php


use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::get('resetPassword', 'resetPassword')->name('password.reset');
    Route::post('forgot', 'forgotPassword')->name('password.forgot');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});

// Route::post('/changeRole/{user}', 'UserController@changeRole');

Route::controller(UserController::class)->group(function () {
    Route::post('changeRole', 'changeRole');
});
// Route::group(['prefix' => 'restaurants'], function () {
//     Route::post('/', 'RestaurantController@store')->name('restaurants.store');
//     Route::put('/{id}', 'RestaurantController@update')->name('restaurants.update');
//     Route::delete('/{id}', 'RestaurantController@delete')->name('restaurants.delete');
//     Route::get('/{id}', 'RestaurantController@show')->name('restaurants.show');
// });
Route::resource('restaurants', RestaurantController::class);