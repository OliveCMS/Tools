<?php
namespace Olive;

class Tools
{
    public static function file($file, $content = '', $p = 'w')
    {
        if (($p == 'r' or $p == 'r+') and ! file_exists($file)) {
            return false;
        }
        if (($p == 'x' or $p == 'x+') and file_exists($file)) {
            return false;
        }
        $file = fopen($file, $p);
        fwrite($file, $content);
        fclose($file);

        return true;
    }

    public static function getDirList($dir, $sort = false)
    {
        $return = [];
        if (is_dir($dir)) {
            foreach (scandir($dir, 1) as $value) {
                if ($value != '.' and $value != '..' and is_dir($dir . '/' . $value)) {
                    $return[] = $value;
                }
            }
        }
        if ($sort == true) {
            sort($return);
        }

        return $return;
    }

    public static function getDirsList($dir, $path = '')
    {
        $return = [];
        if (is_dir($dir)) {
            foreach (scandir($dir, 1) as $value) {
                $r = $dir . '/' . $value;
                if ($value != '.' and $value != '..' and is_dir($r)) {
                    $return = array_merge($return, self::getDirsList($r, $path . $value . '/'));
                    $return[] = $path . $value;
                }
            }
        }

        return $return;
    }

    public static function getDirFiles($dir, $sort = true)
    {
        $return = [];
        if (is_dir($dir)) {
            foreach (scandir($dir, 1) as $value) {
                if ($value != '.' and $value != '..' and ! is_dir($dir . '/' . $value)) {
                    $return[] = $value;
                }
            }
        }
        if ($sort == true) {
            sort($return);
        }

        return $return;
    }

    public static function rmDir($dir)
    {
        if (is_dir($dir)) {
            foreach (scandir($dir, 1) as $value) {
                if ($value != '.' and $value != '..') {
                    $path = $dir . '/' . $value;
                    if (is_dir($path)) {
                        self::rmDir($path);
                    }
                    if (file_exists($path)) {
                        unlink($path);
                    }
                }
            }
            rmdir($dir);
        }
    }

    public static function jsonEncode($array, $json_com = 'pretty')
    {
        if (phpversion() > '5.4.0' and $json_com == 'pretty') {
            return json_encode($array, JSON_PRETTY_PRINT);
        } else {
            return json_encode($array);
        }
    }

    public static function getJsonFile($file, $array = true)
    {
        $return = [];
        if (file_exists($file)) {
            $return = json_decode(file_get_contents($file), $array);
        }

        return $return;
    }

    public static function arrayMerge($a, $b)
    {
        if (! is_array($a)) {
            if ($a != '') {
                $a = [$a];
            } else {
                $a = [];
            }
        }
        if (! is_array($b)) {
            if ($b != '') {
                $b = [$b];
            } else {
                $b = [];
            }
        }
        foreach ($a as $key => $value) {
            if (isset($b[$key]) == false) {
                $b[$key] = $value;
            } elseif (is_array($value) and is_array($b[$key])) {
                // https://stackoverflow.com/questions/173400/how-to-check-if-php-array-is-associative-or-sequential
                if (array_values($value) == $value and array_values($b[$key]) == $b[$key]) {
                    $b[$key] = array_values(array_unique(array_merge($value, $b[$key])));
                } else {
                    $b[$key] = self::arrayMerge($value, $b[$key]);
                }
            }
        }

        return $b;
    }

    public function runCaller($call, $args = [])
    {
        if (is_string($call)) {
            if (function_exists($call)) {
                return call_user_func_array($call, $args);
            } else {
                return $call;
            }
        } elseif (is_array($call) and count($call) == 2) {
            $class = $call[0];
            $method = $call[1];
            if (class_exists(get_class($class))) {
                if (method_exists($class, $method)) {
                    return call_user_func_array([$class, $method], $args);
                }
            }
        } elseif (is_callable($call)) {
            return call_user_func_array($call, $args);
        }
    }
}
