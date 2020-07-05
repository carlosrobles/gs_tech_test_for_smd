<?php

class GoldenScent_Partner_Model_Observer
{
    const COOKIE_KEY_SOURCE = 'gs_partner';

    public function capturePartner(Varien_Event_Observer $observer)
    {
        $frontController = $observer->getEvent()->getFront();
        $partner = $frontController->getRequest()
            ->getParam('partner', false);

        if ($partner) {
            Mage::getModel('core/cookie')->set(
                self::COOKIE_KEY_SOURCE,
                $partner,
                86400
            );
        }
    }
}