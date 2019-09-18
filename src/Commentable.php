<?php

namespace Wimil\Comments;

/**
 * Add this trait to any model that you want to be able to
 * comment upon or get comments for.
 */
trait Commentable
{
   
    /**
     * Returns all comments for this model.
     */
    public function comments()
    {
        return $this->morphMany(config('comments.model'), 'commentable');
    }
    /**
     * Returns only approved comments for this model.
     */
    public function approvedComments()
    {
        return $this->morphMany(config('comments.model'), 'commentable')->where('status', 'approved');
    }
    
    public function primaryId()
    {
        return $this->getAttribute($this->primaryKey);
    }
}
