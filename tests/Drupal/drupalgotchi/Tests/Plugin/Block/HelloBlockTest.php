<?php

/**
 * @file
 * Contains \Drupal\drupalgotchi\Tests\Plugin\Block\HelloBlockTest.
 */

namespace Drupal\drupalgotchi\Tests\Plugin\Block;

use Drupal\Tests\UnitTestCase;
use Drupal\drupalgotchi\Plugin\Block\HelloBlock;

/**
 * Tests the Drupalgotchi block.
 */
class HelloBlockTest extends UnitTestCase {

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
    include_once DRUPAL_ROOT . '/modules/drupalgotchi/lib/Drupal/drupalgotchi/Plugin/Block/HelloBlock.php';
  }

  /**
   * Tests the build method for the block.
   */
  public function testBlock() {
    $config = array();
    $plugin = array('module' => 'drupalgotchi', 'id' => 'drupalgotchi_hello');
    $block_plugin = new HelloBlock($config, 'drupalgotchi_hello', $plugin);

    $build = $block_plugin->build();
    $this->assertEquals('drupalgotchi_hello_block', $build['#theme']);
    $this->assertEquals('World', $build['#person']);
  }

}
