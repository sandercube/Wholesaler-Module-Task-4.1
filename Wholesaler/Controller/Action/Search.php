<?php

namespace Sander\Wholesaler\Controller\Action;

use Magento\Framework\App\Action\Context;
use Magento\Catalog\Model\ResourceModel\Product\Collection;
use Magento\Framework\Controller\Result\JsonFactory;

class Search extends \Magento\Framework\App\Action\Action
{
    protected $dataProductCart;
    protected $resultJsonFactory;
    protected $productCollection;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Catalog\Model\ResourceModel\Product\Collection $productCollection,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
    ) {
        parent::__construct($context);
        $this->productCollection = $productCollection;
        $this->resultJsonFactory = $resultJsonFactory;
    }

    public function execute()
    {
        $sku        = $this->getRequest()->getParam('sku');
        $productArr = $this->productCollection->addFieldToFilter('sku', ['like' => $sku . '%']);
        $productArr->load();
        foreach ($productArr as $product) {
            $skuArr[] = $product->getData('sku');
        }
        $this->productCollection->getSelect()->columns('sku');

        return $this->resultJsonFactory->create()->setData(['items' => array_values($skuArr)]);
    }
}
