<?php

/**
 * get categorise
 */

include '../App.php';
include './Categories.php';

$url = $_POST['url'];
$excludes = $_POST['excludes'];

$categorise = new Categories();

if($_GET['type'] === 'dev'){
  $json = $categorise->getCategories('http://list.jd.com/list.html?cat=670%2C671%2C672&ev=&page=1');
  dump($json);
  exit();
}

$json = $categorise->getCategories($url, explode(',', $excludes));

// dump($json);
echo json_encode($json);

