<?php

declare(strict_types=1);

namespace Avosdim\Weather\Block\Adminhtml\Image\Edit;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class BackButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * @var string
     */
    private string $controllerRoutePath;

    /**
     * @param Context $context
     * @param RequestInterface $request
     * @param null|string $routePath
     */
    public function __construct(
        Context $context,
        RequestInterface $request,
        string $routePath = 'avosdim_weather/image'
    ) {
        parent::__construct($context, $request);

        $this->controllerRoutePath = $routePath;
    }

    /**
     * @return mixed[]
     */
    public function getButtonData(): array
    {
        return [
            'label' => __("Back"),
            'on_click' => sprintf("location.href = '%s';", $this->getBackUrl()),
            'class' => 'back',
            'sort_order' => 10,
        ];
    }

    /**
     * @return string
     */
    public function getBackUrl(): string
    {
        return $this->getUrl($this->controllerRoutePath);
    }
}
