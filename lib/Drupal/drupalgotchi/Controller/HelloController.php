<?php

namespace Drupal\drupalgotchi\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;

use Drupal\Core\Controller\ControllerBase;

/**
 * Controller class for hello-world actions.
 */
class HelloController extends ControllerBase {

  /**
   * Route callable method.
   *
   * @return
   *   A string that is the body of a page.
   */
  public function hello() {
    return "Hello World";
  }

  /**
   * Route callable method.
   *
   * @return \Symfony\Component\HttpFoundation\JsonResponse
   *   A JSON response.
   */
  public function helloPage() {
    $json['hello'] = 'World';

    return new JsonResponse($json);
  }

  /**
   * Route callable method.
   *
   * @param $person
   *   The name to display.
   *
   * @return
   *   A theme array. See drupalgotchi-hello.html.twig.
   */
  public function helloPerson($person) {
    return array(
      '#theme' => 'drupalgotchi_hello',
      '#person' => $person,
    );
  }

}
