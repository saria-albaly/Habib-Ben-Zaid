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

Route::get('/', 'YearController@index')->middleware(['auth','can']);

Route::resource('/years', 'YearController')->middleware(['auth','can']);
Route::resource('/semesters/instance', 'YearSemesterController')->middleware(['auth','can']);

Route::get('/semester/absences/refresh', 'AbsenceController@refresh')->middleware(['auth','can']);
Route::resource('/semester/absences', 'AbsenceController')->middleware(['auth','can']);

Route::get('/semester/points/refresh', 'PointController@refresh')->middleware(['auth','can']);
Route::resource('/semester/points', 'PointController')->middleware(['auth','can']);

Route::resource('/semester/recite', 'ReciteController')->middleware(['auth','can']);

Route::resource('/semesters', 'SemesterController')->middleware(['auth','can']);
Route::resource('/teachers', 'TeacherController')->middleware(['auth','can']);
Route::resource('/courses', 'CourseController')->middleware(['auth','can']);
Route::resource('/activities', 'ActivityController')->middleware(['auth','can']);
Route::get('/student/find', 'StudentController@search')->middleware(['auth','can']);
Route::resource('/student', 'StudentController')->middleware(['auth','can']);