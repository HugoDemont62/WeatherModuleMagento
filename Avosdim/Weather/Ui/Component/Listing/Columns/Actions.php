<?php
namespace Avosdim\Weather\Ui\Component\Listing\Columns;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

class Actions extends Column
{
    /**
     * @var UrlInterface
     */
    protected UrlInterface $urlBuilder;

    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);

        $this->urlBuilder = $urlBuilder;
    }

    /**
     * @param array $dataSource
     *
     * @return array
     */
    public function prepareDataSource(array $dataSource): array
    {
        if (!isset($dataSource['data']['items'])) {
            return $dataSource;
        }
        foreach ($dataSource['data']['items'] as &$item) {
            $item[$this->getData('name')]['edit'] = [
                'href' => $this->urlBuilder->getUrl(
                    'avosdim_weather/image/edit',
                    ['id' => $item['image_id']]
                ),
                'label' => __("Edit"),
                'hidden' => false,
            ];
            $item[$this->getData('name')]['reset'] = [
                'href' => $this->urlBuilder->getUrl(
                    'avosdim_weather/image/reset',
                    ['id' => $item['image_id']]
                ),
                'label' => __("Reset"),
                'confirm' => [
                    'title' => __('Reset "%1"', $item['image_name']),
                    'message' => __('Are you sure you wan\'t to reset a "%1" record?', $item['image_name'])
                ],
                'hidden' => false,
            ];
        }
        return $dataSource;
    }
}
