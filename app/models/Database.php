<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 16/11/2017
 * Time: 15:29
 */

namespace blog\app\models;
use blog\app\Config;
use \PDO;
require_once ('Config.php');

class Database extends Config
{
    public function Connect()
    {
        $db = new \PDO('mysql:host=' . $this->host . '; dbname=' . $this->dbname.'; charset=utf8', $this->user, $this->password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        return $db;
        throw new \Exception('erreur');
    }
}