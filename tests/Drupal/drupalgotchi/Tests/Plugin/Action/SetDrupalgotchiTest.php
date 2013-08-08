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

    // Autoloading is not working for contrib. Load our class to test.
    // See https://drupal.org/node/2025883
    include_once DRUPAL_ROOT . '/modules/drupalgotchi/lib/Drupal/drupalgotchi/Plugin/Action/SetDrupalgotchi.php';

    // This part does not seem to be working.
    $this->stub = $this
      ->getMockBuilder('Drupal\Core\KeyValueStore\KeyValueStoreInterface')
      ->getMock();
    // Configure the stub.
    $this->stub->expects($this->any())
      ->method('get')
      ->will($this->returnValue(10));

  }

  /**
   * Tests the execute method for setting state value.
   */
  public function testSet() {
    $config = array('name' => 'foo', 'needy' => 10);
    $set = new SetDrupalgotchi($config, 'drupalgotchi_set_attention', array(), $this->stub);
    // Ensure that our class does not explode.
    $set->execute(10);
    // Check the behavior we expect.
    $this->assertEquals(10, $this->stub->get('drupalgotchi.attention'));
  }

}

