<?php
/*
Plugin Name: Frontendisti - WordPress React
Plugin URI: https://www.mejta.net/
Description: Showcase of how to use React in WordPress website
Version: 1.0.0
Author: Daniel Mejta
Author URI: https://www.mejta.net/
Text Domain: wpreact
Domain Path: /languages
*/

use WPReact\App;

include_once __DIR__ . '/vendor/autoload.php';

function wpreact() {
  static $app;

  if (!$app) {
    $app = new App(plugin_dir_url(__FILE__), __DIR__);
  }

  return $app;
}

function wpreact_run() {
  wpreact()->setup();
}

add_action('plugins_loaded', 'wpreact_run', 11);
