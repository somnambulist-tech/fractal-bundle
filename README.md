# Somnambulist Fractal Bundle

[![GitHub Actions Build Status](https://img.shields.io/github/actions/workflow/status/somnambulist-tech/fractal-bundle/tests.yml?logo=github&branch=main)](https://github.com/somnambulist-tech/fractal-bundle/actions?query=workflow%3Atests)
[![Issues](https://img.shields.io/github/issues/somnambulist-tech/fractal-bundle?logo=github)](https://github.com/somnambulist-tech/fractal-bundle/issues)
[![License](https://img.shields.io/github/license/somnambulist-tech/fractal-bundle?logo=github)](https://github.com/somnambulist-tech/fractal-bundle/blob/main/LICENSE)
[![PHP Version](https://img.shields.io/packagist/php-v/somnambulist/fractal-bundle?logo=php&logoColor=white)](https://packagist.org/packages/somnambulist/fractal-bundle)
[![Current Version](https://img.shields.io/packagist/v/somnambulist/fractal-bundle?logo=packagist&logoColor=white)](https://packagist.org/packages/somnambulist/fractal-bundle)

A fork and re-write of [samj/fractal-bundle](https://github.com/samjarrett/FractalBundle) to provide [Fractal](https://fractal.thephpleague.com)
integration with the Symfony Framework.

## Requirements

 * PHP 8.2+
 * symfony/framework-bundle 6.4+

## Installation

Install using composer, or checkout / pull the files from github.com.

 * composer require somnambulist/fractal-bundle

## Usage

Add the `SomnambulistFractalBundle` to your `bundles.php` list if not registered by Symfony Flex.

## Using Transformers as Services

This bundle allows auto-wiring / auto-configuring transformers as services. This allows you to
take advantage of Symfonys container to resolve dependencies and reference transformers by class
name (or service alias).

So long as the transformer extends from `League\Fractal\TransformerAbstract` or is tagged with
`somnambulist.fractal_bundle.transformer`, it will be available to the Fractal Manager instance.

```yaml
services:
    App\Http\Api\Transformers\:
        resource: '%kernel.project_dir%/Http/Api/Transformers/'
```

If transformers don't extend the `TransformerAbstract` be sure to tag them:

```yaml
services:
    App\Http\Api\Transformers\:
        resource: '%kernel.project_dir%/Http/Api/Transformers/'
        tags: ['somnambulist.fractal_bundle.transformer']
```

__Note:__ if your transformer is not registered as a service or passed as a valid callable or
instance of `TransformerAbstract`, this library will raise an exception.

For example: to add an auth check to a `UserTransformer` (example from samj readme):

```php
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    public function __construct(private AuthorizationChecker $authorizationChecker)
    {
    }
    
    public function transform(User $user)
    {
        $data = [
            'id' => $user->id(),
            'name' => $user->name(),
        ];
        
        if ($this->authorizationChecker->isGranted(UserVoter::SEE_EMAIL, $user)) {
            $data['email'] = $user->email();
        }
        
        return $data;
    }
}
```
Reference the transformer by either a service alias name, or the class name:

```php
$resource = new Collection($users, UserTransformer::class);
```
This works in includes as well:

```php
public function includeFriends(User $user)
{    
    return $this->collection($user->friends(), UserTransformer::class);
}
```

Look in the [sample application](tests/Fixtures) for some further examples.

## Tests

PHPUnit 9+ is used for testing. Run tests via `vendor/bin/phpunit`.
