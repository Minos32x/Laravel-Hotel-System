<?php


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', 'HomeController@country');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/users/logout', 'Auth\LoginController@userLogout')->name('users.logout');

// Temporary Routes To Test Mailing System
Route::get('/sendgreeting/{id}', 'MailsController@GreetingMail')->name('Mails.GreetingMail');
Route::get('/sendreminder/{id}', 'MailsController@ReminderMail')->name('Mails.ReminderMail');


Route::get('/admin', function () {
    return view('Admin.admin_template');
})->name('admin')->middleware('auth:employee');
Route::get('/admin/index', function () {
    return view('Admin.index');
});
Route::get('/admin/index2', function () {
    return view('Admin.index2');
});


Route::prefix('employee')->group(function () {

    Route::get('/login', 'Auth\EmployeeLoginController@showLoginForm')->name('employee.login');

    Route::post('/login', 'Auth\EmployeeLoginController@login')->name('employee.login.submit');
    Route::get('/', 'EmployeeController@index')->name('employee.dashboard')->middleware('guest:web');

    Route::post('/login', 'Auth\EmployeeLoginController@login')->middleware('forbid-banned-user')->name('employee.login.submit');
    Route::get('/', 'EmployeeController@index')->middleware('forbid-banned-user')->name('employee.dashboard');

    Route::get('/logout', 'Auth\EmployeeLoginController@logout')->name('employee.logout');

});


Route::get('/managers', 'ManagersController@index');
Route::get('/managers/create', 'ManagersController@create');
Route::post('/managers', 'ManagersController@store');
Route::get('/employees/{id}/edit', 'ManagersController@edit');
Route::PUT('/employees/{id}/update', 'ManagersController@update');
Route::DELETE('/employees/{id}', 'ManagersController@destroy');
Route::get('/receptionists/create', 'ReceptionistController@create');
Route::post('/receptionists', 'ReceptionistController@store');


Route::get('/receptionists', 'ReceptionistController@index');
Route::get('/clients/mine', 'ClientsController@myClients');
Route::get('/clients', 'ClientsController@index');
Route::get('/clients/{id}/edit', 'ClientsController@edit');
Route::PUT('/clients/{id}/update', 'ClientsController@update');
Route::DELETE('/clients/{id}', 'ClientsController@destroy');


Route::get('/rooms', 'RoomsController@index');
Route::get('/rooms/create', 'RoomsController@create');
Route::post('/rooms', 'RoomsController@store');
Route::get('/rooms/{id}/edit', 'RoomsController@edit');
Route::PUT('/rooms/{id}/update', 'RoomsController@update');
Route::delete('/rooms/{id}', 'RoomsController@destroy');


Route::get('/floors', 'FloorsController@index');
Route::get('/floors/create', 'FloorsController@create');
Route::post('/floors', 'FloorsController@store');
Route::get('/floors/{id}/edit', 'FloorsController@edit');
Route::PUT('/floors/{id}/update', 'FloorsController@update');
Route::DELETE('/floors/{id}', 'FloorsController@destroy');


Route::get('/admin/getManagers', 'ManagersController@index');
Route::get('/admin/getReceptionist', 'ReceptionistController@index');
Route::get('/admin/getClient', 'ClientsController@index');
Route::get('/reservations', 'ReservationsController@index')->name('manager.reservation');


Route::prefix('employee/blocking')->group(function () {

    Route::get('/ban/{id}', 'EmployeeController@EmployeeBan')->name('employee.ban');
    Route::get('unban/{id}', 'EmployeeController@Employeeunban')->name('employee.unban');
});

Route::prefix('client')->group(function () {
    Route::get('/', 'ClientsViewsController@index')->name('client.index');
    Route::get('/profile', 'ClientsViewsController@profile')->name('client.profile');
    Route::get('/reservations', 'ClientsViewsController@showRooms')->name('client.reservation');
    Route::get('/reservations/{id}/room', 'ClientsViewsController@create')->name('client.create');
    Route::post('/reservations/{id}/room', 'ClientsViewsController@showPayment')->name('client.show_payment');
    Route::post('/payment/{id}/room', 'ClientsViewsController@confirm')->name('client.confirm');
    Route::get('/show', 'ClientsViewsController@showReserved')->name('client.show');
    Route::get('/editProfile/{id}', 'ClientsViewsController@edit')->name('client.edit_profile');
    Route::put('/editProfile/update/{id}', 'ClientsViewsController@update')->name('client.edit_profile_update');
    Route::delete('/reservation/delete/{id}', 'ReservationsController@destroy')->name('client.reservation_delete');
    Route::get('/ban/{id}', 'ClientsViewsController@ClientBan')->name('client.ban');
    Route::get('/unban/{id}', 'ClientsViewsController@Clientunban')->name('client.unban');
    Route::get('/approve/{id}', 'ClientsController@store')->name('client.approve');
    Route::delete('/remove/reservation/{id}', 'ClientsViewsController@CheckOut')->name('client.remove');

});