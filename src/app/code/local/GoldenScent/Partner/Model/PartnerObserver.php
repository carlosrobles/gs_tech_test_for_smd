<?php

class GoldenScent_Partner_Model_PartnerObserver
{
    const COOKIE_KEY_SOURCE = 'gs_partner';

    /*
     * Capture partner code from request url and store it in gs_partner cookie
     */
    public function capturePartner(Varien_Event_Observer $observer)
    {
        $partnerModel = Mage::getModel('goldenscent_partner/partner');
        $frontController = $observer->getEvent()->getFront();
        $unique_code = $frontController->getRequest()
            ->getParam('partner', false);

        //TODO: create admin config for cookie life time
        if ($unique_code && $partnerModel->getPartnerByUniqueCode($unique_code)) {
            Mage::getSingleton('core/cookie')->set(
                self::COOKIE_KEY_SOURCE,
                $unique_code,
                86400
            );
        }
    }
}