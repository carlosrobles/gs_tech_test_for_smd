<?php
$installer = $this;
$installer->startSetup();
$installer->run("
    CREATE TABLE `{$installer->getTable('goldenscent_partner/partner')}` (
      `id` int(11) NOT NULL auto_increment,
      `display_name` VARCHAR(255) NOT NULL,
      `unique_code` VARCHAR(255) NOT NULL UNIQUE ,
      `status` boolean DEFAULT true,
      PRIMARY KEY  (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    INSERT INTO 
        `{$installer->getTable('goldenscent_partner/partner')}`(
        display_name,
        unique_code
        )
        VALUES 
            ('Mall Of The Emirates Store','moe'),
            ('Burjuman Mall Store','bm'),
            ('City Center Store','cc'),
            ('Dubai Mall Store','dm');
");
$installer->endSetup();