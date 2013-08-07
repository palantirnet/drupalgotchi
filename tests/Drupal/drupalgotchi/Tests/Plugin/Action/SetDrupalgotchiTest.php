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

    // Autoloading is not working for contrib. We can autoload the classes
    // for PHPUnit and then load our class to test.
    // See https://drupal.org/node/2025883
    include_once DRUPAL_ROOT . '/core/vendor/autoload.php';
    include_once DRUPAL_ROOT . '/modules/drupalgotchi/lib/Drupal/drupalgotchi/Plugin/Action/SetDrupalgotchi.php';

    // This part does not seem to be working.
    $this->state = $this
      ->getMockBuilder('Drupal\Core\KeyValueStore\KeyValueStoreInterface')
      ->getMock();

  }

  /**
   * Tests the execute method for setting state value.
   */
  public function testSet() {
    $this->assertEquals(1, 1);
    $attention = $this->state->get('drupalgotchi.attention');
    $this->assertEquals(0, $attention);
    $config = array('name' => 'foo', 'needy' => 10);
    $set_state_plugin = new SetDrupalgotchi($config, 'drupalgotchi_set_attention', array(), $this->state);
    // This part is not working as expected.
    $set_state_plugin->execute(10);
    $attention = $this->state->get('drupalgotchi.attention');
    $this->assertEquals(10, $attention);

  }

}
