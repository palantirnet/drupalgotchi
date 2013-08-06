<?php

namespace Drupal\drupalgotchi\Form;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Form\FormInterface;
use Drupal\Core\Action\ActionManager;
use Drupal\Core\StringTranslation\TranslationManager;
use Drupal\Core\Config\ConfigFactory;

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
   * The configuration system.
   *
   * @var \Drupal\Core\Config\ConfigFactory
   */
  protected $configFactory;

  /**
   * Constructs a \Drupal\drupalgotchi\SettingsForm object.
   *
   * @param \Drupal\Core\Action\ActionManager $actions_manager
   * @param \Drupal\Core\StringTranslation\TranslationManager $translation
   * @param \Drupal\Core\Config\ConfigFactory $config_factory
   */
  public function __construct(ActionManager $actions_manager, TranslationManager $translation, ConfigFactory $config_factory) {
    $this->actionsManager = $actions_manager;
    $this->translation = $translation;
    $this->configFactory = $config_factory;
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
    $form['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->translation->translate('Reset'),
    );

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
    $this->actionsManager->createInstance('drupalgotchi_set_attention')->execute(0);

    $name = $this->configFactory->get('drupalgotchi.settings')->get('name');
    drupal_set_message($this->translation->translate('@name\'s attention level has been reset', array(
      '@name' => $name,
    )));

  }
}
