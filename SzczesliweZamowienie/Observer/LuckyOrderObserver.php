<?php

namespace Zaliczenie\SzczesliweZamowienie\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Message\ManagerInterface;
use Magento\Checkout\Model\Session as CheckoutSession;
use Zaliczenie\SzczesliweZamowienie\Model\LuckyOrder;
use Zaliczenie\SzczesliweZamowienie\Helper\Data;

class LuckyOrderObserver implements ObserverInterface
{
    protected $messageManager;
    protected $checkoutSession;


    public function __construct(
        ManagerInterface $messageManager,
        CheckoutSession $checkoutSession,
        LuckyOrder $luckyOrder
    ) {
        $this->messageManager = $messageManager;
        $this->checkoutSession = $checkoutSession;
        $this->luckyOrder = $luckyOrder;
    }

    public function execute(Observer $observer)
    {
        $helper = \Magento\Framework\App\ObjectManager::getInstance()->get(Data::class);
        if($helper->getGeneralConfig('enabled') == 1) {
            $order = $this->checkoutSession->getLastRealOrder();

            if ($this->luckyOrder->isLuckyOrder($order->getId())) {
                $this->luckyOrder->saveLuckyOrderDetails($order->getId(), $order->getCustomerEmail());

                $this->messageManager->addSuccessMessage('Gratulacje! Wygrałeś w konkursie!.');

            }
        }
    }
}
