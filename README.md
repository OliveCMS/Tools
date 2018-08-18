# OliveCMS Common Tools

Most common tools for [OliveCMS](https://github.com/OliveCMS/) Project.

## Installation

Install the latest version with

```
$ composer require olive-cms/tools
```

## Basic Usage

``` php
require_once 'vendor/autoload.php';
use Olive\Tools;

var_dump(Tools::getDirsList('/path/to/dir'));
```

## Documentation

- [Usage Instructions](doc/01-usage.md)

## Requirements

- PHP 5.5+.

## License

olive-cms/tools is licensed under the [MIT license](http://opensource.org/licenses/MIT).
