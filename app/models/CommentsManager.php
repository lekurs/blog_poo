<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 16/11/2017
 * Time: 11:36
 */

namespace blog\app\models;

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
     * @param $idComments
     * @return array
     */

    public function showComment($idComments)
    {
        $db = $this->Connect();
        $req = $db->prepare(' SELECT id_comments AS idComments, comments, report FROM comments WHERE id_comments =:idComm');
        $req->bindValue('idComm', $idComments, \PDO::PARAM_INT);
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

    /**
     * @return int
     */

    public function countReportTotal()
    {
        $db = $this->Connect();
        $req = $db->prepare('SELECT ch.id_chapter AS idChapter,  comm.chapter_id AS chapterId, ch.title AS title FROM comments comm INNER JOIN chapter ch ON ch.id_chapter = comm.chapter_id WHERE comm.report = 1');
        $req->execute();

        return $req->rowCount();
    }

    /**
     * @param Comments $comments
     */

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

    /**
     * @param $idChapter
     * @return int
     */

    public function countReportByChapter($idChapter)
    {
        $db = $this->Connect();

        $req = $db->prepare('SELECT * FROM comments WHERE chapter_id = :idChapter');
        $req->bindValue('idChapter', $idChapter, \PDO::PARAM_INT);
        $req->execute();

        return $req->rowCount();
    }

    /**
     * @return int
     */

    public function countAllReport()
    {
        $db = $this->Connect();

        $req = $db->prepare('SELECT * FROM comments WHERE report = 1');
        $req->execute();

        return $req->rowCount();
    }

    /**
     * @param Chapters $chapter
     * @return array
     */

    public function getReportByChapter()
    {
        $db = $this->Connect();
        $req = $db->prepare('SELECT ch.id_chapter AS idChapter,  comm.chapter_id AS chapterId, comm.id_comments AS idComments, ch.title AS title, comm.comments, comm.user_id, comm.report FROM comments comm INNER JOIN chapter ch ON ch.id_chapter = comm.chapter_id WHERE comm.report = 1 ORDER BY  comm.chapter_id');
        $req->execute();
        $req->setFetchMode(\PDO::FETCH_CLASS, 'Comments');

        return $req->fetchAll();
    }

    public function updateComment(Comments $comments)
    {
        $db = $this->Connect();
        $req = $db->prepare('UPDATE comments SET comments = :comment, report = 0 WHERE id_comments = :idComment');
        $req->bindValue('comment', $comments->comments(), \PDO::PARAM_STR);
        $req->bindValue('idComment', $comments->idComments(), \PDO::PARAM_INT);
        $req->execute();

        $req->closeCursor();
    }

    public function delComment(Comments $comments)
    {
        $db = $this->Connect();
        $req = $db->prepare('DELETE FROM comments WHERE id_comments = :idComment');
        $req->bindValue('idComment', $comments->idComments(), \PDO::PARAM_INT);
        $req->execute();

        $req->closeCursor();
    }
}
