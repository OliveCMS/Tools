# OliveCMS Common Tools

Most common tools for [OliveCMS](https://github.com/OliveCMS/) Project.

## Installation

Install the latest version with

```
$ composer require OliveCMS/Tools
```

## Basic Usage

``` php
require_once 'vendor/autoload.php';
use OliveCMS\Tools\Common as Tools;

var_dump(Tools::getDirsList('/path/to/dir'));
```

## Documentation

- [Usage Instructions](doc/01-usage.md)

## Requirements

- PHP 5.5+.

## License

OliveCMS/Tools is licensed under the [MIT license](http://opensource.org/licenses/MIT).
