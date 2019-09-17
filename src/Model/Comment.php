<?php

namespace Wimil\Comments\Model;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
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
    protected $fillable = ['comment', 'status'];

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
    /**
     * Returns all comments that this comment is the parent of.
     */
    public function children()
    {
        return $this->hasMany(config('comments.model'), 'child_id');
    }
    /**
     * Returns the comment to which this comment belongs to.
     */
    public function parent()
    {
        return $this->belongsTo(config('comments.model'), 'child_id');
    }
}
