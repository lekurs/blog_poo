<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 10/11/2017
 * Time: 14:30
 */

require ('app/models/ChaptersManager.php');

function getChapter($idChapter)
{
    $chapterOne = new blog\app\models\ChaptersManager();
    if(isset($_GET['c']) && !empty([$_GET['c']]))
    {
        $showChapter = $chapterOne->showChapter($idChapter);

        $comment = new \blog\app\models\CommentsManager();
        $nbComment = $comment->nb_comment($idChapter);
        $comments = $comment->showComments($idChapter);//false
    }

//    $chapter->nb_comment($idChapter);

//    $comment = blog\app\models\Comments_Models();
//
//    $comment->getComments($idChapter);
//    $getReports = countReportTotal();

    require ('app/views/showChapterView.php');
}

function postNewComment($content, $user, $chapterId)
{
    $newComment = postComm($content, $user, $chapterId);
    header('Location: index.php?admin');
}
