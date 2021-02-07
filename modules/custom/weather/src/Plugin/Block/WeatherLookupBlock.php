<?php

/**
 * @file
 * Contains \Drupal\weather\Plugin\Block\WeatherLookupBlock.
 */

namespace Drupal\weather\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a weather finder block.
 *
 * @Block(
 *   id = "weather_lookup_block",
 *   admin_label = @Translation("Weather lookup block"),
 *   category = @Translation("Custom")
 * )
 */
class WeatherLookupBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {

    $form = \Drupal::formBuilder()->getForm('Drupal\weather\Form\WeatherLookupForm');

    return $form;
  }
}
