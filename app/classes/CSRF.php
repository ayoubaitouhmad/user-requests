<?php


namespace App\classes;


use Exception;

class CSRF
{

  /*
  *  token : var witch contain the final output token
  *  codeAlphabet : for merging letters,nulbers,symbole ...
  */
    protected  $token;
    protected $codeAlphabet;


    /**
     * Constructor.
     */

    public function __construct()
    {
        $this->init();
    }


    function __destruct() {
      unset($this->token);
      unset($this->codeAlphabet);
    }


    /**
     * initialize variable
     * start session
     */

    private  function init(){
        $this->token = "";
        $this->codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $this->codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
        $this->codeAlphabet .= "0123456789";
        if(session_id() === '')
            session_start();
    }


    /** get random number between two numbers
     * @param $min
     * @param $max
     * @return int
     */
    private  function rand( $max)
    {
        return rand(0,$max);
    }


    /** generate  random  token from  codeAlphabet
     * @param int $length
     * @return mixed
     */
    public  function  getToken(int $length = 30)
    {
        $max = strlen($this->codeAlphabet);
        for ($i = 0; $i < $length; $i++) {
            $this->token .= $this->codeAlphabet[$this->rand( $max - 1)];
        }
        return $this->token;
    }

	
	
	/**
	 * after token is generated this function will add it to a session
	 * @return false|mixed
	 * @throws Exception
	 */
	public function token(){
		if(Session::has('token'))
		{
			return Session::get('token');
		}else{
			return Session::add('token',$this->getToken());
		}
    }
	
	
	
	/** verify if session has token or not
	 * @param $token
	 *
	 * @throws Exception
	 */
    public function verifyToken($token){
        if(Session::has('token') && Session::get('token') == $token){
            return true;
        }else{
            return false;
        }
    }
	
	
	
	/**
	 * @throws Exception
	 */
	public function destroy(){
        Session::remove('token');
//        session_destroy();
    }



	
	
	
	/**
	 * @param int $length
	 * @return mixed
	 */
	public  function  getValidationCode(int $length = 6)
	{
		$numbers = '0123456789';
		$max = strlen($numbers);
		$code = '';
		for ($i = 0; $i < $length ; $i++) {
			$code .= $numbers[$this->rand( $max - 1)];
		}
		return $code;
	}
	
	public function refresh(){
		return Session::add('token',$this->getToken());
	}
	
	
}