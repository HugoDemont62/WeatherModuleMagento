<?php

namespace Avosdim\Weather\ViewModel;

use Avosdim\Weather\Helper\GetDataFromCustomDB;
use Avosdim\Weather\Provider\Config;
use Avosdim\Weather\Service\WeatherApiService;
use Avosdim\Weather\WeatherApiCallException;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Avosdim\Weather\Helper;
use Magento\Framework\View\Element\Context;

class Weather implements ArgumentInterface
{
    protected ScopeConfigInterface $scopeConfig;
    protected Config $config;
    protected WeatherApiService $weatherApiService;
    protected Helper\GetDataFromCustomDB $getDataFromCustomDB;

    /**
     * @param Context $context
     * @param ScopeConfigInterface $scopeConfig
     * @param Config $config
     * @param WeatherApiService $weatherApiService
     * @param GetDataFromCustomDB $getDataFromCustomDB
     */
    public function __construct(
        Context                    $context,
        ScopeConfigInterface       $scopeConfig,
        Config                     $config,
        WeatherApiService          $weatherApiService,
        Helper\GetDataFromCustomDB $getDataFromCustomDB

    )
    {
        $this->_urlBuilder = $context->getUrlBuilder();
        $this->scopeConfig = $scopeConfig;
        $this->config = $config;
        $this->weatherApiService = $weatherApiService;
        $this->getDataFromCustomDB = $getDataFromCustomDB;
    }

    /**
     * @return bool
     */
    public
    function getIfIsEnabled(): bool
    {
        return $this->config->isEnabled();
    }

    /**
     * @return string
     */
    public
    function getApiUrl(): string
    {
        return $this->config->getApiUrl();
    }

    /**
     * @return string
     */
    public
    function getApiKey(): string
    {
        return $this->config->getApiKey();
    }

    /**
     * @return string
     */
    public
    function getCity(): string
    {
        return $this->config->getCity();
    }

    /**
     * @return string
     */
    public
    function getLang(): string
    {
        return $this->config->getLang();
    }

    /**
     * @return string
     */
    public
    function getTempetatureUnit(): string
    {
        if ($this->config->getTempetatureUnit() == 'Celsius') {
            return 'metric';
        } elseif ($this->config->getTempetatureUnit() == 'Fahrenheit') {
            return 'imperial';
        } else {
            return 'standard';
        }
    }

    /**
     * @param $image_name
     * @return array
     */
    function getImageDataFromCustomDB($image_name): array
    {
        return $this->getDataFromCustomDB->getTableData($image_name);
    }

    /**
     * @return string
     */
    function getUrl(): string
    {
        return http_build_query([
            'q' => $this->getCity(),
            'appid' => $this->getApiKey(),
            'units' => $this->getTempetatureUnit(),
            'lang' => $this->getLang()
        ]);
    }

    /**
     * @throws WeatherApiCallException
     */
    function getWeatherData($url): array
    {
        return $this->weatherApiService->sendRequest($url);
    }

    function getMediaDir(){
        $objectManager = ObjectManager::getInstance();
        return $objectManager->get('Magento\Store\Model\StoreManagerInterface')
            ->getStore()
            ->getBaseUrl(UrlInterface::URL_TYPE_MEDIA);
    }

}
