<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Member;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


Route::prefix('/member')->group(function () {
    Route::get('/', [Member::class, 'index'])->name('member.index');
    Route::match(['get', 'post'], '/list', [Member::class, 'list'])->name('member.list');
    Route::post('/search', [Member::class, 'search'])->name('member.search');
});