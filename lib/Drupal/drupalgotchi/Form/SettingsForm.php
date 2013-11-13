<?php

namespace Drupal\drupalgotchi\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Config\Config;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Configuration form for Drupalgotchi.
 */
class SettingsForm extends ConfigFormBase {

  /**
   * The configuration object.
   *
   * @var \Drupal\Core\Config\Config
   */
  protected $config;

  /**
   * Constructs a \Drupal\drupalgotchi\SettingsForm object.
   *
   * @param \Drupal\Core\Config\Config $config
   *   The configuration object.
   */
  public function __construct(Config $config) {

  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {

  }

  /**
   * {@inheritdoc}
   */
  public function getFormID() {

  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, array &$form_state) {

  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, array &$form_state) {

  }
}
