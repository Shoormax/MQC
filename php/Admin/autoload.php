<?php

namespace Admin;

function __autoload($classname) {
  $filename = "./". $classname .".php";
  include_once($filename);
}


