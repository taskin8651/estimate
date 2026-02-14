<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);
    // Clients
    Route::resource('clients', \App\Http\Controllers\Admin\ClientController::class);
    // Estimates
   Route::resource('estimates', \App\Http\Controllers\Admin\EstimateController::class);

   Route::get('estimates/{estimate}/send',
    [\App\Http\Controllers\Admin\EstimateController::class, 'sendEstimate']
)->name('estimates.send');

Route::get('settings', [\App\Http\Controllers\Admin\SettingController::class, 'index'])
    ->name('settings.index');

Route::post('settings', [\App\Http\Controllers\Admin\SettingController::class, 'update'])
    ->name('settings.update');

    Route::get('estimates/{estimate}/pdf',
    [\App\Http\Controllers\Admin\EstimateController::class, 'downloadPdf']
)->name('estimates.pdf');

Route::post('estimates/{estimate}/template',
    [\App\Http\Controllers\Admin\EstimateController::class, 'changeTemplate']
)->name('estimates.changeTemplate');



});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});


