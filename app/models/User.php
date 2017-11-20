<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 20/11/2017
 * Time: 09:26
 */

namespace blog\app\models;


class User
{
    /**
     * Gestion des Utilisateurs
     * @var idUser
     * @var username
     * @var password
     * @var email
     * @var role
     */
    private $idUser;
    private $username;
    private $password;
    private $email;
    private $role;

    public function __construct(array $datas)
    {
        $this->hydrate($datas);
    }

    public function hydrate(array $datas)
    {
        foreach ($datas as $key => $data)
        {
            $method = 'set'.ucfirst($key);

            if(method_exists($this, $method))
            {
                $this->$method($data);
            }
        }
    }

    /**
     * @return mixed
     */

    public function idUser()
    {
        return $this->idUser;
    }

    /**
     * @return mixed
     */

    public function password()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */

    public function username()
    {
        return $this->username;
    }

    /**
     * @return mixed
     */

    public function email()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */

    public function role()
    {
        return $this->role;
    }

    /**
     * @param $idUser
     */

    public function setIdUser($idUser)
    {
        $idUser = (int)$idUser;

        if($idUser > 0)
        {
            $this->idUser = $idUser;
        }
    }

    /**
     * @param $password
     */

    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @param $username
     */

    public function setUsername($username)
    {
        if(is_string($username))
        {
            $this->username = $username;
        }
    }

    /**
     * @param $email
     */

    public function setEmail($email)
    {
        if(is_string($email))
        {
            $this->email = $email;
        }
    }

    /**
     * @param $role
     */

    public function setRole($role)
    {
        $this->role = $role;
    }
}