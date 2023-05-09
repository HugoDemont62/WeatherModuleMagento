<?php

declare(strict_types=1);

namespace Avosdim\Weather\Block\Adminhtml\Image\Edit;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\UrlInterface;

class GenericButton
{
    /**
     * @var UrlInterface
     */
    protected UrlInterface $urlBuilder;
    /**
     * @var RequestInterface
     */
    protected RequestInterface $request;

    /**
     * @param Context $context
     * @param RequestInterface $request
     */
    public function __construct(
        Context $context,
        RequestInterface $request
    ) {
        $this->urlBuilder = $context->getUrlBuilder();
        $this->request = $request;
    }

    /**
     * @return string|int|null
     */
    public function getId(): int|string|null
    {
        $id = $this->request->getParam('image_id');

        return $id ?: null;
    }

    /**
     * @param string $route
     * @param string[] $params
     *
     * @return string
     */
    public function getUrl(string $route = '', array $params = []): string
    {
        return $this->urlBuilder->getUrl($route, $params);
    }
}
