<?php

class FILE_MANAGER_BOL_FileDao extends OW_BaseDao
{
    protected function __construct()
    {
        parent::__construct();
    }
    
    private static $classInstance;

    public static function getInstance()
    {
        if (self::$classInstance === null) {
            self::$classInstance = new self();
        }
        return self::$classInstance;
    }

    public function getDtoClassName()
    {
        return 'FILE_MANAGER_BOL_File';
    }

    public function getTableName()
    {
        return OW_DB_PREFIX . 'file_manager';
    }

    public function findFilesByUserId($userId)
    {
        $example = new OW_Example();
        $example->andFieldEqual('userId', $userId);
        return $this->findListByExample($example);
    }
}

class FILE_MANAGER_BOL_File extends OW_Entity
{
    public $userId;
    public $fileName;
    public $filePath;
    public $uploadDate;
}
