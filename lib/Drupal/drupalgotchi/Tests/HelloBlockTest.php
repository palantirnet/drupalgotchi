<?php

/**
 * @file
 * Contains \Drupal\drupalgotchi\Tests\HelloBlockTest.
 */

namespace Drupal\drupalgotchi\Tests;

use Drupal\drupalgotchi\Plugin\Block\HelloBlock;
use Drupal\simpletest\WebTestBase;

/**
 * Tests the Drupalgotchi Hello block.
 */
class HelloBlockTest extends WebTestBase {

  /**
   * Modules to enable.
   *
   * @var array
   */
  public static $modules = array('drupalgotchi', 'block');

  public static function getInfo() {
    return array(
      'name' => 'Drupalgotchi hello block',
      'description' => 'Interface test for the hello block',
      'group' => 'Drupalgotchi',
    );
  }

  public function testHelloBlock() {
    // Go to the home page.
    $this->drupalGet('');

    // Block text should not be present.
    $this->assertNoText('Drupalgotchi Hello', 'Block title not found.');
    $this->assertNoText('Hello there World!', 'Block text not found.');

    // Place the block.
    $settings = array('label' => 'Drupalgotchi Hello');
    $this->drupalPlaceBlock('drupalgotchi_hello', $settings);

    // Go to the home page.
    $this->drupalGet('');

    // Block text should be present.
    $this->assertText('Drupalgotchi Hello', 'Block title found.');
    $this->assertText('Hello there World!', 'Block text found.');

  }
}
