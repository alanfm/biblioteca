<?php

class App {
  public static function getMenu($menu) {
    if (isset($_GET['url'])) {
      return (strtolower(explode('/', $_GET['url'])[0]) == $menu)? true: false;
    }
  }

  public static function redirect($url) {
    header('Location: '.BASE_SITE.$url);
  }

  public static function run($url) {
    if (!empty($url) && strtolower($url) != "home") {
      $url = explode("/", $url);

      $class = ucfirst(strtolower($url[0]));

      if (count($url) > 1) {
        $method = $url[1]? strtolower($url[1]): null;

        if (count($url) > 2) {
          $param = $url[2]? $url[2]: null;
        }
      }

      if (file_exists(DIR_CONTROLLER . $class . '.php')) {
        $obj = new $class;

        if (isset($method) && method_exists($obj, $method)) {
          if (isset($param)) {
            $obj->$method($param);
          } else {
            $obj->$method();
          }
        } else if (isset($method)) {
          include DIR_BASE . 'app/view/erro500.php';
        }
      
        $obj->show();

      } else {
        include DIR_BASE . 'app/view/erro500.php';
      }
    } else {
      $obj = new Home();
      $obj->show();
    }
  }
}