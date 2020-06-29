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

Route::view('/', 'welcome')->name('welcome');

Auth::routes();

Route::group([
    'as' => 'admin.',
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'middleware' => ['auth', 'admin']
], function () {
	Route::view('/', 'admin.dashboard')->name('dashboard');
	Route::resources([
	    'categories' => 'CategoryController',
	    'posts' => 'PostController',
	    'users' => 'UserController'
	], ['except' => ['create', 'show', 'edit']]);
	Route::get('/data-importer', 'DataImporterController@index')->name('data-importer.index');
	Route::post('/data-importer', 'DataImporterController@import')->name('data-importer.import');
	Route::get('/data-importer/run-queue-worker', 'DataImporterController@runQueueWorker')->name('data-importer.run-queue-worker');
});