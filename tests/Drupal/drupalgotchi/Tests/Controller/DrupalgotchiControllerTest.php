<?php

/**
* @file
* Contains \Drupal\drupalgotchi\Tests\Controller\DrupalgotchiControllerTest.
*/

namespace Drupal\drupalgotchi\Tests\Plugin\Action;

use Drupal\Tests\UnitTestCase;
use Drupal\drupalgotchi\Controller\DrupalgotchiController;

  /**
   * Tests the role add plugin.
   *
   * @see \Drupal\user\Plugin\Action\AddRoleUser
   */
class DrupalgotchiControllerTest extends UnitTestCase {

  /**
   * Placeholder for the config mock.
   */
  protected $config;

  public static function getInfo() {
    return array(
      'name' => 'Drupalgotchi controller',
      'description' => 'Tests the Drupalgotchi page controller',
      'group' => 'Drupalgotchi',
    );
  }

  public function setup() {
    parent::setup();

    // Autoloading is not working for contrib. Load our class to test.
    // See https://drupal.org/node/2025883
    include_once DRUPAL_ROOT . '/modules/drupalgotchi/lib/Drupal/drupalgotchi/Controller/DrupalgotchiController.php';

    // Set a stub.
    $this->config = $this
      ->getMockBuilder('Drupal\Core\Config\Config')
      ->disableOriginalConstructor()
      ->getMock();
    $this->config->expects($this->any())
      ->method('get')
      ->will($this->returnValue('foo'));
  }

  public function testDrupalgotchiController() {
    $person = 'bar';
    $controller = new DrupalgotchiController();
    // The missing magic.
    $controller->config = $this->config;
    $return = $controller->hello($person);

    $this->assertEquals('drupalgotchi_hello', $return['#theme']);
    $this->assertEquals('foo', $return['#name']);
    $this->assertEquals('bar', $return['#person']);

  }

}
