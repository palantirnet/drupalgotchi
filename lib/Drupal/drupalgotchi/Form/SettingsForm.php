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


    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, array &$form_state) {
    parent::submitForm($form, $form_state);

  }
}
