<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 20/11/2017
 * Time: 09:55
 */

use blog\app\models;

function login($email, $password)
{
    $userManager = new \blog\app\models\UserManager();
    $users = $userManager->login($email, $password);

    foreach ($users as $newUser) {
        $user = new \blog\app\models\User($newUser);

        if (password_verify($password, $user->password())) {
            session_start();
            $_SESSION['login'] = $user->username();
            $_SESSION['email'] = $user->email();
            $_SESSION['id'] = $user->idUser();
            $_SESSION['rank'] = $user->role();

            setcookie('login', $_SESSION['email'], time() + 365 * 24 * 3600, null, null, false, true);


            header('Location: index.php');
        }
    }
}

function logOut()
{
    session_destroy();
    header('Location: index.php?dc=ok');
}

function suscribe($username, $password, $email, $role)
{
    $user = new \blog\app\models\User(['username'=>$username, 'password'=>$password, 'email' => $email, 'role' => $role]);
    $userManager = new \blog\app\models\UserManager();
    $userManager->inscription($user);

    header('Location: index.php?adduser=ok');
}