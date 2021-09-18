<?php
	
	declare(strict_types=1);
	
	
	namespace App\controllers\helpers;


use App\classes\CSRF;
use App\classes\ErrorHandler;
use App\classes\Request;
use App\classes\Validator;
use App\interfaces\Controller;

class RefreshPageController implements Controller
{
	
	
	/**
	 * @return void
	 */
	public function index()
	{
		echo view('helpers/refresh');
	}
}