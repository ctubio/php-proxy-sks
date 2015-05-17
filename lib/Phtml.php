<?php namespace PhpProxySks;

use Symfony\Component\HttpFoundation\Response;

class Phtml {

  public static function wrapContent(Response $response = NULL, $content = NULL) {
    $response->headers->set('Content-Type', 'text/html');
    if (!is_null($content))
      $response->setContent($content);
    return $response;
  }
  
  public static function setContent(Response $response, $phtml) {
    if (!is_readable($file = realpath('../phtml'.$phtml.'.phtml')))
      $content = 'Err'.(is_numeric(basename($phtml))?'no':'or').': '.$phtml;
    else {
      $config = Config::getInstance();
      ob_start();
      include($file);
      $content = ob_get_clean();
    }
    
    if ($response)
      return self::wrapContent($response, $content);
    else return $content;
  }
}
