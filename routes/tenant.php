<?php

Route::get('/company/store', 'Tenant\CompanyController@store');

Route::get('/', function () {
    return 'Tenant';
});