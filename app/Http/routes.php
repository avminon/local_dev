<?php

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

Route::group(['middleware' => 'auth.admin'], function () {
    Route::resource('categories', 'CategoryController');
    Route::resource('words', 'WordController');
    Route::resource('lessons', 'LessonController');
});

Route::group(['middleware' => ['auth']], function () {
    Route::resource('sets', 'SetController');
    Route::get('/sets/take', [
        'as' => 'take',
        'uses' => 'SetController@take',
    ]);
    Route::get('quiz', [
        'as' => 'sets.quiz',
        'uses' => 'ResultController@index',
    ]);

    Route::get('study', ['as' => 'sets.study', 'uses' => 'SetController@studySet']);
    Route::get('unstudy', ['as' => 'sets.unstudy', 'uses' => 'SetController@unstudySet']);

    Route::get('recommend', ['as' => 'sets.recommend', 'uses' => 'SetController@recommendSet']);
    Route::get('unrecommend', ['as' => 'sets.unrecommend', 'uses' => 'SetController@unrecommendSet']);

    Route::resource('terms', 'TermController');

    Route::get('/sets/{id}/terms/create/', ['as' => 'terms.create', 'uses' => 'TermController@create']);
    Route::get('/sets/{id}/terms/list/', ['as' => 'terms.list', 'uses' => 'TermController@listTerms']);

    Route::resource('categories', 'CategoryController', ['only' => ['index']]);
    Route::resource('words', 'WordController', ['only' => ['index']]);
    Route::resource('lessons', 'LessonController');
    Route::resource('lesson_words', 'LessonWordController');
    Route::get('/exam', [
        'as' => 'exam',
        'uses' => 'LessonWordController@index',
    ]);
    Route::post('/exam', [
        'as' => 'exam',
        'uses' => 'LessonWordController@update',
    ]);
    Route::get('/result/{id}', 'LessonWordController@show');

    Route::get('/', ['as' => 'home', 'uses' => 'UserController@index']);
    Route::get('/home', ['as' => 'home', 'uses' => 'UserController@index']);

    Route::get('/activities', ['as' => 'activities', 'uses' => 'UserController@activities']);

    Route::get('/change-password', ['as' => 'users.change.password', 'uses' => 'UserController@changePassword']);
    Route::patch('/update-password', ['as' => 'users.update.password', 'uses' => 'UserController@updatePassword']);

    Route::get('/users/list', ['as' => 'users.list', 'uses' => 'UserController@listUsers']);
    Route::get('/users/filter', ['as' => 'users.filter', 'uses' => 'UserController@filterUsers']);

    Route::get('/follow/{id}', ['as' => 'user.follow', 'uses' => 'UserController@followUser']);
    Route::get('/unfollow/{id}', ['as' => 'user.unfollow', 'uses' => 'UserController@unFollowUser']);

    Route::get('/users/edit', ['as' => 'users.edit', 'uses' => 'UserController@edit']);
    Route::patch('/users/update', ['as' => 'users.update', 'uses' => 'UserController@update']);

    Route::get('/users/show/{id}', 'UserController@show');

});
