<?php

/**
 * @file
 * Contains \Drupal\drupalgotchi\Tests\Plugin\Action\SetDrupalgotchiTest.
 */

namespace Drupal\drupalgotchi\Tests\Plugin\Action;

use Drupal\Tests\UnitTestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Drupal\drupalgotchi\Plugin\Action\SetDrupalgotchi;

/**
 * Tests the role add plugin.
 *
 * @see \Drupal\user\Plugin\Action\AddRoleUser
 */
class SetDrupalgotchiTest extends UnitTestCase {

  protected $state;

  /**
   * The dependency injection container.
   *
   * @var \Symfony\Component\DependencyInjection\ContainerBuilder
   */
  protected $container;

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

    $this->container = new ContainerBuilder();

    $this->state = $this
      ->getMockBuilder('Drupal\Core\KeyValueStore\KeyValueStoreInterface')
      ->disableOriginalConstructor()
      ->getMock();

    #$this->state->setContainer($this->container);
  }

  /**
   * Tests the execute method for setting state value.
   */
  public function testSet() {
    $this->assertEquals(1, 1);
    $attention = $this->state->get('drupalgotchi.attention');
    $this->assertEquals($attention, 0);
    $config = array('name' => 'foo', 'needy' => 10);
    $set_state_plugin = new SetDrupalgotchi($config, 'drupalgotchi_set_attention', array());
    $set_state_plugin->execute(10);
    $attention = $this->state->get('drupalgotchi.attention');
    $this->assertEquals($attention, 10);
  }

}
