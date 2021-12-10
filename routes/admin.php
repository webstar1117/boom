<?php

use Illuminate\Support\Facades\Route;

    Route::get(
        '/login',
        'Auth\AdminLoginController@showLoginForm'
    )->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::post('logout/', 'Auth\AdminLoginController@logout')->name('admin.logout');
    Route::get('pages-login', 'SkoteController@index');


    //List Users
    Route::get('/list-user', 'AdminHomeController@listUser')->name('admin.list-user');
    Route::post('/list-user/createUser', 'AdminHomeController@createUser');
    Route::post('/list-user/editUser', 'AdminHomeController@editUser');
    Route::post('/list-user/delUser', 'AdminHomeController@delUser');

    //Blogs
    Route::get('/blog', 'BlogController@index')->name('admin.blog');
    Route::post('/blog/create', 'BlogController@create');
    Route::post('/blog/edit', 'BlogController@edit');
    Route::post('/blog/delete', 'BlogController@delete');

    //Blog Categories
    Route::get('/blog-category', 'BlogCategoryController@index')->name('admin.blog-category');
    Route::post('/blog-category/create', 'BlogCategoryController@create');
    Route::post('/blog-category/edit', 'BlogCategoryController@edit');
    Route::post('/blog-category/delete', 'BlogCategoryController@delete');


    //Comments
    Route::get('/comment', 'CommentController@index')->name('admin.comment');
    Route::post('/comment/create', 'CommentController@create');
    Route::post('/comment/edit', 'CommentController@edit');
    Route::post('/comment/delete', 'CommentController@delete');

    //Themes
    Route::get('/theme', 'ThemeController@index')->name('admin.theme');
    Route::post('/theme/create', 'ThemeController@create');
    Route::post('/theme/edit', 'ThemeController@edit');
    Route::post('/theme/delete', 'ThemeController@delete');

    //Theme-category
    Route::get('/theme-category', 'ThemeCategoryController@index')->name('admin.theme-category');
    Route::post('/theme-category/create', 'ThemeCategoryController@create');
    Route::post('/theme-category/edit', 'ThemeCategoryController@edit');
    Route::post('/theme-category/delete', 'ThemeCategoryController@delete');


    //Plan
    Route::get('/plan', 'PlanController@index')->name('admin.plan');
    Route::post('/plan/getOne', 'PlanController@getOne');
    Route::post('/plan/edit', 'PlanController@edit');

    //contact
    Route::get('/contact', 'ContactController@index')->name('admin.contact');
    Route::post('/contact/delete', 'ContactController@delete');

    //memorial
    Route::get('/memorial', 'MemorialController@index')->name('admin.memorial');
    Route::get('/memorial/edit', 'MemorialController@edit');
    Route::get('/memorial/delete', 'MemorialController@delete');

    //memorial--about
    Route::get('/tributes', 'TributeController@index')->name('admin.tribute');
    Route::get('/tributes/edit', 'TributeController@edit');
    Route::get('/tributes/delete', 'TributeController@delete');

    //memorial--life
    Route::get('/lives', 'LifeController@index')->name('admin.life');
    Route::get('/lives/edit', 'LifeController@edit');
    Route::get('/lives/delete', 'LifeController@delete');

    //memorial--stories
    Route::get('/story', 'StoriesController@index')->name('admin.stories');
    Route::get('/story/edit', 'StoriesController@edit');
    Route::get('/story/delete', 'StoriesController@delete');

    //memorial--gallery
    Route::get('/galleries', 'GalleryController@index')->name('admin.gallery');
    Route::get('/galleries/edit', 'GalleryController@edit');
    Route::get('/galleries/delete', 'GalleryController@delete');


    //Add routes before this line only
    // Route::get('/{any}', 'HomeController@index');    

    Route::get('/index', 'AdminHomeController@index')->name('admin.dashboard');
    Route::get('/', 'AdminHomeController@root')->name('admin.dashboard');

