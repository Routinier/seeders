# Seeders 

Database seeders for our laravel applications. Basically its a stripped down copy of [spatie/seeders](https://github.com/spatie/seeders).
Many thanks to them for the initial work on creating package. That we try to extend and keep maintained. 

## Install 

You can install the package via composer. 

```php 
$ composer require routinier/seeders
```

## Overview 

This package provides the base database seeders for our Laravel applicationd. 
The `Routinier\Seeders\DatabaseSeeder` class adds some extra utility to laravel's seeder. 

Our classes for recurring, specific parts of our application. 

## Example 

```php 
use Routinier\Seeders\DatabaseSeeder as BaseDatabaseSeeder; 
use Routinier\Seeders\StringSeeder; 

class DatabaseSeeder extends BaseDatabaseSeeder
{
    public function run(): void 
    {
        parent::run(); 

        $this->call(StringSeeder::class);
        $this->call(MySeeder::class);
    }
}
```

## Changelog 

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently. 

## Security 

If you discover any security related issues, please see our [Security policy](https://github.com/Routinier/.github/security/policy) 
instead of using the public issue tracker.

## Credits

- [Spatie](https://github.com/spatie)
- [Tim Joosten](https://github.com/Tjoosten)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
