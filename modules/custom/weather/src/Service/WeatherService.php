<?php

/**
 * @file
 * Contains \Drupal\weather\Service\WeatherService.
 */

namespace Drupal\weather\service;

class WeatherService {
  public function findWeather($element, $postcode) {
    $weather_result = $this->makeWeatherRequest($postcode);;

    if ($weather_result) {
      $weather = $weather_result;
      $display_text = '<p>Weather in ' . $postcode . ' is ' . $weather . '.</p>';
      $element['#markup'] = $display_text;
    } else {
      $element['#markup'] = t("No weather found for @postcode.", array('@postcode' => $postcode));
    }
    return $element;
  }

  public function makeWeatherRequest($postcode) {
    $postcode_array = explode(' ', $postcode);
    $postcode_string = $postcode_array[0];
    $country_code = "GB";
    $api_key = "6541a35fa04f0979cb3d3d3df07ff0a9";

    $api_request = "api.openweathermap.org/data/2.5/weather?zip=". $postcode_string. "," . $country_code . "&appid=" . $api_key;

    $response = \Drupal::httpClient()->get($api_request);
    $json= $response->getBody()->getContents();
    $weather_array = json_decode($json, true);
    return $weather_array['weather'][0]['description'];
  }
}
