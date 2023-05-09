<?php

namespace Avosdim\Weather\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\DB\Adapter\AdapterInterface;

class GetDataFromCustomDB extends AbstractHelper
{
    protected AdapterInterface $_connection;

    public function __construct(
        ResourceConnection $resource
    )
    {
        $this->_connection = $resource->getConnection();
    }

    public function getTableData($image_name): array
    {
        $myTable = $this->_connection->getTableName('avosdim_weather_image');
        $sql = $this->_connection->select()->from($myTable)->where("`image_name` = '$image_name'");
        return $this->_connection->fetchAll($sql);
    }
}
