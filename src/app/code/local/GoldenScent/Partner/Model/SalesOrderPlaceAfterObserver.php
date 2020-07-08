<?php

class GoldenScent_Partner_Model_SalesOrderPlaceAfterObserver
{
    public function updateOrderWithPartner(Varien_Event_Observer $observer)
    {
        try {
            /** @var Mage_Sales_Model_Order $order */
            $order = $observer->getOrder();
            $partner = Mage::getSingleton('core/cookie')->get('gs_partner');
            $order->setPartner($partner);
            /** @var Varien_Db_Adapter_Interface $connection */
            $connection = Mage::getSingleton('core/resource')->getConnection('core_write');
            foreach ($order->getAllItems() as $key => $item) {
                /** @var Mage_Sales_Model_Order_Item $item */
                if ($key % 2 || !$order->getPartner()) {
                    $connection->query(
                        "UPDATE sales_flat_order_item 
                        SET partner = 'mwh' 
                        where item_id = '" . $item->getId() . "'"
                    );
                } else {
                    $connection->query(
                        "UPDATE sales_flat_order_item 
                            SET partner = '".$partner."' 
                            where item_id = '" . $item->getId() . "'"
                    );
                }
            }
        } catch (Exception $e) {
            //TODO: log the error
        }
    }
}