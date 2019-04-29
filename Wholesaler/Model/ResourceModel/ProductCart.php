<?php

namespace Sander\Wholesaler\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class ProductCart extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('sander_wholesaler_sales', 'sale_id');
    }
}
