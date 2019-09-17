# comments
Comments for Laravel.

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

### Publish Migrations (customization)

You can publish migration to allow you to have more control over your table

```bash
php artisan vendor:publish --provider="Wimil\Comments\Provider" --tag=migrations
```

### Run migrations

We need to create the table for comments.

```bash
php artisan migrate
```

### Add Commenter trait to your User model

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
