<?php

namespace Avosdim\Weather\Model\ResourceModel;


use Avosdim\Weather\Api\Data\ImageInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Image extends AbstractDb
{
    /**
     * avosdim weather table data
     */
    public const TABLE_NAME = 'avosdim_weather_image';

    /**
     * {@inheritdoc}
     */
    protected $_idFieldName = ImageInterface::ID;

    /**
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(self::TABLE_NAME, $this->_idFieldName);
    }
}
