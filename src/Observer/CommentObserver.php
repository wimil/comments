<?php

namespace Wimil\Comments\Observer;

use Wimil\Comments\Model\Comment;
use Wimil\Comments\Helpers\UrlLinker\UrlLinker;
use Wimil\Comments\Helpers\FilterWords;
use Wimil\Comments\Helpers\FilterLinks;

class CommentObserver
{
    //private $comment;
    private $urlLinker;
    private $filterLinks;
    //private $config;

    public function __construct()
    {
        //$this->config = array_pop(config('comments'));
        $this->urlLinker = new UrlLinker($this->config('urlLinker.config'));
        //$this->filterLinks = new FilterWords;
    }

    private function config($key)
    {
        return array_get(config('comments'), $key);
    }
    /*
    * after a record has been retrieved.
    */
    public function retrieved(Comment $comment)
    {
        if ($this->config('urlLinker.enable')) {
            $comment->comment = $this->urlLinker->linkUrlsAndEscapeHtml($comment->comment);
        }


        //return $comment;
    }
    /*
    * before a record has been created.
    */
    public function creating(Comment $comment)
    {
        $status = $this->moderationComments($comment->comment);
        if ($status == 'stop')
            return false;

        $comment->status = $status;
    }

    /*
    * after a record has been created.
    */
    public function created()
    {
        //
    }

    /*
    * before a record is updated.
    */
    public function updating(Comment $comment)
    {
        $status = $this->moderationComments($comment->comment);
        if ($status == 'stop')
            return false;

        $comment->status = $status;
    }

    /*
    * after a record has been updated.
    */
    public function updated()
    {
        //
    }

    /*
    * before a record is deleted or soft-deleted.
    */
    public function deleting()
    {
        //
    }

    /*
    * after a record has been deleted or soft-deleted.
    */
    public function deleted()
    {
        //
    }

    private function moderationComments($comment)
    {
        //si exede el limite no dejamos crear el comentario
        if ($this->config('rules.length_limit') <= strlen($comment))
            $status = 'stop';

        //el comentario es publico, oculto o eliminado segun la moderacion
        if ($this->config('moderation_mode') == 1) {
            $status = 'approved';
        } else {
            $filterWords = new FilterWords;
            //$filterWords->filter($comment);
            if ($filterWords->filter($comment)) {
                if ($this->config('moderation_mode') == 2) {
                    $status = 'locked';
                } elseif ($this->config('moderation_mode') == 3) {
                    $status = 'stop';
                }
            } else {
                $status = 'approved';
            }
        }

        if ($status == 'approved') {
            if ($this->config('rules.links.enable')) {
                $filterLinks = new FilterLinks;
                if ($filterLinks->filter($comment)) {
                    $status = 'locked';
                }
            }
        }

        return $status;
    }
}
