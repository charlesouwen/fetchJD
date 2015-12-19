<?php

/**
 * get class brands 
 */
error_reporting(0);
include '../lib/utilities/dump.php';
include './CommodityInfo.php';

$id = $_GET['id'];

$CommodityInfo = new CommodityInfo($id);

if($_GET['type'] === 'dev'){
  dump($CommodityInfo->getProps2());
  exit();
}

echo json_encode([
  'brand'=> $CommodityInfo->getBrand(),
  'classInfo'=> $CommodityInfo->getClassInfo3(),
  'props'=> $CommodityInfo->getProps()
]);