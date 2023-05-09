<?php

namespace Avosdim\Weather\Ui\Component\Listing\Columns;

use Magento\Catalog\Helper\ImageFactory;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Asset\Repository;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Ui\Component\Listing\Columns\Column;

class Thumbnail extends Column
{

    protected Repository $_assetRepo;

    /**
     *
     * @var StoreManagerInterface
     */
    protected StoreManagerInterface $storeManagerInterface;

    public function __construct(
        ContextInterface      $context,
        UiComponentFactory    $uiComponentFactory,
        StoreManagerInterface $storeManagerInterface,
        Repository            $assetRepo,
        array                 $components = [],
        array                 $data = [],
    )
    {
        $this->_assetRepo = $assetRepo;
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->storeManagerInterface = $storeManagerInterface;
    }

    public function prepareDataSource(array $dataSource): array
    {
        foreach ($dataSource["data"]["items"] as &$item) {
            if ($item['original_path']){
                if (isset($item['path'])) {
                    $url = $this->_assetRepo->getUrl("Avosdim_Weather::images/icons/".$item['image_name'].".png"); //Recuperation depuis le backend adminhtml et non le front !!
                    $item['path_src'] = $url;
                    $item['path_alt'] = $item['image_name'];
                    $item['path_link'] = $url;
                    $item['path_orig_src'] = $url;
                }
            }else{
                if (isset($item['path'])) {
                    $url = $this->storeManagerInterface->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA) . $item['path'];
                    $item['path_src'] = $url;
                    $item['path_alt'] = $item['image_name'];
                    $item['path_link'] = $url;
                    $item['path_orig_src'] = $url;
                }
            }

        }
        return $dataSource;
    }
}
