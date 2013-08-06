<?php

namespace Drupal\drupalgotchi\Controller;

use Drupal\Core\Controller\ControllerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

use Drupal\Core\Config\ConfigFactory;

/**
 * Controller class for the Drupalgotchi module.
 */
class DrupalgotchiController implements ControllerInterface {

  /**
   * The configuration system.
   *
   * @var \Drupal\Core\Config\ConfigFactory
   */
  protected $configFactory;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static($container->get('config.factory'));
  }

  /**
   *
   * @param \Drupal\Core\Config\ConfigFactory $config_factory
   *   The configuration system.
   */
  public function __construct(ConfigFactory $config_factory) {
    $this->configFactory = $config_factory;
  }

  /**
   * Route callback method.
   *
   * @param $person
   *   The name to display.
   *
   * @return
   *   A theme array. See drupalgotchi-hello.html.twig.
   */
  public function hello($person) {
    $name = $this->configFactory->get('drupalgotchi.settings')->get('name');
    return array(
      '#theme' => 'drupalgotchi_hello',
      '#name' => $name,
      '#person' => $person,
    );
  }

}
