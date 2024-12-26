<?php

class FILE_MANAGER_CTRL_File extends OW_ActionController
{
    public function index()
    {
        if (!OW::getUser()->isAuthenticated()) {
            $this->redirect(OW::getRouter()->urlForRoute('base_index'));
        }

        $userId = OW::getUser()->getId();
        $fileDao = FILE_MANAGER_BOL_FileDao::getInstance();
        $files = $fileDao->findFilesByUserId($userId);

        $this->assign('files', $files);
    }

    public function upload()
    {
        if (!OW::getUser()->isAuthenticated()) {
            exit(json_encode(['error' => 'Authentication required']));
        }

        if (!empty($_FILES['file'])) {
            $userId = OW::getUser()->getId();
            $fileName = $_FILES['file']['name'];
            $filePath = OW::getPluginManager()->getPlugin('file_manager')->getUserFilesDir() . $fileName;

            if (move_uploaded_file($_FILES['file']['tmp_name'], $filePath)) {
                $fileDao = FILE_MANAGER_BOL_FileDao::getInstance();
                $file = new FILE_MANAGER_BOL_File();
                $file->userId = $userId;
                $file->fileName = $fileName;
                $file->filePath = $filePath;
                $fileDao->save($file);

                exit(json_encode(['success' => true]));
            }
        }

        exit(json_encode(['error' => 'Upload failed']));
    }

    public function download($params)
    {
        if (!OW::getUser()->isAuthenticated()) {
            $this->redirect(OW::getRouter()->urlForRoute('base_index'));
        }

        $fileId = $params['id'];
        $fileDao = FILE_MANAGER_BOL_FileDao::getInstance();
        $file = $fileDao->findById($fileId);

        if ($file && $file->userId == OW::getUser()->getId()) {
            $filePath = $file->filePath;
            if (file_exists($filePath)) {
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="' . $file->fileName . '"');
                header('Content-Length: ' . filesize($filePath));
                readfile($filePath);
                exit;
            }
        }

        $this->redirect(OW::getRouter()->urlForRoute('file_manager_index'));
    }
}
