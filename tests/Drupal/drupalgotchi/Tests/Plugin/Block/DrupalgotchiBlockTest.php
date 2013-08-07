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

  /**
   * The state system.
   *
   * @var \Drupal\Core\KeyValueStore\KeyValueStoreInterface
   */
  protected $state;

  /**
   * The configuration system.
   *
   * @var \Drupal\Core\Config\ConfigFactory
   */
  protected $configFactory;

  public static function getInfo() {
    return array(
      'name' => 'Drupalgotchi block plugin',
      'description' => 'Tests the basic Drupalgotchi block',
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
    include_once DRUPAL_ROOT . '/modules/drupalgotchi/lib/Drupal/drupalgotchi/Plugin/Block/DrupalgotchiBlock.php';

    // This part does not seem to be working.
    $this->state = $this
      ->getMockBuilder('Drupal\Core\KeyValueStore\KeyValueStoreInterface')
      ->getMock();

    $this->configFactory = $this
      ->getMockBuilder('Drupal\Core\Config\ConfigFactory')
      ->disableOriginalConstructor()
      ->getMock();

  }

  /**
   * Tests the build method for the block.
   */
  public function testBlock() {
    $config = array();
    $plugin = array('module' => 'drupalgotchi', 'id' => 'drupalgotchi_status');
    $block_plugin = new DrupalgotchiBlock($config, 'drupalgotchi_status', $plugin, $this->state, $this->configFactory);
    $build = $block_plugin->build();
    $this->assertTrue(isset($build['#theme']));
  }

}
