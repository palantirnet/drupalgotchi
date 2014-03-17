<?php

/**
* @file
* Contains \Drupal\drupalgotchi\Tests\Plugin\Action\SetDrupalgotchiTest.
*/

namespace Drupal\drupalgotchi\Tests\Plugin\Action;

use Drupal\Tests\UnitTestCase;
use Drupal\drupalgotchi\Plugin\Action\SetDrupalgotchi;

  /**
   * Tests the role add plugin.
   *
   * @see \Drupal\user\Plugin\Action\AddRoleUser
   */
class SetDrupalgotchiTest extends UnitTestCase {

  /**
   * The key/value store.
   */
  protected $state;

  public static function getInfo() {
    return array(
      'name' => 'Drupalgotchi action plugin',
      'description' => 'Tests the set Drupalgotchi plugin',
      'group' => 'Drupalgotchi',
    );
  }

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();
  }

  /**
   * Tests the execute method for setting state value.
   */
  public function testSet() {

    // Set a mock class for the state container.
    // See http://phpunit.de/manual/current/en/test-doubles.html
    $stub = $this
      ->getMockBuilder('Drupal\Core\KeyValueStore\KeyValueStoreInterface')
      ->getMock();
    // Configure the stub to get the values passed by exexute().
    $stub->expects($this->once())
      ->method('set')
      ->with(
        $this->equalTo('drupalgotchi.attention'),
        $this->equalTo(10)
    );

    $config = array('name' => 'foo', 'needy' => 10);
    $set = new SetDrupalgotchi(
      $config,
      'drupalgotchi_set_attention',
      array(),
      $stub
    );

    $set->execute(10);

  }

}

