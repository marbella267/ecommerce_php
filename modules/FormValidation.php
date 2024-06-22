<?php
class FormValidation{
    public $data;
    private $errors=[];
    public function __construct($post_data){
        $this -> data = $post_data;
    }
    public function ValidateForm(){
        foreach ($this -> data as $key => $value) {
             if($value==''){
                $this -> addError($key , "please enter your ".$key);
             }
            
        }
        if(count($this -> errors)!=0 ){
                return $this -> errors;
            }
        $this -> ValidateEmail();
        $this -> ValidateName();
        $this -> ValidatePassword();
        $this -> ValidatePhone();
        return $this -> errors;
   
    }
    private function ValidateEmail(){
        $val = trim($this -> data['email']);
            if(!filter_var($val,FILTER_VALIDATE_EMAIL)){
                $this -> addError('email','email must be valid');
            }
    }
    private function ValidateName(){
        $val = trim($this -> data['name']);
        if(!preg_match('/^[a-zA-z0-9]*$/',$val)){
            $this -> addError('name','name must be valid');
        }
    }
    private function ValidatePassword(){
        if(!preg_match("/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/",$this-> data['password'])){
            $this -> addError('password','password must be strong');
        }
    }
    private function ValidatePhone(){
        if(!preg_match('/^[0-9]{11}+$/',$this -> data['phone'])){
            $this -> addError('phone','phone must be valid');
        }
    }
    private function addError($key,$val){
        return $this -> errors[$key]=$val;
    }  
    
}