<?php

namespace App\classes;

class Validator
{
    protected $errorHandler;
    protected $field;
    protected $value;
    protected $rules;


    const RULES = array(
        'required',
        'length',
        'email',
        'maxLength',
        'minLength',
        'text',
        'number',
        'phone',
        'address',
        'gender',
        'date',
        'password'
    );

    const REGEX = [
        'phone' => [
            'mar' => '/^(?!\+@$)([0-9]{10})$/',
        ],
        'address' => "/^[a-zA-Z0-9'\s.]*$/",
        'date' => "/^\d{4}[\-\/\s]?((((0[13578])|(1[02]))[\-\/\s]?(([0-2][0-9])|(3[01])))|(((0[469])|(11))[\-\/\s]?(([0-2][0-9])|(30)))|(02[\-\/\s]?[0-2][0-9]))$/",
        'password' => "/^(?:(?:(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]))|(?:(?=.*[a-z])(?=.*[A-Z])(?=.*[*.!@$%^&(){}[]:;<>,.?/~_+-=|\]))|(?:(?=.*[0-9])(?=.*[A-Z])(?=.*[*.!@$%^&(){}[]:;<>,.?/~_+-=|\]))|(?:(?=.*[0-9])(?=.*[a-z])(?=.*[*.!@$%^&(){}[]:;<>,.?/~_+-=|\]))).{8,32}$/"
    ];


    const MESSAGES = [
        'required' => " sorry ,  field is required",
        'length' => " sorry , field must be  regex characters. ",
        'email' => ' sorry , enter a valid email like(name@domain.com).',
        'maxLength' => ' sorry , field can accept only regex. ',
        'minLength' => ' sorry , field must be at least regex characters. ',
        'text' => ' sorry, field can only contain character and spaces.',
        'number' => ' sorry , field can only contain real number',
        'phone' => ' sorry , field can only contain 10 number (Ex : 0606060606)',
        'address' => 'sorry, field can only contain character,numbers and spaces.',
        'gender' => 'sorry , field accept men and women only.',
        'date' => 'sorry , field accept men and women only.',
        'password' => 'sorry , must be al least 8 characters (numbers,characters,symbol ...).'

    ];
    function __construct(ErrorHandler $errorHandler)
    {
        $this->errorHandler = $errorHandler;
    }

    function add($items, $rules)
    {
        foreach ($items as $item => $value) {

            if (in_array($item, array_keys($rules))) {
                $this->field = $item;
                $this->value = $value;
                $this->rules = $rules[$item];
                $this->validate();
            }
        }
    }

    public function getErrors()
    {
        return $this->errorHandler->all();
    }


    function validate()
    {
        $field = $this->field;
        foreach ($this->rules as $rule => $regex) {
            if (in_array($rule, self::RULES)) {
                if (method_exists($this, '' . $rule)) {
                    if (call_user_func_array([$this, $rule], [$this->value, $regex])) {
                    } else {
                        if (in_array($rule, array_keys(self::MESSAGES))) {
                            $message = self::MESSAGES[$rule];
                            if (str_contains($message, 'field')) {
                                $message = str_replace('field', $field, $message);
                            }
                            if (str_contains($message, 'regex')) {
                                $message = str_replace('regex', $regex, $message);
                            }
                            if (!$this->errorHandler->field($field)->hasErrors($message)) {
                                $this->errorHandler->addError($field, $message);
                            }
                        }else{
                            $this->errorHandler->addError($field, 'error');
                        }
                    }
                }

            }
        }

    }

    private function required($value, $regex)
    {
        if ($regex) {
            return !empty(trim($value));
        } else
            return true;
    }

    private function length($val, $regex)
    {
        return strlen($val) == $regex;
    }

    private function email($val, $regex)
    {
        if ($regex) {
            return filter_var($val, FILTER_VALIDATE_EMAIL);
        } else
            return true;
    }


    private function maxLength($val, $regex)
    {
        if (!empty($regex)) {
            return strlen($val) <= $regex;
        } else
            return true;
    }


    private function minLength($val, $regex)
    {
        if (!empty($regex)) {
            return strlen($val) >= $regex;
        } else
            return true;
    }


    private function number($val, $regex)
    {
        if ($regex) {
            return filter_var($val, FILTER_VALIDATE_INT);
        } else
            return true;
    }


    private function text($val, $regex)
    {
        if ($regex) {
            $option = array(
                'options' => array('regexp' => '/^[a-zA-Z ]*$/')
            );
            return filter_var($val, FILTER_VALIDATE_REGEXP, $option) == $val;
        } else
            return true;
    }


    private function phone($val, $regex)
    {
        if (!empty($regex) && in_array($regex, array_keys(self::REGEX))) {
            $valid = false;
            switch (strtolower(trim($regex))) {
                case 'mr' || 'mar':
                    $option = array(
                        'options' => array('regexp' => self::REGEX['phone']['mar'])
                    );
                    $valid = filter_var($val, FILTER_VALIDATE_REGEXP, $option) == $val;
            }
            return $valid;
        } else
            return true;
    }


    private function address($val, $regex)
    {
        if (!empty($regex) and $regex) {
            $option = array(
                'options' => array('regexp' => self::REGEX['address'])
            );
            return filter_var($val, FILTER_VALIDATE_REGEXP, $option) == $val;
        } else
            return true;

    }

    private function gender($val, $regex)
    {
        if ($regex) {
            return $val == 'male' || $val == 'female';
        } else
            return true;
    }

    private function date($val, $regex)
    {
        if ($regex) {
            $option = array(
                'options' => array('regexp' => self::REGEX['date'])
            );
            return filter_var($val, FILTER_VALIDATE_REGEXP, $option) == $val;
        } else
            return true;
    }


    private function password($val, $regex)
    {
        if ($regex) {
            $option = array(
                'options' => array('regexp' => self::REGEX['password'])
            );
            return filter_var($val, FILTER_VALIDATE_REGEXP, $option) == $val;
        } else
            return true;
    }


}