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

Route::get('/', 'PublicController@index')->name('welcome');
Route::get('/about', 'PublicController@about')->name('about');
Route::get('/contact', 'PublicController@contact')->name('contact');
Route::get('/posts', 'PublicController@showAllPost')->name('allposts');
Route::get('/post/{post}', 'PublicController@show')->name('single.post.show');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('dashboard');

//user dashboard route
Route::prefix('user')->group(function(){
    Route::post('addcomment','UserController@addComments')->name('add.comments');
    Route::get('dashboard','UserController@dashboard')->name('user.dashboard');
    Route::get('comments', 'UserController@comments')->name('user.comments');
    Route::get('comments/{comment}', 'UserController@deleteComment')->name('comment.delete');
    Route::get('comments/{post}', 'UserController@showPostDescription')->name('this.post.details');
    Route::get('profile', 'UserController@profile')->name('user.profile');
    Route::post('profile','UserController@updateProfile')->name('profile.update');
});

Route::prefix('author')->group(function(){
    Route::get('dashboard','AuthorController@dashboard')->name('author.dashboard');
    Route::get('post', 'AuthorController@post')->name('author.posts');;
    Route::get('comment', 'AuthorController@comments')->name('author.comments');;

    Route::get('create','AuthorController@createPost')->name('post.create');
    Route::post('store','AuthorController@storePost')->name('post.store');
    Route::get('store/{post}','AuthorController@deletePost')->name('post.delete');
    
    Route::get('show/{post}','AuthorController@show')->name('post.show');

    Route::get('edit/{post}','AuthorController@edit')->name('post.edit');
    Route::post('update/{post}','AuthorController@update')->name('post.update');

    Route::get('delete/{post}','AuthorController@delete')->name('post.delete');
    
});


Route::prefix('admins')->group(function (){
    Route::get('/', 'AdminController@dashboard')->name('adminDashboard'); 
    Route::get('users', 'AdminController@users')->name('admin.users');
    Route::post('user/{user}', 'AdminController@deleteUsers')->name('users.delete');
    Route::get('user/{user}/edit', 'AdminController@editUsers')->name('users.edit');
    Route::post('user/{user}/update', 'AdminController@updateUsers')->name('users.update');
    //Route::post('user/{user}/delete', 'AdminController@deleteUsers')->name('users.update');

    Route::get('post', 'AdminController@post')->name('admin.posts');
    Route::get('show/{post}','AdminController@show')->name('post.show');
    Route::get('edit/{post}','AdminController@edit')->name('post.edit');
    Route::post('update/{post}','AdminController@update')->name('post.update');
    Route::post('delete/{post}','AdminController@delete')->name('post.delete');

    Route::get('comment', 'AdminController@comments')->name('admin.comments');
    Route::get('comment/{comment}', 'AdminController@deleteComment')->name('comment.delete');

    
    Route::get('products','AdminController@products')->name('admin.products');    
    Route::get('products/create','AdminController@createProduct')->name('admin.product.create');    
    Route::post('product/store','AdminController@storeProduct')->name('admin.product.store');    
    Route::get('product/{product}/edit','AdminController@editProduct')->name('admin.product.edit');    
    Route::post('product/{product}/update','AdminController@updateProduct')->name('admin.product.update');    
    Route::post('product/{product}/delete','AdminController@deleteProduct')->name('admin.product.delete');    


});

// Routes for web shop..
Route::prefix('shop')->group(function(){
    Route::get('/', 'ShopController@index')->name('shop.index');
    Route::get('product/{product}', 'ShopController@show')->name('product.show');
    Route::get('product/{id}/order', 'ShopController@order')->name('product.order');
    Route::get('product/{id}/executeOrder','ShopController@executeOrder')->name('order.execute');
    
} );