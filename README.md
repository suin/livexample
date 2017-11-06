# Livexample

[![travis-ci-badge]][travis-ci] [![packagist-dt-badge]][packagist]

This is a documentation oriented testing framework for from PHP 5.3 to 7.x. Its purpose is ensure your example codes works by unit testing. Inspired by [Golang testing "Examples"](https://golang.org/pkg/testing/#hdr-Examples).

## A simple test case example

See an example below. The first section is example code which will be tested. The comment which begins with `Output` is test code.

```php
<?php

function hello(string $name): string {
	return 'hello ' . $name;
}
echo hello('alice') . "\n";
echo hello('bob') . "\n";

// Output:
// hello alice
// hello carol
```

This example code is broken. The word "carol" is expected as output, however it does not appear. This test case fails, but you are able to know the example code has a problem and you may fix it.

### How does it works?

Livexample does following steps:

1. Find `Output` statement in the example code by parsing it.
2. Run the code in PHPUnit and capture the output.
3. Compare the expected output and the actual output.

## Benefits

Sometimes example codes are broken, by adding new features, forgetting to update them, pull-requests which don't take care of example codes and so on.

Broken example codes are bad experience for library users. 

By using Livexample, you will get benefits:

* 😆 Your example codes are protected from unexpected regression.
* 😇 You can easily check your example codes are valid.
* 😋 Your library users can use the valid example codes by copy and paste.
* 😉 You don't have to add big change to your existing sample codes; just adding some comments.

## Features

* Livexample works a part of PHPUnit.
* Very low learning cost.

## Getting started

Install `suin/livexample` via Composer:

```
composer require --dev suin/livexample
```

Add `ExampleTest.php` to your tests directory:

```php
use Livexample\PHPUnit\ExampleTestCase;

class ExampleTest extends ExampleTestCase
{
    public function exampleFiles()
    {
        // specify your example code directory.
        return self::exampleDirectory('example');
    }
}
```

Run phpunit:

```
phpunit
```

## Assertion syntax

There are two syntax for assertion:

* Long: `// Output: {expected output}`
* Short: `//=> {expected output}`

```php
echo 1; // Output: 1
```

```php
echo "hello"; //=> hello
```

```php
var_dump([1, 2, 3]);
// Output:
// array(3) {
// 	[0] =>
// 	int(1)
// 	[1] =>
// 	int(2)
// 	[2] =>
// 	int(3)
// }
```

## Why supports PHP 5.3 in 2017?

The official support for PHP 5.3 has ended, however, RHEL/CentOS keeps supporting PHP 5.3 even in 2017. The old PHP environments still remain in the running service today. Livexample is also suppoed to be used for refactoring such old environments.

## Testing Livexample

### Running tests

``` bash
composer test
```

### Running tests through PHP 5.3 ~ 7.1

```
docker-compose up
```

## License

This library is licensed under the MIT license. Please see [LICENSE](LICENSE.md) for more details.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more details.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for more details.
Please fix my English 😂.

<!-- Badges -->
[travis-ci]: https://travis-ci.org/suin/livexample
[travis-ci-badge]: https://img.shields.io/travis/suin/livexample.svg?style=flat-square
[packagist]: https://packagist.org/packages/suin/livexample
[packagist-dt-badge]: https://img.shields.io/packagist/dt/suin/livexample.svg?style=flat-square
