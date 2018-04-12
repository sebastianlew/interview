<?php
/**
 * Created by Sebastian Lewandowski<sebasolew@gmail.com>.
 * Date: 12.04.2018
 */

Route::get('/products', 'ProductController@index');
Route::get('/products/{id}', 'ProductController@show');