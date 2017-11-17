<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 10/11/2017
 * Time: 11:05
 */
//
require_once ('app/models/ChaptersManager.php');
require_once ('app/models/CommentsManager.php');

function listChapters()
{
    $Allchapters = new blog\app\models\ChaptersManager();
    $chapters = $Allchapters->showChapters();

    $comment = new blog\app\models\CommentsManager();

    require ('app/views/showChaptersView.php');
}


