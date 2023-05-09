<?php

namespace Avosdim\Weather\Model;

use Avosdim\Weather\Service\WeatherApiService;
use Avosdim\Weather\ViewModel\Weather;
use Avosdim\Weather\WeatherApiCallException;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\Context;
use Magento\Framework\Registry;

class WeatherApiClient extends AbstractModel implements WeatherApiClientInterface
{

    protected WeatherApiService $weatherApiService;
    protected Weather $weather;

    /**
     * @param WeatherApiService $weatherApiService
     * @param Weather $weather
     * @param Context $context
     * @param Registry $registry
     */
    public function __construct(
        WeatherApiService $weatherApiService,
        Weather           $weather,
        Context           $context,
        Registry          $registry
    )
    {
        parent::__construct($context, $registry);
        $this->weatherApiService = $weatherApiService;
        $this->weather = $weather;
    }

    /**
     * @return array
     * @throws WeatherApiCallException
     */
    public function getWeather(): array
    {
        return $this->weatherApiService->sendRequest(
            WeatherApiClientInterface::API_WEATHER_ENDPOINT,
        );
    }


}
