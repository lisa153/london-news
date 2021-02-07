<?php

/**
 * @file
 * Contains \Drupal\weather\Form\WeatherLookupForm.
 */

namespace Drupal\weather\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\weather\Service\WeatherService;
use Symfony\Component\DependencyInjection\ContainerInterface;

class WeatherLookupForm extends FormBase {
  /**
   * An instance of the weather service.
   *
   * @var WeatherService
   */
  protected $weatherService;

  /**
   * @param WeatherService $weatherService
   */
  public function __construct(WeatherService $weatherService) {
    $this->weatherService = $weatherService;
  }

  /**
   * @param ContainerInterface $container
   * @return WeatherLookupForm
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('weather.find_weather')
    );
  }

  public function getFormId()
  {
    return 'weather_postcode_lookup';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['container'] = [
      '#type' => 'container',
      '#attributes' => [
        'class' => 'ln-weather-form'
      ],
    ];
    $form['container']['postcode'] = [
      '#name' => 'postcode',
      '#type' => 'textfield',
      '#title' => 'Postcode',
      '#placeholder' => 'For example, SW1A 2AB',
      '#required' => TRUE,
      '#attributes' => [
        'title' => 'Postcode',
        'maxlength' => "10",
      ],
    ];

    $form['container']['submit'] = [
      '#name' => 'submit',
      '#type' => 'submit',
      '#value' => t("Search"),
      '#ajax' => [
        'callback' => '::findWeather',
        'wrapper' => 'weather-results',
        'progress' => [
          'type' => 'throbber',
        ],
      ],
    ];
    $form['results'] = [
      '#type' => 'markup',
      '#name' => 'weather results',
      '#prefix' => '<span id="weather-results">',
      '#suffix' => '</span>',
    ];
    return $form;
  }

  public function findWeather($form, FormStateInterface $form_state) {
    $postcode = $form['container']['postcode']['#value'];
    if (!$postcode == "") {
      $postcode = $form['container']['postcode']['#value'];
      $element = $form['container']['results'];
      $result = $this->weatherService->findWeather($element, $postcode);
    } else {
      $result['messages'] = [
        '#type' => 'container',
        '#attributes' => [
          'class' => 'ln-messages',
        ],
        '#weight' => '10',
      ];
      $result['messages']['error'] = [
        '#type' => 'markup',
        '#markup' => 'Please enter a postcode',
      ];
    }
    return $result;
  }


  public function submitForm(array &$form, FormStateInterface $form_state) {
    return;
  }
}
