<?php

/**
 * @file
 * Contains \Drupal\drupalgotchi\Tests\Plugin\Action\SetDrupalgotchiTest.
 */

namespace Drupal\user\Tests\Plugin\Action;

use Drupal\Tests\UnitTestCase;
use Drupal\drupalgotchi\Plugin\Action\SetDrupalgotchi;

/**
 * Tests the role add plugin.
 *
 * @see \Drupal\user\Plugin\Action\AddRoleUser
 */
class SetDrupalgotchiTest extends UnitTestCase {

  protected $state;

  public static function getInfo() {
    return array(
      'name' => 'Set Drupalgotchi plugin',
      'description' => 'Tests the set Drupalgotchi plugin',
      'group' => 'Drupalgotchi',
    );
  }

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();

    $this->state = $this
      ->getMockBuilder('Drupal\Core\KeyValueStore\KeyValueStoreInterface')
      ->disableOriginalConstructor()
      ->getMock();
  }

}
