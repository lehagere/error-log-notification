# Very short description of the package
[![Latest Version on Packagist](https://img.shields.io/packagist/v/lehagere/error-log-notification.svg?style=flat-square)](https://packagist.org/packages/lehagere/error-log-notification)
[![Total Downloads](https://img.shields.io/packagist/dt/lehagere/error-log-notification.svg?style=flat-square)](https://packagist.org/packages/lehagere/error-log-notification)

The package will register logs (error, warning, etc.) in the database and send them via email as a report on the configured duration. I developed the package because I was tired of regularly checking my log files for errors. And as an admin of my systems I want to be ahead of the curve reslove the issues.

## Installation
You can install the package via composer:
```bash
composer require lehagere/error-log-notification
```

## Usage
You have to migrate for the table to be included in your database.
```php
php artisan migrate
```
Publish the configuration file.
```php
php artisan vendor:publish
```
You can update the duration of the notification and who should get the email notification.

### Security
If you discover any security related issues, please send a message @lehagere instead of using the issue tracker.

## Credits
- [Lehagere](https://github.com/lehagere)

## License
The MIT License (MIT). Please see [License File](LICENSE.md) for more information.