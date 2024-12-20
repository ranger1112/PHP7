<?php

namespace Application\Autoload;

use Exception;

class Loader
{
    private static array $dirs;
    private static int   $registered = 0;

    const UNABLE_TO_LOAD = 'Unable to load class';

    /**
     * 再需要的时候可以创建一个 Loader 实例加载自定义目录的类文件
     * @param array $dirs
     */
    public function __construct(array $dirs = [])
    {
        self::init($dirs);
    }

    /**
     * @param $dirs
     * @return void
     */
    public static function init($dirs = [])
    {
        if ($dirs) {
            self::addDirs($dirs);
        }

        if (self::$registered == 0) {
            // 注册自动加载
            spl_autoload_register(__CLASS__ . '::autoload');
            self::$registered++;
        }
    }

    /**
     * @param $dirs
     * @return void
     */
    public static function addDirs($dirs)
    {
        if (is_array($dirs)) {
            self::$dirs = array_merge(self::$dirs, $dirs);
        } else {
            self::$dirs[] = $dirs;
        }
    }

    /**
     * @param $file
     * @return bool
     */
    protected static function loadFile($file): bool
    {
        if (file_exists($file)) {
            require_once $file;
            return TRUE;
        }
        return FALSE;
    }

    /**
     * 自动加载类
     * @param $class
     * @return bool
     * @throws Exception
     */
    public static function autoload($class): bool
    {
        $success = FALSE;
        $fn      = str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
        // 尝试从自定义目录加载文件
        foreach (self::$dirs as $start) {
            $file = $start . DIRECTORY_SEPARATOR . $fn;
//            echo 'Loading ' . $file . PHP_EOL;
            // 一旦加载到该文件就跳出循环
            if (self::loadFile($file)) {
                $success = TRUE;
                break;
            }
        }

        if (!$success) {
            // 尝试从当前目录加载文件 如若还不成功就抛出异常
            if (!self::loadFile(__DIR__ . DIRECTORY_SEPARATOR . $fn)) {
                throw new Exception(self::UNABLE_TO_LOAD . ' ' . $class);
            }
        }

        return $success;
    }
}