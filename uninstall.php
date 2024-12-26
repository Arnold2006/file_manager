<?php

/**
 * This script is executed when the plugin is uninstalled.
 */

// Remove the database table
OW::getDbo()->query('DROP TABLE IF EXISTS `' . OW_DB_PREFIX . 'file_manager`');

// Remove all uploaded files
$pluginFilesPath = OW::getPluginManager()->getPlugin('file_manager')->getUserFilesDir();
if (file_exists($pluginFilesPath)) {
    $files = glob($pluginFilesPath . '*', GLOB_MARK);
    foreach ($files as $file) {
        if (is_file($file)) {
            unlink($file);
        }
    }
    rmdir($pluginFilesPath);
}

// Remove plugin preferences
BOL_PreferenceService::getInstance()->deleteSection('file_manager');

// You can add more uninstallation logic here if needed
