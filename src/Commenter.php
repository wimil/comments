<?php

namespace Wimil\Comments;

/**
 * Add this trait to your User model so
 * that you can retrieve the comments for a user.
 */
trait Commenter
{
    public function comment($commentable, string $commentText = '')
    {

        $commentModel = config('comments.model');

        $comment = new $commentModel([
            'comment' => $commentText,
            'status' => config('comments.status'),
            'commenter_id'   => $this->primaryId(),
            'commenter_type' => get_class(),
        ]);

        $commentable->comments()->save($comment);

        return $comment;
    }
    
    
    /**
     * Returns all comments that this user has made.
     */
    public function comments()
    {
        return $this->morphMany(config('comments.model'), 'commenter');
    }
    /**
     * Returns only approved comments that this user has made.
     */
    public function approvedComments()
    {
        return $this->morphMany(config('comments.model'), 'commenter')->where('status', 'approved');
    }
    
    private function primaryId()
    {
        return $this->getAttribute($this->primaryKey);
    }
}
