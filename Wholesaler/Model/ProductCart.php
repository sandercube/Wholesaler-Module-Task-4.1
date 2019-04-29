<?php

namespace Sander\Wholesaler\Model;

use Magento\Framework\Model\AbstractModel;
use Sander\Wholesaler\Model\ResourceModel\ProductCart;

class ProductCart extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(ProductCart::class);
    }
}
