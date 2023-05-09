<?php

declare(strict_types=1);

namespace Avosdim\Weather\Block\Adminhtml\Image\Edit;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class SaveButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * @var string
     */
    private string $buttonLabel;

    /**
     * @param Context $context
     * @param RequestInterface $request
     * @param String $buttonLabel
     */
    public function __construct(
        Context $context,
        RequestInterface $request,
        string $buttonLabel = 'Save'
    ) {
        parent::__construct($context, $request);
        $this->buttonLabel = $buttonLabel;
    }

    /**
     * @return array
     */
    public function getButtonData(): array
    {
        return [
            'label' => __($this->buttonLabel),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => ['button' => ['event' => 'save']],
                'form-role' => 'save',
            ],
            'onclick' => '',
        ];
    }
}
