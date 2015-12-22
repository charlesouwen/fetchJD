<?php 

class Trends{

  private $DOM;

  public function __construct($count){
    include '../lib/phpquery/phpQuery/phpQuery.php';
    $this->count = $count;
  }



  public function getIds($id)
  {
    $ids = [];

    phpQuery::newDocumentFile("http://list.jd.com/list.html?cat={$id}&ev=exprice_M300");
    $a = pq('#plist .gl-item div[data-sku]');
    foreach ($a as $value) {
      $sku = pq($value)->attr('data-sku');
      if(strlen($sku) <= 7){
        array_push($ids, trim($sku));
      }

      if(count($ids) >= $this->count) break;
    }

    return $ids;
  }



  public function getIdsByUrl($url, $page)
  {
    $ids = [];

    $urls = parse_url("{$url}&stock=0");
    $querys = $this->_getArrayByStr($urls['query']);

    $querys['page'] = 1;

    for($i = 0; $i < $page; $i++){
      $urls['query'] = http_build_query($querys);
      $ids = array_merge($ids, $this->_getIdsByUrl($this->buildUrl($urls)));
      $querys['page'] = $i + 2;
    }

    return $ids;
  }



  /**
   * 生成url
   * @param  array
   * @return string 
   */
  private function buildUrl($array)
  {
    return "{$array['scheme']}://{$array['host']}{$array['path']}?{$array['query']}";
  }



  /**
   * 以返回值改写parse_str
   * @param  string $str
   * @return array      
   */
  private function _getArrayByStr($str)
  {
    parse_str($str, $foo);
    return $foo;
  }



  /**
   * 根据url获取skus
   * @param  string $url
   * @return array      
   */
  private function _getIdsByUrl($url)
  {
    $ids = [];
    phpQuery::newDocumentFile($url);
    $a = pq('#plist .gl-item div[data-sku]');

    foreach ($a as $value) {
      $sku = pq($value)->attr('data-sku');
      if(strlen($sku) <= 7){
        array_push($ids, trim($sku));
      }
      if(count($ids) >= $this->count) break;
    }

    return $ids;
  }






}