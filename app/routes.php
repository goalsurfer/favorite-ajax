<?php

// Simulate a logged in user
Auth::loginUsingId(12);

Route::get('/', function()
{
    $posts = Post::with('favorites')->get();

    return View::make('posts.index', compact('posts'));
});

Route::get('users/{id}/favorites', function ($userId)
{
    $posts = User::findOrFail($userId)->favorites;

    return View::make('posts.index', compact('posts'));
});

Route::post('favorites', ['as' => 'favorites.store', function()
{
    
	if (Request::ajax()) {

		$postId = Input::get('postid');

		$favorites = DB::table('favorites')->whereUserId(Auth::user()->id)->lists('post_id');
		
		if (!in_array($postId, $favorites)) {

		Auth::user()->favorites()->attach($postId);

		}

		return Post::findOrFail($postId)->favorites()->count();

		
			
	} else {

		//Do the usual here...
    }
}])->before('auth');

Route::post('favorites-delete', ['as' => 'favorites.destroy', function()
{
    if (Request::ajax()) {

    $postId = Input::get('postid');

    Auth::user()->favorites()->detach($postId);

    return Post::findOrFail($postId)->favorites()->count();
	
	} else {

		//Do the usual here..
		
	}
}])->before('auth');

Route::get('posts/{id}/favorites', function ($id)
{
	$post = Post::find($id)->favorites;
	return $post->count();
});


