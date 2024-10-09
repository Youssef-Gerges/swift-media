# Swift Media Package
<small>Crafted with ♥️ by Laravel Daddy</small>

## Installation

To install the package, run the following command:

```bash
composer require laravel-daddy/swift-media
php artisan vendor:publish --tag=migrations
```

Upon installation, the package will automatically publish the necessary migrations and register the **SwiftMediaServiceProvider**.

## Usage

All media are automatically cached to enhance the performance of your application. This ensures that accessing settings is efficient and optimized.

You can manage settings using either the facade or the helper method.

### Using the Facade

```php
use LaravelDaddy\SwiftSettings\Facade\SwiftSettingsFacade;

// will upload file and delete old file if exist
SwiftMedia::uploadFile($model_type= User::class, $model_id= 2, $attribute= 'profile', $file, $path= '/');
SwiftMedia::deleteFile($model_type= User::class, $model_id= 2, $attribute= 'profile');
SwiftMedia::getAllFiles();
SwiftMedia::getAllFilesPaginated($limit = 20);

```

### Using the Helper Method

```php
// will upload file and delete old file if exist
swift_media()->uploadFile($model_type= User::class, $model_id= 2, $attribute= 'profile', $file, $path= '/');
swift_media()->deleteFile($model_type= User::class, $model_id= 2, $attribute= 'profile');
swift_media()->getAllFiles();
swift_media()->getAllFilesPaginated($limit = 20);
```

Both approaches allow you to retrieve or update media efficiently, with all keys being cached for improved performance.
