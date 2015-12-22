<?php 
set_time_limit(60);

include '../App.php';
include './Trends.php';

$id = $_POST['class'];
$url = $_POST['url'];
if($_POST['count']){
  $count = $_POST['count'];
}else{
  $count = 60;
}
if($_POST['page']){
  $page = $_POST['page'];
}else{
  $page = 5;
}


$trends = new Trends($count);

/**
 * dev mode
 */
if($_GET['type'] === 'dev'){
  dump($trends->getIdsByUrl('http://list.jd.com/list.html?cat=670%2C671%2C672&ev=11925_309146%40&page=1&JL=3_处理器_Intel i5', 5));
  exit();
}

if($id !== NULL){
  echo json_encode(['skus'=> $trends->getIds($id)]);
}else if($url !== NULL){
  echo json_encode(['skus'=> $trends->getIdsByUrl($url, $page)]);
}