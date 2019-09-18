# Comments for Laravel.


## Installation

From the command line:

```bash
composer require wimil/comments
```

### Publish Config & configure (optional)

Publish the config file (optional):

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
use Actuallymab\LaravelComment\Models\Comment as LaravelComment;

class Comment extends LaravelComment
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
