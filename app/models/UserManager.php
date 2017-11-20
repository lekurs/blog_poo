<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 20/11/2017
 * Time: 09:36
 */

namespace blog\app\models;

require_once ('app/models/Database.php');

/**
 * Gestion des utilisateurs BDD
 * */
class UserManager extends Database
{
    /**
     * @param $email
     * @param $password
     */
    function login($email, $password)
    {
        $db = $this->Connect();

        $req = $db->prepare('SELECT id_user AS idUser, username AS username, password AS password, email AS email, role as role FROM user WHERE email = :email');
        $req->bindValue('email', $email, \PDO::PARAM_STR);
        $req->execute();

        if($req->rowCount() != 0)
        {
            $req->setFetchMode(\PDO::FETCH_CLASS, 'User');
            $passDB = $req->password;

            if(password_verify($password, $passDB))
            {
                session_start();
                $_SESSION['login'] = $log['username'];
                $_SESSION['email']= $log['email'];
                $_SESSION['id'] = $log['id_user'];
                $_SESSION['rank'] = $log['role'];

                setcookie('login', $_SESSION['email'], time() + 365*24*3600, null, null, false, true);
            }
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

      $req->setFetchMode(\PDO::FETCH_CLASS, 'User');

      return $req->fetchAll();
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