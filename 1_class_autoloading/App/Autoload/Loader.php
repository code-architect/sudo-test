<?php

namespace App\Autoload;

class Loader {

    const UNABLE_TO_LOAD = "Unable to load class";

    // Array of directories
    protected static $dirs = [];
    protected static $registered = 0;

    /**
     * 5th
     * At this point we can declare construct which calls self::init
     * Loader constructor.
     * @param array $dirs
     */
    public function __construct(array $dirs = array()){
        self::init($dirs);
    }

    /**
     * 3rd
     * We need a method that can add more directories to our list of directories to test
     * in this function notice if value provided is an array, array merge is used otherwise we just add $dirs string to
     * self::$dirs array
     * @param $dirs
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
     * 4th
     * We need to register out autoload method as a standard php library spl autoloader
     * @param array $dirs
     */
    public static function init($dirs = array())
    {
        if ($dirs) {
            self::addDirs($dirs);
        }
        if (self::$registered == 0) {
            spl_autoload_register(__CLASS__ . '::autoload');
            self::$registered++;
        }
    }

    /**
     * 2nd
     * Drives a file-name by converting the php namespace separator \ into the directory separator
     * appropriate for the server. Next the method loops through an array of directories calls $dirs
     * using each directory as a starting point for the derive file name, if not successful as a last resort
     * The method attempts to load the file from the current directory. And even that is not successful it throws an exception
     * @param $class
     * @return bool
     * @throws \Exception
     */
    public static function autoload($class)
    {
        $success = FALSE;
        $fn = str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
        foreach (self::$dirs as $start) {
            $file = $start . DIRECTORY_SEPARATOR . $fn;
            if (self::loadFile($file)) {
                $success = TRUE;
                break;
            }
        }
        if (!$success) {
            if (!self::loadFile(__DIR__ . DIRECTORY_SEPARATOR . $fn)) {
                throw new \Exception(self::UNABLE_TO_LOAD . ' ' . $class);
            }
        }
        return $success;
    }


    /**
     * 1st
     * Check file before running require once, the reason for this is if the file is not found it would generate a fetal error
     * that cannot be caught by php's new error handling capabilities.
     * @param $file
     * @return bool
     */
    protected static function loadFile($file)
    {
        if(file_exists($file)){
            require_once $file;
            return true;
        }
        return false;
    }
}
