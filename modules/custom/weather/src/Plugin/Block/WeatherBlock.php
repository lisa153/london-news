<?php

/**
 * @file
 * Contains \Drupal\weather\Plugin\Block\WeatherBlock.
 */

namespace Drupal\weather\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\node\NodeInterface;
use Drupal\weather\service\WeatherService;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a weather block.
 *
 * @Block(
 *   id = "weather_block",
 *   admin_label = @Translation("Weather block"),
 *   category = @Translation("Custom")
 * )
 */
class WeatherBlock extends BlockBase implements ContainerFactoryPluginInterface {
  /**
   * @var WeatherService
   */
  protected $weatherService;

  /**
   * {@inheritdoc}
   */
  public function __construct($configuration, $plugin_id, $plugin_definition, WeatherService $weatherService) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->weatherService = $weatherService;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('weather.find_weather')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $node = \Drupal::routeMatch()->getParameter('node');
    if ($node instanceof NodeInterface) {
      $build['container'] =[
        '#type' => 'container',
        '#id' => 'weather-block'
      ];
      $postcode = $node->get('field_postcode')->value;
      $element = $build['container']['#markup'];
      return $this->weatherService->findWeather($element, $postcode);
    }

    return [];
  }
}
