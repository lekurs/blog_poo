<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 21/11/2017
 * Time: 10:57
 */

namespace blog\app\models;


class RankUsers
{
    private $id;
    private $role;

    public function __construct(array $datas)
    {
        $this->hydrate($datas);
    }

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

    public function id()
    {
        return $this->id;
    }

    public function role()
    {
        return $this->role;
    }

    public function setId($id)
    {
        $id = (int)$id;
        if($id>0)
        {
            $this->id = $id;
        }
    }

    public function setRole($role)
    {
        if(is_string($role))
        {
            $this->role = $role;
        }
    }

}