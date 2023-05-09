<?php

namespace Avosdim\Weather\Model;

use Magento\Framework\Model\AbstractModel;

class Listingicon extends AbstractModel
{
    const CACHE_TAG = 'avosdim_weather';

    //Unique identifier for use within caching
    protected $_cacheTag = self::CACHE_TAG;

    protected function _construct()
    {
        $this->_init('Avosdim\Weather\Model\ResourceModel\Listingicon');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        $values = [];
        return $values;
    }
}
