<?php

//Posts
Route::get('posts/create',[
    'uses' => 'CreatePostController@create',
    'as' => 'posts.create'
]);

Route::post('posts/create',[
    'uses' => 'CreatePostController@store',
    'as' => 'posts.store'
]);

Route::post('posts/{post}/comments',[
    'uses' => 'CommentController@store',
    'as' => 'comments.store'
]);

Route::post('comments/{comment}/accept',[
    'uses' => 'CommentController@accept',
    'as' => 'comments.accept'
]);

Route::post('posts/{post}/subscribe',[
    'uses' => 'SubscriptionsController@subscribe',
    'as' => 'posts.subscribe'
]);

Route::delete('posts/{post}/subscribe',[
    'uses' => 'SubscriptionsController@unsubscribe',
    'as' => 'posts.unsubscribe'
]);