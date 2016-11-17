<?php

/**
 * Created by PhpStorm.
 * User: Shosho
 * Date: 16/11/2016
 * Time: 01:28
 */
include_once 'php/include/init.php';
require_once 'php/classes/CommunTable.php';

class Type_Mouvement extends CommunTable
{
    /**
     * @var int
     */
    private $id_type_mouvement;

    /**
     * @var string
     */
    private $libelle;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id_type_mouvement;
    }

    /**
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }


}