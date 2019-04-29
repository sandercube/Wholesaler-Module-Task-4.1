<?php

namespace Sander\Wholesaler\Model\ResourceModel\ProductCart;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Sander\Wholesaler\Model\ProductCart', 'Sander\Wholesaler\Model\ResourceModel\ProductCart');
    }
}
