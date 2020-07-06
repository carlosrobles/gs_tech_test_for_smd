<?php

class GoldenScent_Partner_Model_Observer
{
    const COOKIE_KEY_SOURCE = 'gs_partner';

    public function capturePartner(Varien_Event_Observer $observer)
    {
        $partnerModel = Mage::getModel('goldenscent_partner/partner');
        $frontController = $observer->getEvent()->getFront();
        $unique_code = $frontController->getRequest()
            ->getParam('partner', false);

        if ($unique_code && $partnerModel->getPartnerByUniqueCode($unique_code)) {
            Mage::getModel('core/cookie')->set(
                self::COOKIE_KEY_SOURCE,
                $unique_code,
                86400
            );
        }
    }
}