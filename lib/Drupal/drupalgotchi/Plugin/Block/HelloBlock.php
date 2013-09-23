<?php

/**
 * @file
 * Contains \Drupal\drupalgotchi\Plugin\Block\HelloBlock.
 */

namespace Drupal\drupalgotchi\Plugin\Block;

use Drupal\block\BlockBase;
use Drupal\block\Annotation\Block;
use Drupal\Core\Annotation\Translation;

/**
 * Provides a Drupalgotchi hello block.
 *
 * @Block(
 *   id = "drupalgotchi_hello",
 *   admin_label = @Translation("Hello World")
 * )
 */
class HelloBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function settings() {
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, &$form_state) {
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, &$form_state) {
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
  }
}
