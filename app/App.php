<?php

namespace WPReact;

use WPReact\AppApi;
use Exception;

class App {
  private $publicUrl;
  private $baseDir;
  private $api;


  public function __construct(string $publicUrl, string $baseDir)
  {
    $this->publicUrl = $publicUrl;
    $this->baseDir = $baseDir;
    $this->api = new AppApi();
  }


  /**
   * Inicializes the plugin
   */
  public function setup()
  {
    add_action('wp_enqueue_scripts', [$this, 'enqueueReact']);
    add_action('wp_enqueue_scripts', [$this, 'enqueueStyles']);

    // Render root element somewhere on the page
    add_action('wp_footer', [$this, 'renderAppRoot']);
  }


  /**
   * Enqueue styles
   */
  public function enqueueStyles()
  {
    wp_enqueue_style('wpreact-styles', $this->asset('styles.css'));
  }


  /**
   * Enqueue the assets for the React application
   */
  public function enqueueReact()
  {

    // Enqueue vendor first (that is a dependency for the main application)
    wp_enqueue_script('wpreact-vendor', $this->asset('vendors~app.js'), [], false, true);

    // Enqueue the main file of the application. State all the dependencies including React, i18n and vendors.
    wp_enqueue_script('wpreact-app', $this->asset('app.js'), ['react', 'react-dom', 'wp-i18n', 'wpreact-vendor'], false, true);

    // Define basic state for the application
    wp_localize_script('wpreact-app', 'WPReact', [
      'publicPath' => "{$this->publicUrl}build/", // This is important. With this you can use dynamic imports
      'restUrl' => get_rest_url(null, $this->api->namespace),
      'nonce' => wp_create_nonce($this->api->nonceAction),
      'state' => [ // You can also preload the Redux state
        'app' => [
          'name' => $this->getData('wpreact_app_name', 'Testovací aplikace pro Frontendisti.cz'),
        ],
      ],
    ]);

    // If you use translations for the plugin, you can register also the languages folder to use i18n in React app
    // See https://developer.wordpress.org/block-editor/developers/internationalization/
    wp_set_script_translations('wpreact-app', 'wpreact', $this->baseDir . '/languages');
  }


  public function getData($key, $default)
  {
    $data = get_transient($key);

    if (!$data) {
      set_transient($key, $default);
      $data = $default;
    }

    return $data;
  }


  /**
   * Renders root element for the React application
   */
  public function renderAppRoot()
  {
    echo '<div id="wpreact"></div>';
  }


  /**
   * Returns the real URL of the asset file.
   *
   * @param $file A source file name
   */
  public function asset(string $file): string
  {
    $manifest = $this->baseDir . '/build/assets-manifest.json';

    if (!$this->assets && file_exists($this->baseDir . '/build/assets-manifest.json')) {
      $this->assets = json_decode(file_get_contents($manifest), true);
    }

    if (isset($this->assets[$file])) {
      return "{$this->publicUrl}build/{$this->assets[$file]}";
    }

    throw new Exception("Asset $file doesn't exists.");
  }
}
