<?php

/**
 * @file
 * Contains \Drupal\drupalgotchi\Tests\DrupalgotchiBlockTest.
 */

namespace Drupal\drupalgotchi\Tests;

use Drupal\drupalgotchi\Plugin\Block\DrupalgotchiBlock;
use Drupal\simpletest\WebTestBase;

/**
 * Tests the Drupalgotchi block.
 */
class DrupalgotchiBlockTest extends WebTestBase {

  /**
   * Modules to enable.
   *
   * @var array
   */
  public static $modules = array('drupalgotchi', 'block');

  public static function getInfo() {
    return array(
      'name' => 'Drupalgotchi block',
      'description' => 'Interface test for the Drupalgotchi block',
      'group' => 'Drupalgotchi',
    );
  }

  public function testDrupalgotchiBlock() {
    // Go to the home page.
    $this->drupalGet('');

    // Block text should not be present.
    $this->assertNoText('Drupalgotchi', 'Block title not found.');
    $this->assertNoText('attention level is', 'Block text not found.');

    // Place the block.
    $settings = array('label' => 'Drupalgotchi');
    $this->drupalPlaceBlock('drupalgotchi_status', $settings);

    // Go to the home page.
    $this->drupalGet('');

    // Block text should be present.
    $this->assertText('Drupalgotchi', 'Block title found.');
    $this->assertText('attention level is', 'Block text found.');
  }

}
