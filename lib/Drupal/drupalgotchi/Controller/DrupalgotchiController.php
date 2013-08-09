<?php

namespace Drupal\drupalgotchi\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;

use Drupal\Core\Config\ConfigFactory;

/**
 * Controller class for the Drupalgotchi module.
 */
class DrupalgotchiController extends ControllerBase {


  /**
   * Route callback method.
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

}
