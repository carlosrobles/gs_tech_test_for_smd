<?php

class GoldenScent_Partner_Model_Partner extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        $this->_init('goldenscent_partner/partner');
    }

    public function getPartnerByUniqueCode($unique_code)
    {
        return Mage::getSingleton('core/resource')
            ->getConnection('core_read')
            ->query("SELECT * FROM gs_partner WHERE unique_code='$unique_code' LIMIT 1")
            ->fetch();
    }
}
