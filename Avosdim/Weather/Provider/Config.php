<?php
namespace Avosdim\Weather\Provider;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\Encryption\EncryptorInterface;
use Magento\Store\Model\ScopeInterface;

class Config extends AbstractHelper
{
    protected EncryptorInterface $encryptor;
    /**
     * Weather general enabled path
     */
    public const XML_PATH_WEATHER_GENERAL_ENABLED = 'avosdim_weather/general/enabled';

    /**
     * Weather general enabled path
     */
    public const XML_PATH_WEATHER_GENERAL_API_URL = 'avosdim_weather/general/api_url';

    /**
     * Weather general enabled path
     */
    public const XML_PATH_WEATHER_GENERAL_API_KEY = 'avosdim_weather/general/api_key';

    /**
     * Weather general enabled path
     */
    public const XML_PATH_WEATHER_LOCALIZATION_CITY = 'avosdim_weather/localization/city';

    /**
     * Weather general enabled path
     */
    public const XML_PATH_WEATHER_LOCALIZATION_TEMP = 'avosdim_weather/localization/temp';

    /**
     * Weather general enabled path
     */
    public const XML_PATH_WEATHER_LANGUAGE = 'avosdim_weather/localization/lang';


    /**
     * @param ScopeConfigInterface $scopeConfig
     * @param EncryptorInterface $encryptor
     * @param Context $context
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        EncryptorInterface   $encryptor,
        Context $context,
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->encryptor = $encryptor;
        parent::__construct($context);
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return (bool)$this->getConfig(self::XML_PATH_WEATHER_GENERAL_ENABLED);
    }

    /**
     * @return string
     */
    public function getApiUrl(): string
    {
        return $this->getConfig(self::XML_PATH_WEATHER_GENERAL_API_URL);
    }

    /**
     * @return string
     */
    public function getApiKey(): string
    {
        $value = $this->getConfig(self::XML_PATH_WEATHER_GENERAL_API_KEY);
        return $this->encryptor->decrypt($value);
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->getConfig(self::XML_PATH_WEATHER_LOCALIZATION_CITY);
    }

    public function getLang(): string
    {
        return $this->getConfig(self::XML_PATH_WEATHER_LANGUAGE);
    }

    /**
     * @return string
     */
    public function getTempetatureUnit(): string
    {
        return $this->getConfig(self::XML_PATH_WEATHER_LOCALIZATION_TEMP);
    }

    /**
     * @param $configPath
     * @return mixed
     */
    public function getConfig($configPath): mixed
    {
        return $this->scopeConfig->getValue(
            $configPath,
            ScopeInterface::SCOPE_STORE
        );
    }
}
