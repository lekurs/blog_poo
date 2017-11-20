<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 16/11/2017
 * Time: 11:36
 */

namespace blog\app\models;

require_once ('app/models/Database.php');

class CommentsManager extends Database
{

    /**
     * @param $idChapter
     * @return array
     */

    public function showComments($idChapter)
    {
        $db = $this->Connect();
        $req = $db->prepare('SELECT c.id_comments AS idComments, c.comments AS comments, c.report AS report, c.user_id AS userId, c.chapter_id AS chapterId, u.username AS username FROM comments AS c INNER JOIN  user AS u ON c.user_id = u.id_user WHERE c.chapter_id = :idChapter');
        $req->bindValue(':idChapter', $idChapter, \PDO::PARAM_INT);
        $req->execute();
        $req->setFetchMode(\PDO::FETCH_CLASS, 'Comments');

        return $req->fetchAll();
    }

    /**
     * @param $chapter
     * @return int
     */

    public function nb_comment($chapter)
    {
        $db = $this->Connect();
        $req= $db->prepare('SELECT id_comments AS idComments, comments AS comments, report AS report, user_id AS userId, chapter_id AS chapterId FROM comments WHERE chapter_id = ' . $chapter);
        $req->execute(array($chapter));

        return $req->rowCount();
    }

    public function countReportTotal()
    {
        $db = $this->Connect();
        $req = $db->prepare('SELECT ch.id_chapter AS idChapter,  comm.chapter_id AS chapterId, ch.title AS title FROM comments comm INNER JOIN chapter ch ON ch.id_chapter = comm.chapter_id WHERE comm.report = 1');
        $req->execute();

        return $req->rowCount();
    }

    public function postComment(Comments $comments)
    {
        $db = $this->Connect();
        $req = $db->prepare('INSERT INTO comments (comments, user_id, chapter_id) VALUES (:comments, :userId, :chapterId)');
        $req->bindValue('comments', $comments->comments(), \PDO::PARAM_STR);
        $req->bindValue('userId', $comments->userId(), \PDO::PARAM_INT);
        $req->bindValue('chapterId', $comments->chapterId(), \PDO::PARAM_INT);
        $req->execute();
        $req->setFetchMode(\PDO::FETCH_CLASS, 'Comments');
    }

    public function countReportByChapter($idChapter)
    {
        $db = $this->Connect();

        $req = $db->prepare('SELECT * FROM comments WHERE chapter_id = :idChapter');
        $req->bindValue('idChapter', $idChapter, \PDO::PARAM_INT);
        $req->execute();

        return $req->rowCount();
    }

    public function countAllReport()
    {
        $db = $this->Connect();

        $req = $db->prepare('SELECT * FROM comments WHERE report = 1');
        $req->execute();

        return $req->rowCount();
    }
}
