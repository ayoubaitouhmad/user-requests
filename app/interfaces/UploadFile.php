<?php


namespace App\interfaces;


/**
 *
 */
interface UploadFile
{
	
	
	/**
	 * @return mixed
	 */
	public function isValidType();
	
	
	
	/**
	 * @return mixed
	 */
	public function isValidSize();
	
	
	
	/**
	 * @return mixed
	 */
	public function createFolder();
	
	
	
	/**
	 * @return mixed
	 */
	public function isDuplicateFile();
	
	
	
	/**
	 * @return mixed
	 */
	public function move();
	
	
	
	/**
	 * @return mixed
	 */
	public function save();







}