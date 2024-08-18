<?php

class AdminLoginContr extends AccountRepository{

    private $email;
    private $password;

    public function __construct($email, $password){
        $this->email = $email;
        $this->password = $password;
    }

    //Checks for error if errors aren't found signs up the user
    public function loginUser(){
        if($this->emptyInput() == false){
            header("location: ../../admin-log-in.php?error=emptyinput");
            exit();
        }

        $this->getUser($this->email, $this->password);
    }

    private function emptyInput(){
        $result = false;

        if(empty($this->email) || empty($this->password))
        {
            $result = false;
        }
        else{
            $result = true;
        }

        return $result;
    }
}