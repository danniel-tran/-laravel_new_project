<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => config('zvn.route.prefix_admin')], function () {
    // ===================================DASHBOARD========================================
    $prefix_slider = "dashboard";
    $controllerName = "dashboard";
    Route::group(
        ['prefix' => $prefix_slider],
        function () use ($controllerName) {
            $controller = ucfirst($controllerName) . 'Controller@';
            Route::get('/', $controller . "index")->name("$controllerName");
            Route::get('/edit/{id}', $controller . "edit")->where('id', '[0-9]+')->name("$controllerName/edit");
            Route::get('/delete/{id}', $controller . "delete")->where('id', '[0-9]+')->name("$controllerName/delete");
        }
    );

    // ===================================SLIDER========================================
    $prefix_slider = "slider";
    $controllerName = "slider";
    Route::group(
        ['prefix' => $prefix_slider],
        function () use ($controllerName) {
            $controller = ucfirst($controllerName) . 'Controller@';
            Route::get('/', $controller . "index")->name("$controllerName");
            Route::get('/edit/{id}', $controller . "edit")->where('id', '[0-9]+')->name("$controllerName/edit");
            Route::get('/form/{id?}', $controller . 'form')->name($controllerName . '/form');
            Route::get('/delete/{id}', $controller . "delete")->where('id', '[0-9]+')->name("$controllerName/delete");
            Route::get('/change-status-{status}/{id}', $controller . "status")->where('id', '[0-9]+')->name("$controllerName/status");
        }
    );
});
