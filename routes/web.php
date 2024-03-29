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

Route::get('/welcome', function () {
    return view('welcome');
});

Route::group(['prefix' => config('zvn.route.prefix_admin'), 'namespace' => 'Admin', 'middleware' => ['permission.admin']], function () {
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
            Route::post('/save', $controller . 'save')->name($controllerName . '/save');
            Route::get('/delete/{id}', $controller . "delete")->where('id', '[0-9]+')->name("$controllerName/delete");
            Route::get('/change-status-{status}/{id}', $controller . "status")->where('id', '[0-9]+')->name("$controllerName/status");
        }
    );

    // ===================================CATEGORY========================================
    $prefix_slider = "category";
    $controllerName = "category";
    Route::group(
        ['prefix' => $prefix_slider],
        function () use ($controllerName) {
            $controller = ucfirst($controllerName) . 'Controller@';
            Route::get('/', $controller . "index")->name("$controllerName");
            Route::get('/edit/{id}', $controller . "edit")->where('id', '[0-9]+')->name("$controllerName/edit");
            Route::get('/form/{id?}', $controller . 'form')->name($controllerName . '/form');
            Route::post('/save', $controller . 'save')->name($controllerName . '/save');
            Route::get('/delete/{id}', $controller . "delete")->where('id', '[0-9]+')->name("$controllerName/delete");
            Route::get('/change-status-{status}/{id}', $controller . "status")->where('id', '[0-9]+')->name("$controllerName/status");
            Route::get('/change-is-home-{is_home}/{id}', $controller . "isHome")->where('id', '[0-9]+')->name("$controllerName/isHome");
            Route::get('/change-display-{display}/{id}', $controller . 'display')->name("$controllerName/display");
        }
    );

    // ===================================ARTICLE========================================
    $prefix_slider = "article";
    $controllerName = "article";
    Route::group(
        ['prefix' => $prefix_slider],
        function () use ($controllerName) {
            $controller = ucfirst($controllerName) . 'Controller@';
            Route::get('/', $controller . "index")->name("$controllerName");
            Route::get('/edit/{id}', $controller . "edit")->where('id', '[0-9]+')->name("$controllerName/edit");
            Route::get('/form/{id?}', $controller . 'form')->name($controllerName . '/form');
            Route::post('/save', $controller . 'save')->name($controllerName . '/save');
            Route::get('/delete/{id}', $controller . "delete")->where('id', '[0-9]+')->name("$controllerName/delete");
            Route::get('/change-status-{status}/{id}', $controller . "status")->where('id', '[0-9]+')->name("$controllerName/status");
            Route::get('/change-type-{type}/{id}', $controller . "type")->name("$controllerName/type");
        }
    );
    // ============================== USER ==============================
    $prefix         = 'user';
    $controllerName = 'user';
    Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';
        Route::get('/', $controller . "index")->name("$controllerName");
        Route::get('/form/{id?}', $controller . 'form')->where('id', '[0-9]+')->name($controllerName . '/form');
        Route::post('/save', $controller . 'save')->name($controllerName . '/save');
        Route::get('/change-status-{status}/{id}', $controller . "status")->where('id', '[0-9]+')->name("$controllerName/status")->where('id', '[0-9]+');
        Route::get('/change-level-{level}/{id}', $controller . "level")->where('id', '[0-9]+')->name("$controllerName/level")->where('id', '[0-9]+');
        Route::post('change-password', $controller . 'changePassword')->name($controllerName . '/change-password');
        Route::post('change-level', $controller . 'changeLevel')->name($controllerName . '/change-level');
        Route::post('/delete/{id}', $controller . 'delete')->name($controllerName . '/delete')->where('id', '[0-9]+');
    });
});

Route::group(['prefix' => config('zvn.route.prefix_news'), 'namespace' => 'News'], function () {
    // ===================================NEWS========================================
    $prefix_news = "";
    $controllerName = "home";
    Route::group(
        ['prefix' => $prefix_news],
        function () use ($controllerName) {
            $controller = ucfirst($controllerName) . 'Controller@';
            Route::get('/', $controller . "index")->name("$controllerName");
        }
    );
    // ============================== CATEGORY ==============================
    $prefix         = 'chuyen-muc';
    $controllerName = 'category';
    Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';
        Route::get('/{category_name}-{category_id}.html', $controller . 'index')->name($controllerName . '/index')
            ->where('category_name', '[0-9a-zA-Z_-]+')
            ->where('category_id', '[0-9]+');
    });
    // ====================== ARTICLE ========================
    $prefix         = 'bai-viet';
    $controllerName = 'article';
    Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';
        Route::get('/{article_name}-{article_id}.html', $controller . 'index')->name($controllerName . '/index')
            ->where('article_name', '[0-9a-zA-Z_-]+')
            ->where('article_id', '[0-9]+');
    });

    // ============================== NOTIFY ==============================
    $prefix         = '';
    $controllerName = 'notify';
    Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';
        Route::get('/no-permission', $controller . 'noPermission')->name($controllerName . '/noPermission');
    });

    // ====================== LOGIN ========================
    $prefix         = '';
    $controllerName = 'auth';

    Route::group(['prefix' =>  $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName)  . 'Controller@';
        Route::get('/login', $controller . 'login')->name($controllerName . '/login')->middleware('check.login');
        Route::post('/postLogin', $controller . 'postLogin')->name($controllerName . '/postLogin');

        // ====================== LOGOUT ========================
        Route::get('/logout', $controller . 'logout')->name($controllerName . '/logout');
    });
});
