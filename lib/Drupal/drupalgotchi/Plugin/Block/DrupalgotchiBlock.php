<?php

/**
 * @file
 * Contains \Drupal\drupalgotchi\Plugin\Block\DrupalgotchiBlock.
 */

namespace Drupal\drupalgotchi\Plugin\Block;

use Drupal\block\BlockBase;
use Drupal\Component\Annotation\Plugin;
use Drupal\Core\Annotation\Translation;

use Drupal\Core\KeyValueStore\KeyValueStoreInterface;
use Drupal\Core\Config\Config;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a Drupalgotchi status block.
 *
 * @Plugin(
 *  id = "drupalgotchi_status",
 *  admin_label = @Translation("Drupalgotchi status"),
 *  module = "drupalgotchi"
 * )
 */
class DrupalgotchiBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * The state system.
   *
   * @var \Drupal\Core\KeyValueStore\KeyValueStoreInterface
   */
  protected $state;

  /**
   * The configuration object.
   *
   * @var \Drupal\Core\Config\Config
   */
  protected $config;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, array $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('state'),
      $container->get('config.factory')->get('drupalgotchi.settings')
    );
  }

  /**
   * Constructs a new DrupalgotchiBlock object.
   *
   * @param array $configuration
   * @param type $plugin_id
   * @param array $plugin_definition
   * @param \Drupal\Core\KeyValueStore\KeyValueStoreInterface $state
   *   The state service.
   * @param \Drupal\Core\Config\ConfigFactory $config_factory
   *   The config factory service.
   */
  public function __construct(array $configuration, $plugin_id, array $plugin_definition, KeyValueStoreInterface $state, Config $config) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->state = $state;
    $this->config = $config;
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $attention_quotient = $this->state->get('drupalgotchi.attention');
    $name = $this->config->get('name');

    return array(
      '#theme' => 'drupalgotchi_status_block',
      '#attention' => $attention_quotient,
      '#name' => $name,
    );
  }

}
