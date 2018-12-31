# Using Tools

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
  8. [Run Callable Methods](#run-callable-methods)

## Installation

olive-cms/tools is available on Packagist ([olive-cms/tools](http://packagist.org/packages/olive-cms/tools)) and as such installable via [Composer](http://getcomposer.org/).

```bash
composer require olive-cms/tools
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
/**
 * file tools
 * last argument type stream file -> default: 'w'
 * @return bool
 */

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

$a=[
  'arr1'=>[
    'arr11'=>[1,2,3,4,5,6],
    'arr12'=>[7,8,9,10,11]
  ],
  'str1'=>'tools'
];
$b=[
  'arr1'=>[
    'arr11'=>[11,22,33],
    'arr12'=>[
      'op' => [111,222,333],
      'op2' => 'lurem'
    ]
  ],
  'str2'=>'merge'
];
$merged=Tools::arrayMerge($a, $b));
```

output:

```
Array
(
    [arr1] => Array
        (
            [arr11] => Array
                (
                    [0] => 1
                    [1] => 2
                    [2] => 3
                    [3] => 4
                    [4] => 5
                    [5] => 6
                    [6] => 11
                    [7] => 22
                    [8] => 33
                )

            [arr12] => Array
                (
                    [op] => Array
                        (
                            [0] => 111
                            [1] => 222
                            [2] => 333
                        )

                    [op2] => lurem
                    [0] => 7
                    [1] => 8
                    [2] => 9
                    [3] => 10
                    [4] => 11
                )

        )

    [str2] => merge
    [str1] => tools
)
```

### Run Callable Methods

Run Callable Methods (functions, oops, string)

``` php
// return mixed

class Hello
{
    public function say($name)
    {
        return 'hello ' . $name;
    }
}

$testob = new Hello;
echo Tools::runCaller([$testob, 'say'], ['world']); // Hello world
```
