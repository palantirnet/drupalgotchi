<?php

/**
 * @file
 * Contains \Drupal\drupalgotchi\Tests\Plugin\Block\DrupalgotchiBlockTest.
 */

namespace Drupal\drupalgotchi\Tests\Plugin\Block;

use Drupal\Tests\UnitTestCase;
use Drupal\drupalgotchi\Plugin\Block\DrupalgotchiBlock;

/**
 * Tests the Drupalgotchi block.
 */
class DrupalgotchiBlockTest extends UnitTestCase {

  public static function getInfo() {
    return array(
      'name' => 'Drupalgotchi hello block plugin',
      'description' => 'Tests the Drupalgotchi hello block',
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
    include_once DRUPAL_ROOT . '/modules/drupalgotchi/lib/Drupal/drupalgotchi/Plugin/Block/DrupalgotchiBlock.php';
  }

  /**
   * Tests the build method for the block.
   */
  public function testBlock() {

    // Set a mock class for the state container.
    // See http://phpunit.de/manual/current/en/test-doubles.html
    $state_stub = $this
      ->getMockBuilder('Drupal\Core\KeyValueStore\KeyValueStoreInterface')
      ->getMock();
    // Configure the stub to get the values passed by exexute().
    $state_stub->expects($this->any())
      ->method('get')
      ->will($this->returnValue(10));

    $config_stub = $this
      ->getMockBuilder('Drupal\Core\Config\Config')
      ->disableOriginalConstructor()
      ->getMock();
    // Configure the stub to get the values passed by exexute().
    $config_stub->expects($this->any())
      ->method('get')
      ->will($this->returnValue('FooBar'));


    $config = array();
    $plugin = array('module' => 'drupalgotchi', 'id' => 'drupalgotchi_hello');
    $block_plugin = new DrupalgotchiBlock($config, 'drupalgotchi_hello', $plugin, $state_stub, $config_stub);

    $build = $block_plugin->build();
    $this->assertEquals('drupalgotchi_status_block', $build['#theme']);
    $this->assertEquals(10, $build['#attention']);
    $this->assertEquals('FooBar', $build['#name']);
  }

}
