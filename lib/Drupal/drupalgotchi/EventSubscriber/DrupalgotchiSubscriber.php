<?php

namespace Drupal\drupalgotchi\EventSubscriber;

use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelInterface;

use Drupal\Core\KeyValueStore\KeyValueStoreInterface;
use Drupal\Core\Config\Config;
use Drupal\Core\Config\ConfigFactory;
use Drupal\Core\StringTranslation\TranslationManager;

/**
 * Drupalgotchi request events.
 */
class DrupalgotchiSubscriber implements EventSubscriberInterface {

  public function __construct() {

  }

  /**
   * Responds to kernel event to set happiness level.
   *
   * @param \Symfony\Component\HttpKernel\Event\GetResponseEvent $event
   *   The system event.
   */
  public function onKernelRequestSetHappiness(GetResponseEvent $event) {

  }

  /**
   * Responds to kernel event to display level.
   *
   * @param \Symfony\Component\HttpKernel\Event\GetResponseEvent $event
   *   The system event.
   */
  public function onKernelRequestShowHappiness(GetResponseEvent $event) {

  }

  /**
   * Registers event subscribers.
   */
  public static function getSubscribedEvents() {
    $events[KernelEvents::REQUEST][] = array('onKernelRequestSetHappiness', 5);
    $events[KernelEvents::REQUEST][] = array('onKernelRequestShowHappiness', 2);
    return $events;
  }

}

