<?php

/**
 * This script is executed when the plugin is deactivated.
 */

// Remove the menu item from the main menu
OW::getNavigation()->deleteMenuItem('file_manager', 'main_menu_item');

// You can add more deactivation logic here if needed
