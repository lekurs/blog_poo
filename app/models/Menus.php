<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 20/11/2017
 * Time: 20:50
 */

namespace blog\app\models;


class Menus
{
    private $id_menus;
    private $menus;
    private $liens;

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

    public function idMenus()
    {
        return $this->id_menus;
    }

    public function menus()
    {
        return $this->menus;
    }

    public function lien()
    {
        return $this->liens;
    }

    public function setIdMenus($idmenu)
    {
        $idmenu = (int)$idmenu;
        if($idmenu > 0)
        {
            $this->id_menus = $idmenu;
        }
    }

    public function setMenus($menus)
    {
        if(is_string($menus))
        {
            $this->menus = $menus;
        }
    }

    public function setLien($lien)
    {
        if(is_string($lien))
        {
            $this->liens = $lien;
        }
    }
}