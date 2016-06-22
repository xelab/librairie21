<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => 'web'], function () {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::resource('book', 'BooksController');
    Route::resource('collection', 'CollectionsController');
    Route::resource('distributor', 'DistributorsController');
    Route::resource('publisher', 'PublishersController');
    Route::resource('author', 'AuthorsController');
    Route::get('/books-data', ['as' => 'datatables.data', 'uses' => 'BooksController@anyData']);
    Route::post('/books-scraping', ['as' => 'books.scraping', 'uses' => 'BooksController@scraping']);
    Route::get('/publisher-collections/{publisher?}', ['as' => 'publisher.collections', 'uses' => 'PublishersController@getCollections']);
});