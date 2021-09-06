<?php

namespace App\classes\base;

class File
{

    protected $file;

    protected $fileName;

    protected $fileSize;

    protected $fileFormat;

    protected $fileTempPath;

    protected $pathInfo;


    /**
     * @return mixed
     */
    public function getPathInfo()
    {
        return $this->pathInfo;
    }

    /**
     * @param mixed $pathInfo
     */
    public function setPathInfo($pathInfo)
    {
        $this->pathInfo = $pathInfo;
    }

    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param mixed $file
     */
    public function setFile($file)
    {
        $this->file = $file;
    }

    /**
     * @return mixed
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * @param mixed $fileName
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
    }

    /**
     * @return mixed
     */
    public function getFileSize()
    {
        return $this->fileSize;
    }

    /**
     * @param mixed $fileSize
     */
    public function setFileSize($fileSize)
    {
        $this->fileSize = $fileSize;
    }

    /**
     * @return mixed
     */
    public function getFileFormat()
    {
        return $this->fileFormat;
    }

    /**
     * @param mixed $fileFormat
     */
    public function setFileFormat($fileFormat)
    {
        $this->fileFormat = $fileFormat;
    }

    /**
     * @return mixed
     */
    public function getFileTempPath()
    {
        return $this->fileTempPath;
    }

    /**
     * @param mixed $fileTempPath
     */
    public function setFileTempPath($fileTempPath)
    {
        $this->fileTempPath = $fileTempPath;
    }






}