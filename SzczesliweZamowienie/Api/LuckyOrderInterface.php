<?php
namespace Zaliczenie\SzczesliweZamowienie\Api;

interface LuckyOrderInterface
{
    /**
     * Sprawdza, czy zamówienie jest szczęśliwe.
     *
     * @param int $orderId
     * @return bool
     */
    public function isLuckyOrder($orderId);

    /**
     * Zapisuje szczegóły szczęśliwego zamówienia.
     *
     * @param int $orderId
     * @param string $customerName
     * @param string $customerEmail
     * @return void
     */
    //public function saveLuckyOrderDetails($orderId, $customerName, $customerEmail);
    public function saveLuckyOrderDetails($orderId, $customerName);

    /**
     * sprawdza szczescie na podstawie losowej liczby
     * @return bool
     */
    public function luckCheck();
}
