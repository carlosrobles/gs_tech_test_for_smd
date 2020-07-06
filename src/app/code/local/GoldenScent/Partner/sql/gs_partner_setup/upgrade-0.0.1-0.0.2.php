<?php
$installer = $this;
$installer->startSetup();
$installer->getConnection()
    ->addColumn($installer->getTable('sales/order'), 'partner', array(
        'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
        'nullable' => true,
        'length' => 255,
        'comment' => 'Partner unique code'
    ));
$installer->endSetup();