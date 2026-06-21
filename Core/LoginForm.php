<?php

namespace Core;
use Core\ValidationException;

class LoginForm {

    protected $errors = [];

    public function __construct(public array $attributes)
    {
        if(! \Core\Validator::string($attributes['username'])){
            $this->errors['username'] = 'Please provide a valid username.';
        }
    
        if(! \Core\Validator::string($attributes['password'], 8)){
            $this->errors['password'] = 'Please provide a valid password';
        }
    }
    public static function validate($attributes){

        $instance = new static($attributes);

        return $instance->failed() ? $instance->throw() : $instance;
    }

    public function throw(){
        ValidationException::throw($this->errors(), $this->attributes);
    }

    public function failed(){
        return count($this->errors);
    }

    public function errors(){
        return $this->errors;
    }

    public function error($field, $message){
        $this->errors[$field] = $message;

        return $this;
    }
}
