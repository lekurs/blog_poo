<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 21/11/2017
 * Time: 11:00
 */

namespace blog\app\models;
use \PDO;


class RankUserManager extends Database
{

    public function getRank()
    {
        $db = $this->Connect();
        $req = $db->prepare('SELECT * from role ORDER BY role');
        $req->execute();
        $req->setFetchMode(PDO::FETCH_CLASS, 'RankUser');

        return $req->fetchAll();
    }

}