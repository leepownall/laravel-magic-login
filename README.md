# 

[![Latest Version on Packagist](https://img.shields.io/packagist/v/pownall/magic-login.svg?style=flat-square)](https://packagist.org/packages/pownall/magic-login)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/pownall/magic-login/run-tests?label=tests)](https://github.com/leepownall/magic-login/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/pownall/magic-login.svg?style=flat-square)](https://packagist.org/packages/pownall/magic-login)


Allows you to create a temporary signed route that logs a user in. There is no config file, you define everything when generating the url.

I see the general usage being

`User requests login` -> `You generate link and send in email` -> `User clicks link and is signed in`.

## Installation

You can install the package via composer:

```bash
composer require pownall/magic-login
```

## Available Methods

- `redirectToUrl(string $url)` - Default is `/`.
- `expiresAt(CarbonInterface $pointInTime)` - Default is `1 hour` after generating link.

## Usage



Simple usage is:

``` php
MagicLogin::forUser($user)->generate();
```

---

If you want to alter the redirect url:

``` php
MagicLogin::forUser($user)
    ->redirectToUrl('/somewhere-else')
    ->generate();
```
or

``` php
MagicLogin::forUser($user)
    ->redirectToUrl(route('admin.dashboard'))
    ->generate();
```

---

If you want to make the link expire earlier or later pass a `CarbonInterface` to the `expireAt` method.

``` php
MagicLogin::forUser($user)
    ->expireAt(Carbon::now()->addMinutes(30))
    ->generate();
```


## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email pownall@hey.com instead of using the issue tracker.

## Credits

- [Lee Pownall](https://github.com/leepownall)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
