<?php
// specialities routes
Route::get('/specialities', 'SpecialityController@index')->name('specialities'); // Read
Route::post('/specialities/store', 'SpecialityController@store')->name('specialities.store'); // Write
Route::get('/specialities/find/{id}', 'SpecialityController@findById')->name('specialities.find'); // Modify
Route::patch('/specialities/update/{id}', 'SpecialityController@update')->name('specialities.update'); // Modify
Route::get('/specialities/change_status/{id}', 'SpecialityController@changeStatus')->name('specialities.change_status'); // Modify
Route::delete('/specialities/delete/{id}', 'SpecialityController@destroy')->name('specialities.destroy'); // Delete


// doctors routes
Route::get('/doctors', 'DoctorController@index')->name('doctors'); // Read
Route::post('/doctors/store', 'DoctorController@store')->name('doctors.store'); // Write
Route::get('/doctors/find/{id}', 'DoctorController@findById')->name('doctors.find'); // Modify
Route::patch('/doctors/update/{id}', 'DoctorController@update')->name('doctors.update'); // Modify
Route::get('/doctors/change_status/{id}', 'DoctorController@changeStatus')->name('doctors.change_status'); // Modify
Route::delete('/doctors/delete/{id}', 'DoctorController@destroy')->name('doctors.destroy'); // Delete


// departments routes
Route::get('/departments', 'DepartmentController@index')->name('departments'); // Read
Route::post('/departments/store', 'DepartmentController@store')->name('departments.store'); // Write
Route::get('/departments/find/{id}', 'DepartmentController@findById')->name('departments.find'); // Modify
Route::patch('/departments/update/{id}', 'DepartmentController@update')->name('departments.update'); // Modify
Route::get('/departments/change_status/{id}', 'DepartmentController@changeStatus')->name('departments.change_status'); // Modify
Route::delete('/departments/delete/{id}', 'DepartmentController@destroy')->name('departments.destroy'); // Delete


// wards routes
Route::get('/wards', 'WardController@index')->name('wards'); // Read
Route::post('/wards/store', 'WardController@store')->name('wards.store'); // Write
Route::get('/wards/find/{id}', 'WardController@findById')->name('wards.find'); // Modify
Route::patch('/wards/update/{id}', 'WardController@update')->name('wards.update'); // Modify
Route::get('/wards/change_status/{id}', 'WardController@changeStatus')->name('wards.change_status'); // Modify
Route::delete('/wards/delete/{id}', 'WardController@destroy')->name('wards.destroy'); // Delete


// documents routes
Route::get('/documents', 'DocumentController@index')->name('documents'); // Read
Route::get('/documents/is_dead', 'DocumentController@isDead')->name('documents.is_dead'); // Read
Route::get('/documents/is_police_case', 'DocumentController@isPoliceCase')->name('documents.is_police_case'); // Read
Route::post('/documents/store', 'DocumentController@store')->name('documents.store'); // Write
Route::get('/documents/find/{id}', 'DocumentController@findById')->name('documents.find'); // Modify
Route::patch('/documents/update/{id}', 'DocumentController@update')->name('documents.update'); // Modify
Route::get('/documents/change_status/{id}', 'DocumentController@changeStatus')->name('documents.change_status'); // Modify
Route::delete('/documents/delete/{id}', 'DocumentController@destroy')->name('documents.destroy'); // Delete


Route::get('/reports', 'ReportController@index')->name('reports'); // Read
Route::get('/reports/submit', 'ReportController@generateReport')->name('reports.submit'); // Read
