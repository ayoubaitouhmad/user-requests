<?php

namespace App\classes;

class ErrorHandler
{
    protected $errors = [];
    protected $currentField = [];


    public function addError($key = null, $error)
    {
        if ($key) {
            $this->errors[$key][] = $error;

        } else {
            $this->errors[] = $error;
        }
    }

    public function hasError(): bool
    {
        return count($this->errors) > 0;
    }

    function all()
    {
        return $this->hasError() ? $this->errors : '';
    }


    function field($key)
    {
        if (isset($this->errors[$key])) {
            $this->currentField = $this->errors[$key];
        }
        return $this;
    }


    function hasErrors($error)
    {
        if (count($this->currentField) > 0) {
            return in_array($error, $this->currentField);
        }
        else{
            return false;
        }
    }

    function errors($index = null)
    {
        if (isset($index) && isset($this->currentField[$this->getLastIndexIFNotExists($index)])) {
            return $this->currentField[$this->getLastIndexIFNotExists($index)];
        } else {
            return $this->currentField;
        }
    }

    private function getLastIndexIFNotExists($index)
    {
        $found = false;
        if (!empty($index)) {
            if (function_exists('array_key_last')) {
                $found = array_key_exists($index, $this->currentField) ? $index : array_key_last($this->currentField);
            }
        }
        return $found;
    }


    function destroy($key)
    {
        if (!empty($key)) {
            unset($this->errors[$key]);
        }
    }
	
	function destroyAll()
	{
		$this->errors = [];
		$this->currentField = "";
	}
 
 


}