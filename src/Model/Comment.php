<?php

namespace Wimil\Comments\Model;

use Illuminate\Database\Eloquent\Model;
use Wimil\Comments\Commentable;

class Comment extends Model
{
    use Commentable;
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['commenter'];


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['comment', 'status', 'commenter_id', 'commenter_type'];


    /**
     * The user who posted the comment.
     */
    public function commenter()
    {
        return $this->morphTo();
    }
    /**
     * The model that was commented upon.
     */
    public function commentable()
    {
        return $this->morphTo();
    }
}
