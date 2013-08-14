<?php

namespace Drupal\drupalgotchi\Form;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Form\FormInterface;
use Drupal\Core\Action\ActionManager;
use Drupal\Core\StringTranslation\TranslationManager;
use Drupal\Core\Config\Config;

/**
 * Configuration form for Drupalgotchi.
 */
class ResetForm implements FormInterface {

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
   * @var \Drupal\Core\Config
   */
  protected $config;

  public function __construct() {
  }

  /**
   * {@inheritdoc}
   */
  public function getFormID() {
    return 'drupalgotchi_reset';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, array &$form_state) {

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, array &$form_state) {}

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, array &$form_state) {

  }
}
