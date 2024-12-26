<?php

/**
 * This script is executed when the plugin is activated.
 */

OW::getPluginManager()->addPluginSettingsRouteName('file_manager', 'file_manager_index');

// Add a menu item in the main menu
OW::getNavigation()->addMenuItem(
    OW_Navigation::MAIN,
    'file_manager_index',
    'file_manager',
    'main_menu_item',
    OW_Navigation::VISIBLE_FOR_MEMBER
);

// You can add more activation logic here if needed
