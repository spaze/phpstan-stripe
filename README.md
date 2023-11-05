# phpstan-stripe
Stripe SDK extension for PHPStan

## ~~Looking for a maintainer/EOL~~
UPDATE: I've found a new maintainer(s), see [the discussion](https://github.com/spaze/phpstan-stripe/discussions/19) so this will probably change hands (and URL) soon. Thanks!

---

Adds particular types replacing `Stripe\StripeObject` type declaration for many properties in many classes used by the PHP library for the Stripe API.
See `extension.neon` for the full list of currently replaced properties.

Also adds types for properties used only when the object is updated.
These are not documented using `@property` tags on the classes (or the types are wrong), and the dev team [feels](https://github.com/stripe/stripe-php/pull/543) it should stay this way.
Honestly, I'm not sure adding `@property` tags would be the best way either.

PHPStan will obviously flag such property access and this extension will resolve those errors by telling PHPStan such properties exist.

This extension is not using
```
parameters:
	universalObjectCratesClasses:
		- Stripe\StripeObject
```
in its configuration because in the SDK, everything `extends StripeObject` (or everything `extends ApiResource` which in turn `extends StripeObject`) so each property your code would read or write would exist, at least for PHPStan.
And I wanted this extension to provide some more precise checks.

If you don't want to or can't use this extension, add the `universalObjectCratesClasses` config snippet to your `phpstan.neon` and be ready to go.

## Installation

The package is [hosted on Packagist](https://packagist.org/packages/spaze/phpstan-stripe) so you can install it using [Composer](https://getcomposer.org/):

```
composer require --dev spaze/phpstan-stripe
```

If you use [phpstan/extension-installer](https://github.com/phpstan/extension-installer), you are all set!

For manual installation, add this to your `phpstan.neon`:

```
includes:
	- vendor/spaze/phpstan-stripe/extension.neon
```
