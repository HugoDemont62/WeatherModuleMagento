<?php

namespace Avosdim\Weather;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Phrase;

class WeatherApiCallException extends LocalizedException
{
    /**#@+
     * Error HTTP response codes.
     */
    const HTTP_BAD_REQUEST = 400;
    const HTTP_UNAUTHORIZED = 401;
    const HTTP_NOT_FOUND = 404;
    const HTTP_INTERNAL_ERROR = 500;
    /**
     * @var int|mixed
     */
    protected mixed $_httpCode;
    /**
     * @var array
     */
    protected array $_details;
    /**
     * @var mixed|string
     */
    protected mixed $_name;
    /**
     * @var mixed|null
     */
    protected mixed $_errors;

    public function __construct(
        Phrase $phrase,
               $code = 0,
               $httpCode = self::HTTP_BAD_REQUEST,
        array  $details = [],
               $name = '',
               $errors = null,
    )
    {
        /** Only HTTP error codes are allowed. No success or redirect codes must be used. */
        if ($httpCode < 400 || $httpCode > 599) {
            throw new \InvalidArgumentException(sprintf('The specified HTTP code "%d" is invalid.', $httpCode));
        }
        parent::__construct($phrase);
        $this->code = $code;
        $this->_httpCode = $httpCode;
        $this->_details = $details;
        $this->_name = $name;
        $this->_errors = $errors;
    }

    /**
     * Retrieve exception details.
     * @return array
     */
    public function getDetails()
    {
        return $this->_details;
    }

    /**
     * Retrieve exception name.
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * Retrieve list of errors.
     * @return null|LocalizedException[]
     */
    public function getErrors()
    {
        return $this->_errors;
    }

    /**
     * @param $url
     * @param $status
     * @param $response
     * @return string
     */
    public function NotFoundException($url, $status, $response): string
    {
        return $url . ' not found. Status: ' . $status . ' Response: ' . $response;
    }
}
