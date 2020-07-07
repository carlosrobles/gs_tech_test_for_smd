<?php

class GoldenScent_Partner_Model_SalesOrderPlaceAfterObserver
{
    public function addPartnerOnOrder(Varien_Event_Observer $observer)
    {
        $partner = Mage::getSingleton('core/cookie')->get('gs_partner');
        $observer->getOrder()->setPartner($partner);
    }
}