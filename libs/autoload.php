<?php
include 'libs/config.php';

function my_autoload($file) {
  global $dirs;
  foreach($dirs as $dir) {
    if (file_exists($dir . $file . '.php')){
      include $dir . $file . '.php';
    }
  }
}

spl_autoload_register("my_autoload");
