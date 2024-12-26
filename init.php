<?php
OW::getRouter()->addRoute(new OW_Route('file_manager_index', 'file-manager', 'FILE_MANAGER_CTRL_File', 'index'));
OW::getRouter()->addRoute(new OW_Route('file_manager_upload', 'file-manager/upload', 'FILE_MANAGER_CTRL_File', 'upload'));
OW::getRouter()->addRoute(new OW_Route('file_manager_download', 'file-manager/download/:id', 'FILE_MANAGER_CTRL_File', 'download'));

OW::getPluginManager()->addPluginSettingsRouteName('file_manager', 'file_manager_index');
