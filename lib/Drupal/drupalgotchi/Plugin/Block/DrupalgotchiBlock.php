<?php

/**
 * @file
 * Contains \Drupal\drupalgotchi\Plugin\Block\DrupalgotchiBlock.
 */

namespace Drupal\drupalgotchi\Plugin\Block;

use Drupal\block\BlockBase;
use Drupal\block\Annotation\Block;
use Drupal\Core\Annotation\Translation;

use Drupal\Core\KeyValueStore\KeyValueStoreInterface;
use Drupal\Core\Config\Config;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a Drupalgotchi status block.
 *
 * @Block(
 *   id = "drupalgotchi_status",
 *   admin_label = @Translation("Drupalgotchi status")
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
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
  }

}
