<?php

namespace Avosdim\Weather\Model\ResourceModel\Listingicon;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'image_id';

    protected $_eventPrefix = 'avosdim_weather_image_collection';

    protected $_eventObject = 'weather_image_collection';

    /**
     * Define model & resource model
     */
    protected function _construct()
    {
        $this->_init('Avosdim\Weather\Model\Listingicon', 'Avosdim\Weather\Model\ResourceModel\Listingicon');
    }
}
