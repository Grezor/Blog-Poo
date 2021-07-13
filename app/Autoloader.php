<?php 
namespace App;

class Autoloader {
    
    /**
     * Enregistre notre autoloader
     *
     */
    static function register(){
        spl_autoload_register([
            __CLASS__, 'autoload'
        ]);
    }
 
    /**
     * autoload
     *
     * @param  string $class_name
     */
    static function autoload($class){
        if (strpos($class, __NAMESPACE__ . '\\') === 0) {
            $class = str_replace(__NAMESPACE__ .'\\', '', $class);
            $class = str_replace('\\', '/', $class);
            require __DIR__ . '/'. $class . '.php';
        }
    }
}