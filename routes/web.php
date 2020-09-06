<?php


Auth::routes(["auth", true]);

Route::redirect('/', '/login');

Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.loan-applications.index')->with('status', session('status'));
    }

    return redirect()->route('admin.loan-applications.index');
});



Route::get('permissions/index', 'PermissionsController@index')->name('index');
Route::get('permissions/create', 'PermissionsController@create')->name('create');
Route::get('permissions/store', 'PermissionsController@store')->name('store');
Route::get('permissions/edit', 'PermissionsController@edit')->name('edit');
Route::get('permissions/update', 'PermissionsController@update')->name('update');
Route::get('permissions/show', 'PermissionsController@show')->name('show');
Route::get('permissions/destroy', 'PermissionsController@destroy')->name('destroy');
Route::get('permissions/massDestroy', 'PermissionsController@massDestroy')->name('massDestroy');


Route::get('/admin/index', 'PharmacyController@index')->name('index');



Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');

    Route::get('/admin/index', 'PharmacyController@index')->name('index');

    Route::get('permissions/index', 'PermissionsController@index')->name('index');
    Route::get('permissions/create', 'PermissionsController@create')->name('create');
    Route::get('permissions/store', 'PermissionsController@store')->name('store');
    Route::get('permissions/edit', 'PermissionsController@edit')->name('edit');
    Route::get('permissions/update', 'PermissionsController@update')->name('update');
    Route::get('permissions/show', 'PermissionsController@show')->name('show');
    Route::get('permissions/destroy', 'PermissionsController@destroy')->name('destroy');
    Route::get('permissions/massDestroy', 'PermissionsController@massDestroy')->name('massDestroy');

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
    Route::delete('loan-applications/destroy', 'LoanApplicationsController@massDestroy')->name('loan-applications.massDestroy');
    Route::get('loan-applications/{loan_application}/analyze', 'LoanApplicationsController@showAnalyze')->name('loan-applications.showAnalyze');
    Route::post('loan-applications/{loan_application}/analyze', 'LoanApplicationsController@analyze')->name('loan-applications.analyze');
    Route::get('loan-applications/{loan_application}/send', 'LoanApplicationsController@showSend')->name('loan-applications.showSend');
    Route::post('loan-applications/{loan_application}/send', 'LoanApplicationsController@send')->name('loan-applications.send');
    Route::resource('loan-applications', 'LoanApplicationsController');

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

