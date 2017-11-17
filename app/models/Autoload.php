<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 17/11/2017
 * Time: 13:11
 */

namespace blog\app\models;

class Autoload
{
    static function register() {
        spl_autoload_register(array(__CLASS__, 'autoloader'));
    }

    static function autoloader($classname) {
        require ($classname. '.php');
    }
}