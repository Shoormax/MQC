<?php
/**
 * Created by PhpStorm.
 * User: Shosho
 * Date: 15/11/2016
 * Time: 20:59
 */

require_once 'classes/Produit.php';
$p = Produit::rechercheParId('Produit', 1);
$p->entreeStock(2);
$p->update();