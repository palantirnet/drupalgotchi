<?php

/**
 * @file
 * Contains \Drupal\drupalgotchi\Plugin\Block\DrupalgotchiBlock.
 */

namespace Drupal\drupalgotchi\Plugin\Block;

use Drupal\block\BlockBase;
use Drupal\Component\Annotation\Plugin;
use Drupal\Core\Annotation\Translation;

use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Action\ActionManager;
use Drupal\Core\StringTranslation\TranslationManager;
use Drupal\Core\Config\Config;

use Drupal\drupalgotchi\Form\ResetForm;

/**
 * Provides a Drupalgotchi reset form.
 *
 * @Plugin(
 *  id = "drupalgotchi_reset",
 *  admin_label = @Translation("Reset Drupalgotchi"),
 *  module = "drupalgotchi"
 * )
 */
class ResetBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * The actions system.
   *
   * @var \Drupal\Core\Action\ActionManager
   */
  protected $actionsManager;

  /**
   * The translation system.
   *
   * @var \Drupal\Core\Translation\TranslationManager
   */
  protected $translation;

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
      $container->get('plugin.manager.action'),
      $container->get('string_translation'),
      $container->get('config.factory')->get('drupalgotchi.settings')
    );
  }

  /**
   * Constructs a new DrupalgotchiBlock object.
   *
   * @param array $configuration
   * @param type $plugin_id
   * @param array $plugin_definition
   * @param \Drupal\Core\Action\ActionManager $actions_manager
   *   The actions system.
   * @param \Drupal\Core\StringTranslation\TranslationManager $translator
   *   The translation system.
   * @param \Drupal\Core\Config\ConfigFactory $config_factory
   *   The config factory service.
   */
  public function __construct(array $configuration, $plugin_id, array $plugin_definition, ActionManager $actions_manager, TranslationManager $translation, Config $config) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->actionsManager = $actions_manager;
    $this->translation = $translation;
    $this->config = $config;
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    return drupal_get_form(new ResetForm($this->actionsManager, $this->translation, $this->config));
  }

}
