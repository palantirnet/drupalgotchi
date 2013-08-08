<?php

/**
 * @file
 * Contains \Drupal\drupalgotchi\Plugin\Block\HelloBlock.
 */

namespace Drupal\drupalgotchi\Plugin\Block;

use Drupal\block\BlockBase;
use Drupal\Component\Annotation\Plugin;
use Drupal\Core\Annotation\Translation;

/**
 * Provides a Drupalgotchi hello block.
 *
 * @Plugin(
 *  id = "drupalgotchi_hello",
 *  admin_label = @Translation("Hello World"),
 *  module = "drupalgotchi"
 * )
 */
class HelloBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function settings() {
    return array(
      'person' => 'World',
    );
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, &$form_state) {
    $form['person'] = array(
      '#type' => 'textfield',
      '#title' => t('Person'),
      '#maxlength' => 50,
      '#default_value' => $this->configuration['person'],
      '#required' => TRUE,
    );
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, &$form_state) {
    $this->configuration['person'] = $form_state['values']['person'];
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    return array(
      '#theme' => 'drupalgotchi_hello_block',
      '#person' => $this->configuration['person'],
    );
  }
}
