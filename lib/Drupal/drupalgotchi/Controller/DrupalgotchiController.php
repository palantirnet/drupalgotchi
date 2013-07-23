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

  public function __construct(ConfigFactory $config_factory) {
    $this->configFactory = $config_factory;
  }

  public function hello() {
    $name = $this->configFactory->get('drupalgotchi.settings')->get('name');
    return array(
      '#theme' => 'drupalgotchi_hello',
      '#name' => $name,
    );
  }

}
