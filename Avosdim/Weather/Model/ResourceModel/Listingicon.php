<?php

namespace Avosdim\Weather\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\Context;

class Listingicon extends AbstractDb
{

    public function __construct(
        Context $context
    ) {
        parent::__construct($context);
    }

    /**
     * Define main table
     */
    protected function _construct()
    {
        $this->_init('avosdim_weather_image', 'image_id');
    }
}
