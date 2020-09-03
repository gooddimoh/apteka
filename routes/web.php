<?php
Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.pharmacy.index')->with('status', session('status'));
    }
    return redirect()->route('admin.pharmacy.index');
});

Auth::routes();
// Admin

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

    // Statuses
    Route::delete('statuses/destroy', 'StatusesController@massDestroy')->name('statuses.massDestroy');
    Route::resource('statuses', 'StatusesController');

    // Loan Applications
    Route::delete('pharmacy/destroy', 'PharmacyController@massDestroy')->name('pharmacy.massDestroy');
    Route::get('pharmacy/{loan_application}/analyze', 'PharmacyController@showAnalyze')->name('pharmacy.showAnalyze');
    Route::post('pharmacy/{loan_application}/analyze', 'PharmacyController@analyze')->name('pharmacy.analyze');
    Route::get('pharmacy/{loan_application}/send', 'PharmacyController@showSend')->name('pharmacy.showSend');
    Route::post('pharmacy/{loan_application}/send', 'PharmacyController@send')->name('pharmacy.send');
    Route::resource('pharmacy', 'PharmacyController');

    // Comments
    Route::delete('comments/destroy', 'CommentsController@massDestroy')->name('comments.massDestroy');
    Route::resource('comments', 'CommentsController');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
// Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
    }
});
