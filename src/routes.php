<?php

//Event
Route::group(['prefix' => config('clara.lang.route.web.prefix'), 'middleware' => config('clara.lang.route.web.middleware')], function()
{
    Route::get('language', config('clara.lang.controller'), ['names' => 'admin.lang.index']);
    Route::post('language', config('clara.lang.controller'), ['names' => 'admin.lang.store']);
});
