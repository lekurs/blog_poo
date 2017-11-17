<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 16/11/2017
 * Time: 09:43
 */

namespace blog\app\models;

require_once ('Database.php');

/**
 * Class Chapters_Models
 * Gère les chapitres du blog
 *
 * */

 class ChaptersManager extends Database
{
     /**
      * @return array
      */

    public function showChapters()
    {
        $db = $this->Connect();
        $req = $db->prepare('SELECT id_chapter as idChapter, title, chapter, DATE_FORMAT(create_date, \'%d/%M/%Y\') AS create_date, online FROM chapter where online = 1');
        $req->execute();
        $req->setFetchMode(\PDO::FETCH_CLASS, 'Chapters');

        return $req->fetchAll();
    }

     /**
      * @param $idChapter
      * @return \PDOStatement
      */

     public function showChapter($idChapter)
     {
         $db = $this->Connect();
         $req = $db->prepare('SELECT id_chapter, title, chapter, DATE_FORMAT(create_date, \'%d/%M/%Y\') AS date_creation FROM chapter WHERE id_chapter = :idChapter');
         $req->bindValue(':idChapter', $idChapter, \PDO::PARAM_INT);
         $req->execute();
         $req->setFetchMode(\PDO::FETCH_OBJ);

         return $req->fetchAll();
     }

     /**
      * @return \PDOStatement                                   =>count of chapters
      */

     public function countChapter()
     {
         $db = $this->Connect();
         $req = $db->prepare('SELECT id_chapter, title, chapter, DATE_FORMAT(create_date, \'%d/%m/%Y\') AS date_creation FROM chapter where online = 1');
         $req->execute([]);
         $req->rowCount();

         return $req;
     }

     /**
      * @param Chapters $chapter
      */
     public function addChapter(Chapters $chapter)
     {
         $db = $this->Connect();
         $req = $db->prepare('INSERT INTO chapter (title, chapter, create_date, online) VALUES (:title, :chapter, NOW(), :online)');
         $req->bindValue(':title', $chapter->title(), \PDO::PARAM_STR);
         $req->bindValue(':chapter', $chapter->chapter(), \PDO::PARAM_STR);
         $req->bindValue(':online', $chapter->online(), \PDO::PARAM_INT);

         $req->execute();

         $req->closeCursor();
     }

     /**
      * @param Chapters $chapters
      */

     public function delChapter(Chapters $chapters)
     {
         $db = $this->Connect();
         $req = $db->prepare('DELETE FROM chapter WHERE id_chapter = :chapter');
         $req->execute(array(':chapter' => $chapters->idChapter()));

         $req->closeCursor();
     }

     /**
      * @return mixed
      */

     public function chapterOffline()
     {
         $req = $db->prepare('SELECT id_chapter, title, chapter, DATE_FORMAT(create_date, \'%d/%m/%Y\') AS date_creation FROM chapter where online = 0');
         $req->execute([]);
         $req = $req->fetch(\PDO::FETCH_ASSOC);

         return $req;
     }

     /**
      * @param Chapters $chapter
      */

     public function updateChapter(Chapters $chapter)
     {
         $db = $this->Connect();
         $req = $db->prepare('UPDATE chapter SET title = :title, chapter = :chapter, create_date =NOW(), online = :online WHERE id_chapter = :chapterId');
         $req->bindValue(':title', $chapter->chapter(), \PDO::PARAM_STR);
         $req->bindValue(':chapter', $chapter->chapter(), \PDO::PARAM_STR);
         $req->bindValue(':online', $chapter->online(), \PDO::PARAM_INT);
         $req->bindValue('chapterId', $chapter->idChapter(), \PDO::PARAM_INT);
         $req->execute();

         $req->closeCursor();
     }
}