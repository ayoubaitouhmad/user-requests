<?php
use App\classes\base\UploadImage as uploader;

function getFileFromDirByName($filetarget, $dirpath = uploader::targetFolder)
{
    $target = '';
    foreach (scandir($dirpath) as $file) {
        $filename = pathinfo($file)['filename'];
        $all = pathinfo($file)['basename'];
        $pos = strpos($filename, '_');
        $filename = substr($filename, $pos + 1, strlen($filename));
        if ($filename === md5($filetarget)) {
            $target = $all;
            break;
        }
    }
    return !empty($target) ?  '/' . $dirpath . $target : '';

}
//fdf21-08-21-02-11-09
function getDirFileCount($dir)
{
    $directory = $dir;
    $files = glob($directory . '*.*');   // returns an array on success and false on error.
    var_dump($files);
    if ($files !== false) {
       return count($files);

    } else {
        return false;
    }
}


function deleteUserImageByFileName($filename){
    $filepath = uploader::targetFolder .'img_'. $filename . '.jpg';
    if(file_exists($_SERVER['DOCUMENT_ROOT'].$filepath)){
        unlink($filepath);
    }
}

function deleteFile($file){
	$fullPath = $_SERVER['DOCUMENT_ROOT'].$file;
	if(file_exists($fullPath)){
		unlink($fullPath);
	}
	
}



