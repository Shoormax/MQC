<?php

namespace Admin;


class Balise implements I_HTML {

  /** @var  String */
  protected $id;
  /** @var  String */
  protected $name;
  /** @var  String */
  protected $value;

  function __construct($name, $value = '', $id = '') {
    $this->name = $name;
  }

  /**
   * @param bool $echo
   * @return String
   */
  function html($echo) {

  }

}
