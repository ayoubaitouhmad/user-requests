<?php

namespace App\classes\base;

use App\interfaces\UploadFile;
use function Symfony\Component\Translation\t;

class UploadImage extends File implements UploadFile
{

    /**
     * where file where move
     * @var $targetFolder
     */
    protected $targetFolder;

    protected $fullPath;
    
    
    public  static  $test;


    /**
     * max image size accepted
     * size : byte
     */
    const FILE_SIZE = 2097152;

    /**
     *  image format accepted to upload
     */
    const imgFormatAccept = array(
        'tiff',
        'tif',
        'bmp',
        'jpg',
        'jpeg',
        'webp',
        'png'
    );

    const targetFolder = 'uploads/users/images/';

    /**
     * @return mixed
     */
    public function getTargetFolder()
    {
        return $this->targetFolder;
    }

    /**
     * @param mixed $targetFolder
     */
    public function setTargetFolder($targetFolder)
    {
        $this->targetFolder = $targetFolder;
    }

    public function __construct($file)
    {
        $this->setFile($file);
        $this->init();
    }


    public function init()
    {
        $file = $this->getFile();
        $pathInfo = pathInfo($file['name']);
        $this->setPathInfo($pathInfo);

        $this->setFileTempPath($file['tmp_name']);
        $this->setFileSize($file['size']);

        $this->setFileFormat($pathInfo['extension']);
        $this->setFileName($pathInfo['filename']);
    }

    public function isValidType()
    {
        return in_array($this->fileFormat, self::imgFormatAccept);
    }


    public function createFolder()
    {
        if(!file_exists(self::targetFolder)){
             mkdir(self::targetFolder, 0755, true);
        }
        return true;
    }



    public function generateFileName()
    {
        return $this->fullPath = self::targetFolder . 'img_' . md5($this->fileName) .'.' . $this->fileFormat;
    }
	
	public static function generate()
	{
		return  self::targetFolder . 'img_' . md5(self::$test) .'.' . 'jpg';
	}
    
    public function isDuplicateFile()
    {
        return file_exists($this->fullPath);
    }

    public function move()
    {
        return move_uploaded_file($this->fileTempPath, $this->fullPath);
    }

    public function save()
    {
        $this->generateFileName();
        $this->createFolder();
        if (!$this->isDuplicateFile() && $this->isValidType() && $this->isValidSize()) {
            return $this->move();
        } else
            return false;

    }

    public function isValidSize()
    {
        return $this->fileSize < self::FILE_SIZE;
    }
}