<?php

return [

    /*
    |--------------------------------------------------------------------------
    | This is the default comment model of the application.
    |--------------------------------------------------------------------------
    | If you create another kind of comment with the extension of this, you should      | update this field with that.
    |
    */

    'model' => \Wimil\Comments\Model\Comment::class,


    /*
    |--------------------------------------------------------------------------
    | Timestamps
    |--------------------------------------------------------------------------
    | Change timestamps for Unix timestamps
    | timestamps => true (default) / false (Unix timestamps)
    */
    'timestamps' => true,


    /*
    |--------------------------------------------------------------------------
    | Blacklist (forbidden words)
    |--------------------------------------------------------------------------
    | You can add. * At the beginning or end of a word or phrase so that more words    || are found. Examples:
    |
    | - .*bot  would include "bot" and "robot" as blacklist terms.
    | - bot.* would include "bot" and "bots" as blacklist terms.
    | - .*bot.* would include "bot", "robot", "bots" and "robots" as blacklisted terms.
    |
    */

    'blacklist' => ['doramasmp4.com', '.*bot', 'test.*', '.*lara.*'],

    /*
    |--------------------------------------------------------------------------
    | Moderation
    |--------------------------------------------------------------------------
    | Mode => 1 (Public)
    | - All comments will be public.
    |
    | Mode => 2 (Review comments on the blacklist)
    | - Comments that do not contain blacklisted words will be public. Otherwise, they  | will remain hidden
    |
    | Mode => 3 (Close)
    | - Comments will be created that do not contain blacklisted words. Otherwise, they | will not be created
    |
    */

    'moderation_mode' => 1,

    /*
    |--------------------------------------------------------------------------
    | Rules
    |--------------------------------------------------------------------------
    | Length Limit: Maximum number of characters a comment can have
    |
    | Autoclose: Comments closed automatically
    | - enable => false (Enabled / Disabled)
    | - days => null (days to close comments)
    |
    | links: Review comments with links (Comments are automatically hidden)
    | - enable => false (Enabled / Disabled)
    | -limit => 0 (allowed links limit)
    |
    */

    'rules' => [
        'length_limit' => 5000,
        /*'autoclose' => [
            'enable' => false,
            'days' => 0,
        ],*/
        'links' => [
            'enable' => false,
            'limit' => 0
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Sort comments by
    |--------------------------------------------------------------------------
    | Comments are sorted according to the created_at column
    | sort_mode => 'desc (desc/asc) or null disabled
    */

    'sort_mode' => 'desc',

    /*
    |--------------------------------------------------------------------------
    | UrlLinker
    |--------------------------------------------------------------------------
    | UrlLinker is a PHP module for converting plain text snippets to HTML, and any web | addresses in the text into HTML hyperlinks.
    */
    'urlLinker' => [
        'enable' => true,
        'config' => [
            'validDomainTDL' => ['.com'],
            //'allowEmailLinkCreator' => false
        ],
    ]
];
