<?php

use Aws\Sqs\SqsClient;

class GoldenScent_Publisher_Model_SalesOrderPlaceAfterObserver
{
    /*
     * process new orders and publish to sqs
     */
    public function publishNewOrder(Varien_Event_Observer $observer)
    {
        /** @var GoldenScent_Publisher_Model_Publisher $publisher */
        $publisher = Mage::getModel('goldenscent_publisher/publisher');

        /** @var Mage_Sales_Model_Order $order */
        $order = $observer->getOrder();

        $items = [];
        /** @var Mage_Sales_Model_Order_Item $item */
        foreach ($order->getAllItems() as $item) {
            $items[$item->getId()] = [
                'item_id' => $item->getId()
            ];
        }
        $message = [
            'order_id' => $order->getId(),
            'partner' => $order->getData('partner'),
            'items' => $items,
        ];
        $publisher->publish(
            getenv('NEW_ORDER_STANDARD'),
            json_encode($message)
        );

    }
}