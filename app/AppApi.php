<?php

namespace WPReact;

use WP_REST_Server;

class AppApi {
  public $nonceAction = 'wp_rest';
  public $namespace = 'wpreact';

  public function __construct()
  {
    add_action('rest_api_init', [$this, 'register']);
  }

  public function register()
  {
    register_rest_route($this->namespace, '/set-app-name', [
      'methods' => WP_REST_Server::EDITABLE,
      'callback' => [$this, 'setAppName'],
      'args' => [
        'nonce' => [
          'required' => true,
          'validate_callback' => function ($nonce) {
            return wp_verify_nonce($nonce, $this->nonceAction);
          },
        ],
        'name' => [
          'required' => true,
        ],
      ],
    ]);
  }

  public function setAppName($request)
  {
    $params = $request->get_params();

    set_transient('wpreact_app_name', $params['name']);

    return rest_ensure_response($params);
  }
}
