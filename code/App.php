<?php 

// error_reporting(0);

include './lib/utilities/dump.php';
// include './lib/phpquery/phpQuery/phpQuery.php';
// include './lib/utilities/EasyCurl.php';

use \lib\utilities\EasyCurl;

function __autoload($className){
  $path = str_replace('\\', '/', $className);
  echo $path;
  // include dirname(__FILE__).'.php';
}

class App{

  public function __construct(){
    // echo 'parent';
  }

}

// EasyCurl::foo();
// echo http_build_query(['aa'=>'哈哈', 'b'=>345]);
parse_str('aa=%E5%93%88%E5%93%88&b=345', $foo);
dump($foo);