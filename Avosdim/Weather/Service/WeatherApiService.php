<?php

namespace Avosdim\Weather\Service;

use Avosdim\Weather\WeatherApiCallException;
use Magento\Framework\HTTP\Client\Curl;
use Magento\Framework\Webapi\Request;
use Magento\Framework\Webapi\Rest\Response;
use Psr\Log\LoggerInterface;

class WeatherApiService
{
    /**
     * @var Curl
     */
    private $curlClient;
    protected $_logger;

    /**
     * @param Curl $curlClient
     * @param LoggerInterface $logger
     */
    public function __construct(
        Curl            $curlClient,
        LoggerInterface $logger,
    )
    {
        $this->_logger = $logger;
        $this->curlClient = $curlClient;
    }

    /**
     * Send a request to the API with the specified URI endpoint, request data, and HTTP method.
     * @param string $uriEndpoint
     * @param array $requestData
     * @param string $requestMethod
     * @param array|null $expectedHttpCode
     * @return array|string
     * @throws WeatherApiCallException
     */
    public function sendRequest(string $uriEndpoint, array $requestData = [], string $requestMethod = Request::METHOD_GET, ?array $expectedHttpCode = [Response::STATUS_CODE_200]): array|string
    {
        $this->curlClient->addHeader('Content-Type', 'application/json');
        $this->curlClient->addHeader('Accept', 'application/json');
        $this->curlClient->setOption(CURLOPT_CUSTOMREQUEST, $requestMethod);
        $this->curlClient->setHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ]);
        $this->curlClient->get($uriEndpoint);
        $responseBody = $this->curlClient->getBody();
        $responseCode = $this->curlClient->getStatus();
        if ($this->getApiStatus($expectedHttpCode, $responseCode) === Response::STATUS_CODE_200) {
            return json_decode($responseBody, true);
        } else {
            $jsonData = json_decode($responseBody, true);
            if ($responseCode === Response::STATUS_CODE_404) {

                if ($jsonData['message'] !== "city not found") {
                    throw new WeatherApiCallException(
                        __('Unauthorized for %1 (%2) : %3', $uriEndpoint, $responseCode, $responseBody),
                        0,
                        $responseCode,
                        [],
                        '',
                        $responseBody
                    );
                } else {
                    throw new WeatherApiCallException(
                        __('Not found exception for %1 (%2) : %3', $uriEndpoint, $responseCode, $responseBody),
                        0,
                        $responseCode,
                        [],
                        '',
                        $responseBody
                    );
                }
            } else {
                $this->_logger->error('An error has occurred when calling %1 (%2) : %3 %4', array($uriEndpoint, ($responseCode), ":", $requestMethod, $responseBody));//log error
                throw new WeatherApiCallException(
                    __('An error has occurred with status code %1 and response %2, %3', $responseCode, $responseBody, $uriEndpoint),
                    0,
                    $responseCode,
                    [],
                    '',
                    $responseBody
                );
            }
        }
    }
    /**
     * Get the API status based on the expected HTTP codes and the actual response code.
     * @param array $expectedHttpCode
     * @param int|null $response
     * @return int
     */
    private function getApiStatus(array $expectedHttpCode, ?int $response): int
    {
        $responseCode = Response::STATUS_CODE_500;
        if (in_array($response, $expectedHttpCode)) {
            $responseCode = Response::STATUS_CODE_200;
        }
        return $responseCode;
    }
}
