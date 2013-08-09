<?php

namespace Drupal\drupalgotchi\Form;

use Drupal\system\SystemConfigFormBase;
use Drupal\Core\Config\Config;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Configuration form for Drupalgotchi.
 */
class SettingsForm extends SystemConfigFormBase {

  /**
   * The configuration object.
   *
   * @var \Drupal\Core\Config\Config
   */
  protected $config;

  /**
   * Constructs a \Drupal\drupalgotchi\SettingsForm object.
   *
   * @param \Drupal\Core\Config\Config $configy
   *   The configuration object.
   */
  public function __construct(Config $config) {
    $this->config = $config;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.factory')->get('drupalgotchi.settings')
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

    $form['name'] = array(
      '#title' => t('Name'),
      '#description' => t('What is your site animal\'s name?'),
      '#type' => 'textfield',
      '#default_value' => $this->config->get('name'),
    );

    $form['needy'] = array(
      '#title' => t('Neediness'),
      '#description' => t('How needy the site is for attention. Range is from 1-10.'),
      '#type' => 'range',
      '#step' => 1,
      '#min' => 1,
      '#max' => 10,
      '#default_value' => $this->config->get('needy'),
    );

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, array &$form_state) {
    parent::submitForm($form, $form_state);

    $this->config->set('name', $form_state['values']['name']);
    $this->config->set('needy', $form_state['values']['needy']);

    $this->config->save();
  }
}
