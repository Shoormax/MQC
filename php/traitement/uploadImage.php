<?php

$file = $_POST['file'];
$encodedData = str_replace(' ','+',$file);
$decodedData = base64_decode($encodedData);

var_dump($decodedData);
