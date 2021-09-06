<?php


namespace App\controllers\admin\dashboard;


use App\classes\AxiosHttpRequest;
use App\classes\CrudErrors;
use App\classes\Redirect;
use App\classes\Session;
use Exception;

/**
 *
 */
class DashboardController
{
	
	protected  $currentAdmin;
	
	
	
	/**
	 * @throws Exception
	 */
	public function  __construct()
	{
		if (!isAuthenticated()) {
			Redirect::To('/admin/login');
		}
		
		$this->currentAdmin = Session::get('admin-connected');
	}
	
	
	
	/**
	 *
	 * @throws Exception
	 */
	public function  index(){
		$admin = [
			'name' => $this->currentAdmin->admin_name,
			'photo' => getFileFromDirByName($this->currentAdmin->admin_photo)
		];
        return view('admin/dashboard/dashboard', compact('admin'));
    }
	
	
	public function logout(){
		if (AxiosHttpRequest::has('data')) {
			Session::remove('admin-connected');
			
			echo cleanJSON([
				'header' =>'logout',
				
			]);
		}else{
			echo cleanJSON([
				'header' => CrudErrors::ERROR,
				'body' => CrudErrors::error()
			]);
		}
		
	}
}