<?php
	
	/** @noinspection PhpOptionalBeforeRequiredParametersInspection */
	declare(strict_types=1);
/**
 *
 */
namespace App\interfaces;
/**
 *
 */
interface CrudInterface{
	
	/**
	 * @param $record
	 * @return mixed
	 */
	public function create($record);
	
	
	
	/**
	 * @param $query
	 * @param $fetchType
	 * @param array $data
	 * @return mixed
	 */
	public function read($query, $fetchType, array $data = []);
	
	
	
	/**
	 * @param $record
	 * @return mixed
	 */
	public function update($record);
	
	
	
	/**
	 * @param $id
	 * @return mixed
	 */
	public function delete($id);
	
	
	
	/**
	 * @return mixed
	 */
	public function all();
	
	
	
	/**
	 * @param $id
	 * @return mixed
	 */
	public function get($id);

}


