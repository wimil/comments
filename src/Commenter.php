<?php

namespace Wimil\Comments;

use Illuminate\Database\Eloquent\Model;
//use Wimil\Comments\Contracts\Commentable;

/**
 * Add this trait to your User model so
 * that you can retrieve the comments for a user.
 */
trait Commenter
{

    public function comment(Model $commentable, string $commentText = '')
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
        $comments =  $this->morphMany(config('comments.model'), 'commenter');
        if (config('comments.sort_mode')) {
            $comments->orderBy('created_at', config('comments.sort_mode'));
        }
        return $comments;
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
