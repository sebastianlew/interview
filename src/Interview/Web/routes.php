<?php

Route::name('products.')->group(function() {
    Route::get('/products', 'ProductController@index')->name('list');
    Route::get('/products/add', 'ProductController@create')->name('create');
    Route::get('/products/edit/{id}', 'ProductController@edit')->name('edit');
});