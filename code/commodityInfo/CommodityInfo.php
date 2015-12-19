<?php

class CommodityInfo {

  private $DOM;

  public function __construct($id){

    include '../lib/phpquery/phpQuery/phpQuery.php';
    phpQuery::newDocumentFile("http://item.jd.com/{$id}.html");
    $this->DOM = pq();

  }

  /**
   * getBrand
   * @return string
   */
  public function getBrand(){

    return $this->DOM->find('[clstag="shangpin|keycount|product|mbNav-4"]')->text();
    
  }

  /**
   * getClassInfo3
   * @return array
   */
  public function getClassInfo3(){

    $DOM = $this->DOM->find('[clstag="shangpin|keycount|product|mbNav-3"]');

    $value = $DOM->text();

    $originKey = $DOM->attr('href');
    $keys = explode(',', $originKey);
    $key = $keys[count($keys) - 1];

    return ['key'=> $key, 'value'=> $value];

  }

  /**
   * getProps
   * @return array
   */
  public function getProps(){

    $returns = [];

    $DOM = $this->DOM->find('.Ptable')->html();

    foreach (pq($DOM) as $value) {
      $_title = trim(pq($value)->find('.tdTitle')->text());
      $_value = trim(pq($value)->find('td:not(.tdTitle)')->text());

      if($_title !== '' && $_value !== ''){
        array_push($returns, [
          'title'=> $_title,
          'value'=> $_value,
        ]);
      }
    }

    return $returns;

  }

}