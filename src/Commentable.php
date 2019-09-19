<?php

namespace Wimil\Comments;

/**
 * Add this trait to any model that you want to be able to
 * comment upon or get comments for.
 */
trait Commentable
{
    /**
     * This static method does voodoo magic to
     * delete leftover comments once the commentable
     * model is deleted.
     */
    /*protected static function bootCommentable()
    {
        static::deleted(function ($commentable) {
            foreach ($commentable->comments as $comment) {
                $comment->delete();
            }
        });
    }*/
    /**
     * Returns all comments for this model.
     */
    public function comments()
    {
        $comments = $this->morphMany(config('comments.model'), 'commentable');
        if(config('comments.sort_mode')){
            $comments->orderBy('created_at', config('comments.sort_mode'));
        }
        return $comments;
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
