<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 17/11/2017
 * Time: 15:53
 */

namespace blog\app\models;


class Comments
{
    /**
     * @var idComments
     * @var $comment
     * @var $report
     * @var userId
     * @var chapterId
     */
    private $idComments;
    private $comments;
    private $report;
    private $userId;
    private $chapter_id;
    private $username;

    public function __construct(array $datas)
    {
        $this->hydrate($datas);
    }

    /**
     * @param array $datas
     */

    public function hydrate(array $datas)
    {
        foreach ($datas as $key => $data)
        {
            $method = 'set'.ucfirst($key);

            if(method_exists($this, $method))
            {
                $this->$method($data);
            }
        }
    }

    /**
     * @return mixed
     */

    public function idComments()
    {
        return $this->idComments;
    }

    /**
     * @return mixed
     */

    public function comments()
    {
        return $this->comments;
    }

    /**
     * @return mixed
     */

    public function report()
    {
        return $this->report;
    }

    /**
     * @return mixed
     */

    public function userId()
    {
        return $this->userId;
    }

    /**
     * @return mixed
     */

    public function chapterId()
    {
        return $this->chapter_id;
    }

    public function username()
    {
        return $this->username;
    }

    /**
     * @param $idComments
     */

    public  function setIdComments($idComments)
    {
        $idComments = (int) $idComments;

        if($idComments > 0)
        {
            $this->idComments = $idComments;
        }
    }

    /**
     * @param $comments
     */

    public function setComments($comments)
    {
        if(is_string($comments))
        {
            $this->comments = $comments;
        }
    }

    /**
     * @param $report
     */

    public function setReport($report)
    {
        $report = (int) $report;

        $this->report = $report;
    }

    /**
     * @param $userId
     */

    public function setUserId($userId)
    {
        $userId = (int) $userId;
        if($userId > 0)
        {
            $this->userId = $userId;
        }
    }

    public function setUsername($username)
    {
        if(is_string($username))
        {
            $this->username = $username;
        }
    }

    public function setChapterId($chapterId)
    {
        $chapterId = (int)$chapterId;
        {
            if($chapterId>0)
            {
                $this->chapter_id = $chapterId;
            }
        }
    }
}