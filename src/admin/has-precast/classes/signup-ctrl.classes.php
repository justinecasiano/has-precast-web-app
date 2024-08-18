<?php

class SignupContr extends AccountRepository{

    private $first_name;
    private $last_name;
    private $email;
    private $password;
    private $confirm_password;

    public function __construct($first_name, $last_name, $email, $password, $confirm_password){
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->password = $password;
        $this->confirm_password = $confirm_password;
    }

    //Checks for error if errors aren't found signs up the user
    public function signupUser(){
        if($this->emptyInput() == false){
            header("location: ../../client-sign-up.php?error=emptyinput");
            exit();
        }
        if($this->invalidName() == false){
            header("location: ../../client-sign-up.php?error=nametaken");
            exit();
        }
        if($this->invalidEmail() == false){
            header("location: ../../client-sign-up.php?error=emailtaken");
            exit();
        }
        if($this->passwordMatch() == false){
            header("location: ../../client-sign-up.php?error=passwordmismatch");
            exit();
        }
        if($this->userCheck() == false){
            header("location: ../../client-sign-up.php?error=useralreadyexists");
            exit();
        }

        $this->setUser($this->first_name, $this->last_name, $this->email, $this->password);
    }

    private function emptyInput(){
        $result = false;

        if(empty($this->first_name) || 
           empty($this->last_name) || 
           empty($this->email) || 
           empty($this->password) ||
           empty($this->confirm_password))
        {
            $result = false;
        }
        else{
            $result = true;
        }

        return $result;
    }

    private function invalidName(){
        $result = false;
        if(!preg_match("/^[a-zA-Z]*$/", $this->first_name) || 
           !preg_match("/^[a-zA-Z]*$/", $this->last_name))
        {    
            $result = false;
        }
        else{
            $result = true;
        }

        return $result;
    }

    private function invalidEmail(){
        $result = false;
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL))
        {    
            $result = false;
        }
        else{
            $result = true;
        }

        return $result;
    }

    private function passwordMatch(){
        $result = false;
        if($this->password !== $this->confirm_password)
        {    
            $result = false;
        }
        else{
            $result = true;
        }

        return $result;
    }

    private function userCheck(){
        $result = false;
        if(!$this->checkUser($this->first_name, $this->last_name, $this->email))
        {    
            $result = false;
        }
        else{
            $result = true;
        }

        return $result;
    }
}