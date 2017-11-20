<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 20/11/2017
 * Time: 09:55
 */

require_once ('app/models/User.php');
require_once ('app/models/UserManager.php');

function login($email, $password)
{
    $userManager = new \blog\app\models\UserManager();
    $userManager->login($email, $password);

    header('Location: index.php?action=login&log=ok');
}