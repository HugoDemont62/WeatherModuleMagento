<?php

namespace Avosdim\Weather\Model;

use \Avosdim\Weather\ViewModel\Weather;

interface WeatherApiClientInterface
{
    const API_WEATHER_ENDPOINT = "";

    /**
     * @return array
     */
    public function getWeather(): array;

}
