<?php

namespace Drupal\drupalgotchi\EventSubscriber;

use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Cmf\Component\Routing\RouteObjectInterface;

use Drupal\Core\KeyValueStore\KeyValueStoreInterface;
use Drupal\Core\Config\ConfigFactory;
use Drupal\Core\StringTranslation\TranslationManager;
use Drupal\Core\Session\AccountInterface;

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
   * The configuration object.
   *
   * @var \Drupal\Core\Config\Config
   */
  protected $config;

  /**
   * The translation system.
   *
   * @var \Drupal\Core\StringTranslation\TranslationManager
   */
  protected $translator;

  /**
   * The current user.
   *
   * @var \Drupal\Core\Session\AccountInterface
   */
  protected $currentUser;

  /**
   * Constructs a new DrupalgotchiSubscriber object.
   *
   * @param \Drupal\Core\Config\ConfigFactory $config_factory
   *   The configuration system.
   * @param \Drupal\Core\KeyValueStore\KeyValueStoreInterface $state
   *   The state storage system.
   * @param \Drupal\Core\StringTranslation\TranslationManager $translator
   *   The translation system.
   * @param \Drupal\Core\Session\AccountInterface $user
   *   The current user to validate against.
   */
  public function __construct(ConfigFactory $config_factory, KeyValueStoreInterface $state, TranslationManager $translator, AccountInterface $user) {
    $this->config = $config_factory->get('drupalgotchi.settings');
    $this->state = $state;
    $this->translator = $translator;
    $this->currentUser = $user;
  }

  /**
   * Responds to kernel event to set happiness level.
   *
   * @param \Symfony\Component\HttpKernel\Event\GetResponseEvent $event
   *   The system event.
   */
  public function onKernelRequestSetHappiness(GetResponseEvent $event) {
    if ($event->getRequestType() != KernelInterface::MASTER_REQUEST) {
      return;
    }

    // Note: there's an issue here because Drupal makes multiple requests per page.
    // One for the page, one for toolbar, one for contextual links. This is a
    // decent way around that for now.
    $request = $event->getRequest();
    $route_name = $request->attributes->get(RouteObjectInterface::ROUTE_NAME);
    if (in_array($route_name, array('contextual.render'))) {
      return;
    }

    $attention_quotient = $this->state->get('drupalgotchi.attention') ?: 0;

    if ($this->currentUser->hasPermission('make drupalgotchi happy')) {
      $neediness = $this->config->get('needy');
      // Since the neediness is 1-based, we need to subtract it from 11 or we
      // sometimes get a change of 0.
      $change = 11 - $neediness;
      $attention_quotient += $change;
    }
    else {
      $attention_quotient -= 1;
    }

    $this->state->set('drupalgotchi.attention', $attention_quotient);
  }

  /**
   * Responds to kernel event to display level.
   *
   * @param \Symfony\Component\HttpKernel\Event\GetResponseEvent $event
   *   The system event.
   */
  public function onKernelRequestShowHappiness(GetResponseEvent $event) {
    if ($event->getRequestType() != KernelInterface::MASTER_REQUEST) {
      return;
    }

    // Note: there's an issue here because Drupal makes THREE requests per page.
    // One for the page, one for toolbar, one for contextual links. This is a
    // decent way around that.
    if ($event->getRequest()->attributes->get('_controller') != 'controller.page:content') {
      return;
    }

    $attention_quotient = $this->state->get('drupalgotchi.attention') ?: 0;
    if ($attention_quotient <= 0) {
      $message = $this->translator->translate('@name misses its owner. Please come back! @name has a sad. :-(', array(
        '@name' => $this->config->get('name'),
      ));
      drupal_set_message($message);
    }
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

