<?php

/**
 * get categorise
 */
error_reporting(0);
include '../lib/utilities/dump.php';
include './Categories.php';

$url = $_POST['url'];
$excludes = $_POST['excludes'];

$categorise = new Categories();

if($_GET['type'] === 'dev'){
  exit();
}

$json = $categorise->getCategories($url, explode(',', $excludes));

// dump($json);
echo json_encode($json);

