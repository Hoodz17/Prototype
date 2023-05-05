<?php
  // Polyfills
if (!function_exists('str_contains')) {
    function str_contains($haystack, $needle) {
        return $needle !== '' && mb_strpos($haystack, $needle) !== false;
    }
}
  // Require libraries from folder libraries
  require_once 'libraries/Core.php';
  require_once 'libraries/Controller.php';
  require_once 'libraries/Database.php';
  require_once 'libraries/Helper.php';
  require_once 'libraries/RandomGenerator.php';
  require_once 'config/config.php';

  // Maak een instantie van de Core class
  $init = new Core();
