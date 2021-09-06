<?php


namespace App\classes;


class UploadFile
{

    protected $fileName;
    protected $targetFolder;
    protected $tempPath;
    protected $fileExtension;
    protected $fileSize;

    const FILE_SIZE = 2097152000;
    const imgFormatAccept = array(
        'tiff',
        'tif',
        'bmp',
        'jpg',
        'jpeg',
        'webp',
        'png'
    );


    /**
     * @return mixed
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    public function setFileName($filename)
    {
        $this->fileName = $filename;
        return $filename;
    }

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


    /**
     * get file info from global var $_FILE
     * @param $file
     * @return bool
     */
    public function init($file)
    {
        if (isset($file)) {
            $fileInfo = pathinfo($file['name']);
            $this->fileExtension = strtolower($fileInfo['extension']);
            $this->fileSize = $file['size'];
            return true;
        } else {
            return false;
        }
    }

    /**
     * check if image valid size,ext
     * @return false|string
     */
    protected function isValidImage()
    {
        if (in_array($this->fileExtension, self::imgFormatAccept) && $this->fileSize > self::FILE_SIZE) {
            return  true;
        }
        else{
            return false;
        }
    }

    /**
     * check if the given folder exists or not
     * @return bool
     */
    protected function isValidFolder()
    {
        if(!is_dir($this->targetFolder)){
             mkdir($this->targetFolder , 0755);
        }
        return true;
    }

    /**
     * check if file already in the target folder
     * @param $fullpath
     * @return bool
     */
    protected function isDuplicateFile($fullpath){
        return file_exists($fullpath);
    }


    /**
     * move the file to the target folder
     * @return bool
     */
    public  function save(){



//        $meObj->setFileName('d');
//        $path_filename_ext = $meObj->targetFolder . $meObj->getFileName() . $meObj->fileExtension;
//        if($meObj->isValidImage() && $meObj->isValidFolder() && !file_exists($path_filename_ext)){
//            move_uploaded_file($meObj->tempPath , $path_filename_ext );
//            return true;
//        }else
//            return false;
    }

    /**
     * convert byte to megabyte
     * @param $byte
     * @return float|int
     */
    function byteToMega($byte)
    {
        return $byte * 1024 * 1024;
    }


}