<?php
$sql = "CREATE TABLE IF NOT EXISTS `" . OW_DB_PREFIX . "file_manager` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `userId` int(11) NOT NULL,
    `fileName` varchar(255) NOT NULL,
    `filePath` varchar(255) NOT NULL,
    `uploadDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

OW::getDbo()->query($sql);
