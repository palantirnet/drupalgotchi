<?php

namespace Drupal\drupalgotchi\Form;

use Drupal\system\SystemConfigFormBase;
use Drupal\Core\Config\ConfigFactory;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Configuration form for Drupalgotchi.
 */
class SettingsForm extends SystemConfigFormBase {

  /**
   * The configuration system.
   *
   * @var \Drupal\Core\Config\ConfigFactory
   */
  protected $configFactory;

  /**
   * Constructs a \Drupal\drupalgotchi\SettingsForm object.
   *
   * @param \Drupal\Core\Config\ConfigFactory $config_factory
   *   The factory for configuration objects.
   */
  public function __construct(ConfigFactory $config_factory) {
    $this->configFactory = $config_factory;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.factory')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFormID() {
    return 'drupalgotchi_settings';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, array &$form_state) {
    $config = $this->configFactory->get('drupalgotchi.settings');

    $form['name'] = array(
      '#title' => t('Name'),
      '#description' => t('What is your site animal\'s name?'),
      '#type' => 'textfield',
      '#default_value' => $config->get('name'),
    );

    $form['needy'] = array(
      '#title' => t('Neediness'),
      '#description' => t('How needy the site is for attention. Range is from 1-10.'),
      '#type' => 'range',
      '#step' => 1,
      '#min' => 1,
      '#max' => 10,
      '#default_value' => $config->get('needy'),
    );

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, array &$form_state) {
    parent::submitForm($form, $form_state);
    $config = $this->configFactory->get('drupalgotchi.settings');

    $config->set('name', $form_state['values']['name']);
    $config->set('needy', $form_state['values']['needy']);

    $config->save();
  }
}
