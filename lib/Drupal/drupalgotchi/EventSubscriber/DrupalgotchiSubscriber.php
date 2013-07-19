<?php

namespace Drupal\drupalgotchi\EventSubscriber;

use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelInterface;

use Drupal\Core\KeyValueStore\KeyValueStoreInterface;
use Drupal\Core\Config\ConfigFactory;
use Drupal\Core\StringTranslation\TranslationManager;

/**
 * Drupalgotchi request events.
 */
class DrupalgotchiSubscriber implements EventSubscriberInterface {

  /**
   * The state system.
   *
   * @var \Drupal\Core\KeyValueStore\KeyValueStoreInterface
   */
  protected $state;

  /**
   * The configuration system.
   *
   * @var \Drupal\Core\Config\ConfigFactory
   */
  protected $configFactory;

  /**
   * The translation system.
   *
   * @var \Drupal\Core\StringTranslation\TranslationManager
   */
  protected $translator;

  /**
   *
   * @param \Drupal\Core\Config\ConfigFactory $config_factory
   *   The configuration system.
   * @param \Drupal\Core\KeyValueStore\KeyValueStoreInterface $state
   *   The state storage system.
   */
  public function __construct(ConfigFactory $config_factory, KeyValueStoreInterface $state, TranslationManager $translator) {
    $this->configFactory = $config_factory;
    $this->state = $state;
    $this->translator = $translator;
  }

  public function onKernelRequestSetHappiness(GetResponseEvent $event) {
    if ($event->getRequestType() != KernelInterface::MASTER_REQUEST) {
      return;
    }

    // Note: there's an issue here because Drupal makes THREE requests per page.
    // One for the page, one for toolbar, one for contextual links. Not sure
    // how to deal with that.

    $attention_quotient = $this->state->get('drupalgotchi.attention') ?: 0;

    if ($event->getRequest()->attributes->get('account')->hasPermission('make drupalgotchi happy')) {
      $neediness = $this->configFactory->get('drupalgotchi.settings')->get('needy');
      $change = 10 - $neediness;
      $attention_quotient += $change;
    }
    else {
      $attention_quotient -= 1;
    }

    $this->state->set('drupalgotchi.attention', $attention_quotient);
  }

  public function onKernelRequestShowHappiness(GetResponseEvent $event) {
    if ($event->getRequestType() != KernelInterface::MASTER_REQUEST) {
      return;
    }

    $attention_quotient = $this->state->get('drupalgotchi.attention') ?: 0;
    if ($attention_quotient <= 0) {
      $config = $this->configFactory->get('drupalgotchi.settings');
      $message = $this->translator->translate('@name misses its owner. Please come back! @name has a sad. :-(', array(
        '@name' => $config->get('name'),
      ));
      drupal_set_message($message);
    }
  }

  public static function getSubscribedEvents() {
    $events[KernelEvents::REQUEST][] = array('onKernelRequestSetHappiness', 5);
    $events[KernelEvents::REQUEST][] = array('onKernelRequestShowHappiness', 2);
    return $events;
  }

}

