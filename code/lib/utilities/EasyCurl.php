<?php
class EasyCurl{

  private $cookieFile;
  
  public function __construct(){
  }
  /**
   * request
   * @param  string  $config['url']*
   * @param  string  $config['data'] = false
   * @param  boolean $config['cookie'] = false
   * @param  boolean $config['location'] = true
   * @param  array   $config['headers'] = false
   * @return string
   */
  public function request($config){
    $ch = curl_init();
    // target address
    if(is_array($config)){
      curl_setopt($ch, CURLOPT_URL, $config['url']);
    }else{
      curl_setopt($ch, CURLOPT_URL, $config);
    }
    // post data
    if($config['data']){
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $config['data']);
    }
    // send cookie
    if($config['cookie']){
      curl_setopt($ch, CURLOPT_COOKIEFILE, $this->cookieFile);
    }
    // header
    if (!$config['headers']) {
      $headers = array(
        "Content-type: text/xml;charset=utf-8",
        "Accept: text/html, application/xml;q=0.9, application/xhtml+xml, image/png, image/webp, image/jpeg, image/gif, image/x-xbitmap, */*;q=0.1",
        "Cache-Control: no-cache",
        "Pragma: no-cache",
        "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.80 Safari/537.36",
      );
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    }else{
      curl_setopt($ch, CURLOPT_HTTPHEADER, $config['headers']);
    }
    // flow output
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //  auto set referer
    curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
    
    // location
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, $config['location'] ? $config['location'] : 1);
    // about ssl
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    
    // exec
    $r = curl_exec($ch);
    curl_close($ch);
    return $r;
  }
  /**
   * saveCookie
   * @param  $cookie['dir']*
   * @param  $cookie['url']*
   * @param  $cookie['data']*
   * @return null
   */
  public function saveCookie($config){
    $cookieFile = tempnam($config['dir'], 'cookie');
    $this->cookieFile = $cookieFile; 
    $ch = curl_init();
    // save cookie
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);
    // target address
    curl_setopt($ch, CURLOPT_URL, $config['url']);
    // data
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $config['data']);
    // flow output
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_exec($ch);
    curl_close($ch);
  }

}