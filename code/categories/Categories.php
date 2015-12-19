<?php 

include '../lib/phpquery/phpQuery/phpQuery.php';

class Categories
{

  private $DOM;
  private $conut;

  public function getCategories($url, $excludes = [])
  {

    $categories = [];

    phpQuery::newDocumentFile($url);

    $title = pq('#J_selector [clstag="thirdtype|keycount|thirdtype|select"] b')->text();

    $itemDOM = pq('#J_selector .sl-wrap');

    foreach ($itemDOM as $value) {
      $key = trim(str_replace('：', '', pq($value)->find('.sl-key span')->text()));

      if(in_array($key, $excludes)) continue;

      if($key !== '品牌'){
        $names = $this->getNames($value, 100);
      }else{
        $names = $this->getNames($value, 24);
      }
      
      array_push($categories, ['key'=> $key, 'values'=> $names]);
    }

    // dump($categories);
    return $categories;

  }

  private function getNames($item, $length)
  {
    $names = [];

    $aDOM = pq($item)->find('.sl-value a');
    foreach ($aDOM as $value) {
      $href = pq($value)->attr('href');
      $name = str_replace('<i></i>', '', pq($value)->text());
      if(strpos($name, '确定') === false && strpos($name, '取消') === false){
        array_push($names, ['key'=> $href, 'value'=> $name]);
      }
      if(count($names) >= $length) break;
    }

    return $names;
  }

}