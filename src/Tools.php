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

    public static function arrayMerge($default, $option)
    {
        foreach ($default as $key => $value) {
            if (isset($option[$key]) == false) {
                $option[$key] = $value;
            } elseif (is_array($value) and is_array($option[$key])) {
                // https://stackoverflow.com/questions/173400/how-to-check-if-php-array-is-associative-or-sequential
                if (array_values($value) == $value and array_values($option[$key]) == $option[$key]) {
                    $option[$key] = array_values(array_unique(array_merge($value, $option[$key])));
                } else {
                    $option[$key] = self::arrayMerge($value, $option[$key]);
                }
            }
        }

        return $option;
    }
}
