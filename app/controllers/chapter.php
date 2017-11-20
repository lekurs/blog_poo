<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 10/11/2017
 * Time: 14:30
 */

use blog\app\models;



function getChapter($idChapter)
{
    $chapterOne = new blog\app\models\ChaptersManager();
    if(isset($_GET['c']) && !empty([$_GET['c']]))
    {
        $showChapter = $chapterOne->showChapter($idChapter);
        $comm = new \blog\app\models\CommentsManager();
        $comments = $comm->showComments($idChapter);
        $nbComment = $comm->nb_comment($idChapter);
    }

    require ('app/views/showChapterView.php');
}

function postNewComment($content, $user, $chapterId)
{
        $comm = new \blog\app\models\Comments(['comments' => $content, 'userId' => $user, 'chapterId' => $chapterId]);
        $newComment = new \blog\app\models\CommentsManager();
        $newComment->postComment($comm);


    header('Location: index.php?comm=add');
}
