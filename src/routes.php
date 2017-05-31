<?php

Route::group([
    'as' => 'catalog::',
    'prefix' => 'catalog',
    'namespace' => 'WTG\Catalog\Controllers',
    'middleware' => ['web']
], function () {
    Route::get('product/{sku}', 'ProductController@view')->name('product');

    Route::group([
        'as' => 'assortment.',
        'prefix' => 'assortment'
    ], function () {
        Route::get('/', 'AssortmentController@view')->name('index');
        Route::get('specials', 'SpecialsController@view')->name('specials');
    });
});