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
     * @return array
     */

    public function login($email)
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
     * @param User $user
     */

    public function inscription(User $user)
    {
          $db = $this->Connect();
          $req = $db->prepare('INSERT INTO user (username, password, email, role) VALUES (:username, :password, :email, :role)');
          $req->bindValue('username', $user->username(), \PDO::PARAM_STR);
          $req->bindValue('password', $user->password(), \PDO::PARAM_STR);
          $req->bindValue('email', $user->email(), \PDO::PARAM_STR);
          $req->bindValue('role', $user->role(), \PDO::PARAM_INT);
          $req->execute();

          $req->closeCursor();
    }

    /**
     * @return int
     */

    public function getMaxUsers()
    {
        $db = $this->Connect();
        $req = $db->prepare('SELECT * FROM user');
        $req->execute();

        return $req->rowCount();
    }

    /**
     * @return array
     */

    public function getLastUser()
    {
        $db = $this->Connect();
        $req = $db->prepare('SELECT * FROM user ORDER BY id_user DESC LIMIT 0,1');
        $req->execute();
        $req->setFetchMode(\PDO::FETCH_CLASS, 'User');
        return $req->fetchAll();
    }
}