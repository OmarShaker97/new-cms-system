<?php

use Illuminate\Support\Facades\Route;

Route::resource('/comments', 'PostCommentsController');

Route::put('/comments/{comment}/approve', 'PostCommentsController@approvePost')->name('comments.approve');

Route::put('/comments/{comment}/unapprove', 'PostCommentsController@unapprovePost')->name('comments.unapprove');

Route::resource('/comments/replies', 'CommentRepliesController');

Route::middleware('auth')->group(function(){

    Route::post('comment/reply', 'CommentRepliesController@createReply')->name('replies.createReply');

});
