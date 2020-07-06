<?php
class GoldenScent_Partner_Model_Resource_Partner extends Mage_Core_Model_Resource_Db_Abstract{
    protected function _construct()
    {
        $this->_init('goldenscent_partner/partner', 'id');
    }
}