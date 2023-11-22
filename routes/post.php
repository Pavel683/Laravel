<?php

Route::get('/create', 'App\Http\Controllers\PostsController@create')->name('create');
Route::get('/delete', 'App\Http\Controllers\PostsController@delete')->name('delete');
