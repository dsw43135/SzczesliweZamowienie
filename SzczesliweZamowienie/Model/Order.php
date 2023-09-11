<?php

namespace Zaliczenie\SzczesliweZamowienie\Model;

use Magento\Framework\Model\AbstractModel;
use Zaliczenie\SzczesliweZamowienie\Model\ResourceModel\Order as OrderResource;
class Order extends AbstractModel
{
    protected function _construct(): void
    {
        $this->_init(OrderResource::class);
    }
}
