<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 20/11/2017
 * Time: 20:54
 */

namespace blog\app\models;
use \PDO;

require_once 'Database.php';

class MenusManager extends Database
{
    public function getMenus()
    {
        $db = $this->Connect();

        $req = $db->prepare('SELECT * FROM menus');
        $req->execute();
        $req->setFetchMode(PDO::FETCH_CLASS, 'Menus');
        return $req->fetchAll();
    }

    public function addMenus(Menus $menus)
    {
        $db = $this->Connect();

        $req = $db->prepare('INSERT INTO menus (menus, lien) VALUES (:menus, :lien)');
        $req->bindValue('menus', $menus->menus(), PDO::PARAM_STR);
        $req->bindValue('lien', $menus->lien(), PDO::PARAM_STR);
        $req->execute();

        $req->closeCursor();
    }


}