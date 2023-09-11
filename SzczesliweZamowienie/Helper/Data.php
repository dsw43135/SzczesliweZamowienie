<?php

namespace Zaliczenie\SzczesliweZamowienie\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{

    const XML_PATH = 'szczesliwezamowienie/';

    public function getConfigValue($field, $storeId = null)
    {
        return $this->scopeConfig->getValue(
            $field, ScopeInterface::SCOPE_STORE, $storeId
        );
    }

    public function isEnabled()
    {
        return $this->getConfigValue(self::XML_PATH . '/general/enabled', ScopeInterface::SCOPE_STORE);
    }

    public function getGeneralConfig($code, $storeId = null)
    {

        return $this->getConfigValue(self::XML_PATH .'general/'. $code, $storeId);
    }

}
