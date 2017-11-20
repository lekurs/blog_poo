<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 20/11/2017
 * Time: 09:36
 */

namespace blog\app\models;

require_once ('Database.php');

/**
 * Gestion des utilisateurs BDD
 * */
class UserManager extends Database
{
    /**
     * @param $email
     * @param $password
     */
    function login($email)
    {
        $db = $this->Connect();

        $req = $db->prepare('SELECT id_user AS idUser, username AS username, password AS password, email AS email, role as role FROM user WHERE email = :email');
        $req->bindValue('email', $email, \PDO::PARAM_STR);
        $req->execute();

        if($req->rowCount() != 0)
        {
            $req->setFetchMode(\PDO::FETCH_CLASS, 'User');
            return $req->fetchAll();
        }
    }

    /**
     * @param $username
     * @param $password
     * @param $email
     * @param $role
     * @return array
     */

    function inscription($username, $password, $email, $role)
    {
      $db = $this->Connect();
      $req = $db->prepare('INSERT INTO user (username, password, email, role) VALUES (:username, :password, :email, :role)');
      $req->bindValue('username', $username, \PDO::PARAM_STR);
      $req->bindValue('password', $password, \PDO::PARAM_STR);
      $req->bindValue('email', $email, \PDO::PARAM_STR);
      $req->bindValue('role', $role, \PDO::PARAM_INT);
      $req->execute();

      return $req;
    }

    /**
     * @return int
     */

    function getMaxUsers()
    {
        $db = $this->Connect();
        $req = $db->prepare('SELECT * FROM user');
        $req->execute();

        return $req->rowCount();
    }


}