<?php

//Language
Route::group(['prefix' => config('clara.lang.route.web.prefix'), 'middleware' => config('clara.lang.route.web.middleware')], function()
{
    Route::get('language', config('clara.lang.controller').'@index')->name('admin.lang.index');
    Route::post('language', config('clara.lang.controller').'@store')->name('admin.lang.store');
});
