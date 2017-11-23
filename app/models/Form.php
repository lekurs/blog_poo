<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 23/11/2017
 * Time: 09:08
 */

namespace blog\app\models;


class Form
{
    private $data;
    private $options;
    public $tag = 'p';

    /**
     * Form constructor.
     * @param array $data => Tableau de données de la méthode
     */

    public function __construct($data = array())
    {
        $this->data = $data;
    }

    /**
     * @param $html => le html à afficher
     * @return string => renvoie le tag entourant la balise input
     */

    private function tags($html)
    {
        return "<{$this->tag}>{$html}</{$this->tag}>";
    }

    /**
     * @function input
     * @param $type => type d'input
     * @param $name
     * @param $placeholder
     * @param $class => optionnel, si besoin d'une classe
     *  @param $id => optionnel
     * @return string => affiche l'input
     */

    public function input($type, $name, $placeholder, $class = null, $id = null)
    {
        return $this->tags('<input type="' . $type . '" name="' . $name . '" placeholder ="' . $placeholder . '" class="'. $class .'" id="' . $id . '" />');
    }

    /**
     * @param $name
     * @param $placeholder
     * @param null $class
     * @param $id => Optionnel
     * @return string
     */

    public function area($name, $placeholder, $class = null, $id = null)
    {
        return $this->tags('<textarea name="'. $name . '" placeholder="' .$placeholder. '" class="' .$class. '" id="' . $id . '"></textarea>');
    }

    /**
     * @param $name
     * @param null $class
     * @param null $id
     * @return string
     */

    public function checkBox($name, $id = null, $class = null)
    {
        return $this->tags("<input type=\"checkbox\" name=\"$name\" id=\"$id\" class=\"$class\"  />");
    }

    /**
     * @param $name
     * @param null $class
     * @param null $id
     * @return string
     */

    public function radio($name, $id = null, $class = null)
    {
        return $this->tags("<input type=\"radio\" name=\"$name\"  id=\"$id\" class=\"$class\" />");
    }


    /**
     * @param $name
     * @param null $class
     * @param null $id
     * @return string
     */

    public function select($name, $class = null, $id = null)
    {
        return $this->tags('<select name="'. $name . '" class="' .$class. '" id="' . $id . '"><option value="">{$this->getOptions()}</option></select>');
    }

    /**
     * @return mixed
     */

    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param $options = array()
     */

    public function optSelect($options)
    {
        $this->options = $options;

    }


    /**
     * @param $name
     * @param $value
     * @param null $class
     * @return string
     */

    public function submit($name, $value, $class = null)
    {
        return $this->tags("<input type=\"submit\" name=\"$name\" value=\" $value\" class=\"$class\" />");
    }
}