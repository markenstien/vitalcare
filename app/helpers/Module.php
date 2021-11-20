<?php   

    class Module
    {

        private static $modules = null;

        public static function get($moduleName)
        {
            if(self::$modules == null) 
            {
                self::$modules = require_once APPROOT.DS.'modules'.DS.'all.php';
            }
            
            return self::$modules[$moduleName];
        }
        public static function all()
        {
            if(self::$modules == null) 
            {
                $modules = require_once APPROOT.DS.'modules'.DS.'all.php';
            }
            
            return $modules;
        }

        
    }