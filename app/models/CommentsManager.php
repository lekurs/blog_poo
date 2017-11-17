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

    public function showComments($idChapter)
    {
        $db = $this->Connect();
        $req = $db->prepare('SELECT c.id_comments AS id_comments, c.comments AS comments, c.report AS report, c.user_id AS user_id, c.chapter_id AS chapter_id, u.id_user AS id_user, u.username AS username FROM comments AS c INNER JOIN  user AS u ON c.user_id = u.id_user WHERE c.chapter_id = :idChapter');
        $req->bindValue(':idChapter', $idChapter, \PDO::PARAM_INT);
        $req->execute();
        $req->setFetchMode(\PDO::FETCH_ASSOC);

        return $req->fetchAll();

        $req->closeCursor();
    }

    public function nb_comment($chapter)
    {
        $db = $this->Connect();

        $nb_comments = $db->prepare('SELECT * FROM comments WHERE chapter_id = ' . $chapter);
        $nb_comments->execute(array($chapter));

        $count_comment = $nb_comments->rowCount();

        return $count_comment;
    }
}
