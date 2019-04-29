<?php

namespace Sander\Wholesaler\Controller\Action;

use Magento\Framework\View\Result\PageFactory;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Message\ManagerInterface;

class Add extends \Magento\Framework\App\Action\Action
{
    protected $resultPageFactory;
    protected $productRepository;
    protected $messageManager;
    protected $dataProductCart;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        ManagerInterface $messageManager,
        \Sander\Wholesaler\Model\ProductCartFactory $dataProductCart
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->messageManager    = $messageManager;
        $this->dataProductCart   = $dataProductCart;
    }

    public function execute()
    {
        if ($this->getRequest()->getPost('sku')) {
            $sku = $this->getRequest()->getPost('sku');
            $qty = $this->getRequest()->getPost('qty');
            try {
                $model = $this->dataProductCart->create();
                $model->addData([
                    "sku" => $sku,
                    "qty" => $qty,
                ]);
                $saveData = $model->save();

                if ($saveData) {
                    $this->messageManager->addSuccessMessage('Товар успешно добавлен');
                    $this->_redirect('wholesaler');
                }
            } catch (\Magento\Framework\Exception\NoSuchEntityException $e) {
                $this->messageManager->addErrorMessage('Введите SKU и повторите попытку');
                $this->_redirect('wholesaler');
            }
        } else {
            $this->messageManager->addErrorMessage('Введите SKU и повторите попытку');
        }

        return $resultPage = $this->resultPageFactory->create();
    }
}
