# Using Monolog

- [Installation](#installation)
  1. [Basic Usage](#basic-usage)
- [Items](#items)
  1. [File](#file)
  2. [Get Dir List](#get-dir-list)
  3. [Get Dirs List](#get-dirs-list)
  4. [Get Dir Files List](#get-dir-files-list)
  5. [Remove Directorys](#remove-directorys)
  6. [Json Encode](#json-encode)
  7. [Get Json File](#get-json-file)
  8. [Array Merge](#array-merge)

## Installation

OliveCMS/Tools is available on Packagist ([OliveCMS/Tools](http://packagist.org/packages/OliveCMS/Tools)) and as such installable via [Composer](http://getcomposer.org/).

```bash
composer require OliveCMS/Tools
```

If you do not use Composer, you can grab the code from GitHub, and use any PSR-0 compatible autoloader (e.g. the [Symfony2 ClassLoader component](https://github.com/symfony/ClassLoader)) to load Monolog classes.


### Basic Usage

``` php
// load autoload
require_once 'vendor/autoload.php';
use Olive\Tools;
```

## Items


### File

``` php
// last argument type open file -> default: 'w'
// @return void

Tools::file('/path/to/file', 'content');
Tools::file('/path/to/file', 'content', 'a');
```

### Get Dir List

Get Directorys of path

``` php
// @return array

$list = Tools::getDirList('/path/to/directory/');
```

### Get Dirs List

Get all Directorys of path (Recursive)

``` php
// @return array

$list = Tools::getDirsList('/path/to/directory/');
```

### Get Dir Files List

Get Files Directorys of path

``` php
// @return array

$list = Tools::getDirFiles('/path/to/directory/');
```

### Remove Directorys

Remove not empty Directory

``` php
// @return void

Tools::rmDir('/path/to/directory/');
```

### Json Encode

Json encode with pretty

``` php
// @return string

$json = Tools::jsonEncode(['ali', 'mehdi']);
```

### Get Json File

Json encode with pretty

``` php
// @return array | object

$array = Tools::getJsonFile('/path/to/file.json');
$object = Tools::getJsonFile('/path/to/file.json', false);
```

### Array Merge

Merge arrays with compare

``` php
// @return array | object

$array = Tools::getJsonFile('/path/to/file.json');
$object = Tools::getJsonFile('/path/to/file.json', false);
```
