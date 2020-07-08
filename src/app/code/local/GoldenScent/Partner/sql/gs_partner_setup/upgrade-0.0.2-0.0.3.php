<?php
$installer = $this;
$installer->startSetup();
$installer->getConnection()
    ->addColumn($installer->getTable('sales/order_item'), 'to_partner', array(
        'type' => Varien_Db_Ddl_Table::TYPE_BOOLEAN,
        'nullable' => true,
        'comment' => 'Who own the item(partner or warehouse)'
    ));
$installer->endSetup();