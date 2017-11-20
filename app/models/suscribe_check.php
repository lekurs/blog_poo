<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 13/11/2017
 * Time: 15:48
 */

namespace blog\app\models;

require('Database.php');

if(isset($_POST['email_suscribe']) && !empty($_POST['email_suscribe'])) {

    $connect = new Database();
    $db = $connect->Connect();
    $email = htmlspecialchars(strtolower($_POST['email_suscribe']));
    $req = $db->prepare('SELECT email FROM user WHERE email = :email');
    $req->execute(array('email' => $email));

    if ($req->rowCount() > 0) {
        $status = 'error';
        $message = 'Mail déjà utilisé';
    } else {
        $status = 'success';
        $message = 'Ce mail est disponible';
    }
}
else {
    $status = 'error';
    $message = 'Veuillez tapez votre email';
}

$data = array('status' => $status, 'message' => $message);
echo json_encode($data);


