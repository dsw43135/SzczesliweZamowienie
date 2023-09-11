<?php
namespace Zaliczenie\SzczesliweZamowienie\Model;

use Zaliczenie\SzczesliweZamowienie\Api\LuckyOrderInterface;
use Zaliczenie\SzczesliweZamowienie\Model\ResourceModel\Order as OrderResource;
use Zaliczenie\SzczesliweZamowienie\Helper\Data;
use Zaliczenie\SzczesliweZamowienie\Model\Order;

class LuckyOrder implements LuckyOrderInterface
{
    /**
     * {@inheritdoc}
     */
    public function isLuckyOrder($orderId)
    {
        // Implementacja logiki sprawdzającej, czy zamówienie jest szczęśliwe
        // Tutaj możesz umieścić swój własny algorytm losowania i warunki, które określają szczęśliwe zamówienie

        // Przykładowa implementacja, gdzie zamówienie jest uważane za szczęśliwe, jeśli jego wartość przekracza 500 zł
        $order = $this->getOrderById($orderId);
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $helper = $objectManager->get(Data::class);
        if ($order && $order->getGrandTotal() > $helper->getGeneralConfig('minimum_order_amount')) {

            //if($this->luckCheck()) // logika losowości
                return true;
        }

        return false;
    }

    public function luckCheck() :bool
    {
        $ran = random_int(1, 10);
        return $ran <= 5;

    }

    /**
     * {@inheritdoc}
     */
    //public function saveLuckyOrderDetails($orderId, $customerName, $customerEmail)
    public function saveLuckyOrderDetails($orderId, $customerEmail)
    {
        // Implementacja logiki zapisującej szczegóły szczęśliwego zamówienia
        // Tutaj możesz zapisywać dane szczęśliwego zamówienia w bazie danych lub w inny sposób

        // Przykładowa implementacja, gdzie szczegóły zamówienia są zapisywane w tabeli o nazwie 'lucky_orders'
        $data = [
            'order_id' => $orderId,
            'customer_inf' => $customerEmail,
            'created_at' => date('Y-m-d H:i:s')
        ];

        // Przykład zapisu danych do tabeli 'lucky_orders' przy użyciu Object Managera
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $orderResource = $objectManager->get(OrderResource::class);
        $order = $objectManager->create(Order::class);
        $order->setData($data);
        $orderResource->save($order);
    }

    /**
     * Pobierz zamówienie na podstawie identyfikatora
     *
     * @param int $orderId
     * @return \Magento\Sales\Api\Data\OrderInterface|null
     */
    private function getOrderById($orderId)
    {
        // Przykład pobrania zamówienia przy użyciu Object Managera
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $orderRepository = $objectManager->get(\Magento\Sales\Api\OrderRepositoryInterface::class);

        try {
            $order = $orderRepository->get($orderId);
            return $order;
        } catch (\Magento\Framework\Exception\NoSuchEntityException $e) {
            return null;
        }
    }
}
