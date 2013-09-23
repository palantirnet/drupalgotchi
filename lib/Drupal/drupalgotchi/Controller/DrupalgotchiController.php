<?php

namespace Drupal\drupalgotchi\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Controller class for the Drupalgotchi module.
 */
class DrupalgotchiController extends ControllerBase {

  /**
   * Route callable method.
   *
   * @param $person
   *   The name to display.
   *
   * @return
   *   A theme array. See drupalgotchi-hello.html.twig.
   */
  public function hello($person) {
    $name = $this->config('drupalgotchi.settings')->get('name');

    return array(
      '#theme' => 'drupalgotchi_hello',
      '#name' => $name,
      '#person' => $person,
    );
  }

  /**
   * About the module.
   *
   * @return
   *  a theme array.  See drupalgotchi-about.html.twig.
   */
  public function about() {
    $name = $this->config('drupalgotchi.settings')->get('name');

    return array(
      '#name' => $name,
      '#theme' => 'drupalgotchi_about',
    );
  }
}
