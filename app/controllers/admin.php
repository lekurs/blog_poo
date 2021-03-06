<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 12/11/2017
 * Time: 13:42
 */

use \blog\app\models;

function adminIndex()
{
    $menuManager = new \blog\app\models\MenusManager();
    $menu = $menuManager->getMenus();
    $chapterManager = new \blog\app\models\ChaptersManager();
    $chapters = $chapterManager->showChapters();

    $commentManager = new models\CommentsManager();

    $chapterOffline = $chapterManager->chapterOffline();

    $countChapter = $chapterManager->countChapter();
    $reportComments = $commentManager->countAllReport();

    $userManager = new models\UserManager();
    $lastUser = $userManager->getLastUser();

    require ('app/views/adminView.php');
}

function adminReport()
{
    $menuManager = new \blog\app\models\MenusManager();
    $menu = $menuManager->getMenus();

    $commentsManager = new models\CommentsManager();
    $countReport = $commentsManager->countReportTotal();
    $report = $commentsManager->getReportByChapter();
//    $report = $commentsManager->getReportByChapter();

//    $report = getAllReportByChapter();
//    $getReports = countReportTotal();

    require ('app/views/adminReportView.php');
}

function adminDelComm($comm)
{
    if(isset($_GET['comm']) && !empty($_GET['comm']))
    {
        $comm = htmlspecialchars($_GET['comm']);
        $commentsManager = new models\CommentsManager();
        $comment = new models\Comments(['idComments'=>$comm]);

        $delete = $commentsManager->delComment($comment);

        header('Location: index.php?action=admin&del='.$comm);
    }
}

function adminPostChapter()
{
    $menuManager = new \blog\app\models\MenusManager();
    $menu = $menuManager->getMenus();

    $commentManager = new models\CommentsManager();
    $reportComments = $commentManager->countAllReport();

    require ('app/views/adminPostView.php');
}

function postNewChapter($title, $content, $online)
{
    $chapter = new models\Chapters(['title' =>$title, 'chapter' => $content, 'online' => $online]);
    $chapterManager = new models\ChaptersManager();
    $chapterManager->addChapter($chapter);

    header('Location:index.php?action=admin');
}

function updateChapter($chapterId)
{
    $menuManager = new \blog\app\models\MenusManager();
    $menu = $menuManager->getMenus();

    $chapterManager = new models\ChaptersManager();
    $chap = $chapterManager->showChapter($chapterId);

    $commentsManager = new models\CommentsManager();
    $report = $commentsManager->countReportTotal();
    require ('app/views/adminUpdateChapterView.php');
}

function adminUpdateChapter($chapterId, $title, $online, $chapter)
{
    $upChap = new blog\app\models\Chapters(['idChapter' => $chapterId, 'title' => $title, 'online' => $online, 'chapter' => $chapter]);

    $chapterManager = new blog\app\models\ChaptersManager();
    $update = $chapterManager->updateChapter($upChap);

    header('Location: admin.php');
}

function adminDelChapter($chapterId)
{
    $delChap = new models\Chapters(['idChapter' => $chapterId]);
    $chapterManager = new models\ChaptersManager();
    $del = $chapterManager->delChapter($delChap);

}

function adminUpdateComment($idComment, $comment)
{
    $commentUpdated = new models\Comments(['idComments' => $idComment, 'comments' => $comment]);
    $commentManager = new models\CommentsManager();
    $updateComment = $commentManager->updateComment($commentUpdated);
}

function adminGetComment($idComments)
{
    $menuManager = new \blog\app\models\MenusManager();
    $menu = $menuManager->getMenus();

    $commentsManager = new models\CommentsManager();
    $comment = $commentsManager->showComment($idComments);

    if(isset($_POST['comments_area']) && !empty($_POST['comments_area']))
    {
        $idComment = htmlspecialchars($_GET['comm']);
        $comment = htmlspecialchars($_POST['comments_area']);
        adminUpdateComment($idComment, $comment);

    }

    require('app/views/adminUpdateReportView.php');
}