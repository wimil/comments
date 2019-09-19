# Comments for Laravel.


## Features

- Comments and reply Comments
- Blacklist
- Moderation Mode
    - Mode => 1 (Public): All comments will be public.
    - Mode => 2 (Review comments on the blacklist): Comments that do not contain blacklisted words will be public. Otherwise, they  | will remain hidden
    - Mode => 3 (Close): Comments will be created that do not contain blacklisted words. Otherwise, they | will not be created
- Limit comment characters
- Limit number of links in a comment
- UrlLinker (convert text links to html)


## Installation

From the command line:

```bash
composer require wimil/comments
```

### Publish Config & configure

Publish the config file:

```bash
php artisan vendor:publish --provider="Wimil\Comments\Provider" --tag=config
```

### Publish Migrations

You can publish migration to allow you to have more control over your table

```bash
php artisan vendor:publish --provider="Wimil\Comments\Provider" --tag=migrations
```

### Run migrations

We need to create the table for comments.

```bash
php artisan migrate
```

### Add Commenter trait to your Model

Add the `Commenter` trait to your User model so that you can retrieve the comments for a user:

```php
use Wimil\Comments\Commenter;

class User extends Authenticatable
{
    use Notifiable, Commenter;
}
```

### Add Commentable trait to models

Add the `Commentable` trait to the model for which you want to enable comments for:

```php
use Wimil\Comments\Commentable;

class Product extends Model
{
    use Commentable;
}
```

If you want to have your own Comment Model create a new one and extend my Comment model.

``` php
use Wimil\Comments\Model\Comment as BaseComment;

class Comment extends BaseComment
{
    // ...
}
```

and dont forget to update the model name in the `config/comment.php` file.

Comment package comes with several modes.


## Usage

``` php
$user = App\User::first();
$product = App\Product::first();

// $user->comment(Commentable $model, $comment = '');
$user->comment($product, 'Lorem ipsum ..');

```
