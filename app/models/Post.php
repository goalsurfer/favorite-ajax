<?php

class Post extends Eloquent {
    protected $fillable = ['title', 'user_id', 'body'];

    public function favorites()
    {
    	return $this->belongsToMany('Post', 'favorites');
    }
}
