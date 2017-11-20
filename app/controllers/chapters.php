<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 10/11/2017
 * Time: 11:05
 */

use blog\app\models;

function listChapters()
{
    $chapterManager = new blog\app\models\ChaptersManager();
   $chapters = $chapterManager->showChapters();

    $commentManager = new blog\app\models\CommentsManager();


    require ('app/views/showChaptersView.php');
}


