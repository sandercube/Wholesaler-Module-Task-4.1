<?php

namespace Sander\Wholesaler\Plugin;

use Magento\Framework\App\Action\Context as Context;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Checkout\Controller\Cart\Add;
use Magento\Framework\Message\ManagerInterface;

class AddCartPlugin
{
    protected $productRepository;
    protected $context;

    public function __construct(
        Context $context,
        ProductRepositoryInterface $productRepository,
        ManagerInterface $messageManager
    ) {
        $this->productRepository = $productRepository;
        $this->context           = $context;
        $this->messageManager    = $messageManager;
    }

    public function beforeExecute()
    {
        try {
            $sku       = $this->context->getRequest()->getParam('sku');
            $qty       = $this->context->getRequest()->getParam('qty');
            $product   = $this->productRepository->get($sku);
            $productId = $product->getId();
            $params    = array(
                'product' => $productId,
                'qty'     => $qty,
            );
            $this->context->getRequest()->setParams($params);
        } catch (\Magento\Framework\Exception\NoSuchEntityException $e) {
            $this->messageManager->addErrorMessage('Введите SKU и повторите попытку');
        }
    }
}
