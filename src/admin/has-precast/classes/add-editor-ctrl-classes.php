<?php

class AddEditorCtrl extends AccountRepository
{

    private $name;
    private $email;
    private $password;
    private $confirm_password;

    public function __construct($name, $email, $password, $confirm_password)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->confirm_password = $confirm_password;
    }

    //Checks for error if errors aren't found signs up the user
    public function addEditor()
    {
        if ($this->emptyInput() == false) {
            $message = urlencode('Complete the Form Field to add a New Editor!');
            header("location: ../../account-management-editor.php?message={$message}&top=10&type=error");
            exit();
        }
        if ($this->invalidName() == false) {
            $message = urlencode('Name Format is Invalid!');
            header("location: ../../account-management-editor.php?message={$message}&top=10&type=error");
            exit();
        }
        if ($this->invalidEmail() == false) {
            $message = urlencode('Email Format is Invalid!');
            header("location: ../../account-management-editor.php?message={$message}&top=10&type=error");
            exit();
        }
        if ($this->passwordMatch() == false) {
            $message = urlencode('Passwords do not Match!!');
            header("location: ../../account-management-editor.php?message={$message}&top=10&type=error");
            exit();
        }
        if ($this->userCheck() == false) {
            $message = urlencode('User Already Exists use another email!');
            header("location: ../../account-management-editor.php?message={$message}&top=10&type=error");
            exit();
        }

        $this->setEditor($this->name, $this->email, $this->password);
    }

    private function emptyInput()
    {
        $result = false;

        if (
            empty($this->name) ||
            empty($this->email) ||
            empty($this->password) ||
            empty($this->confirm_password)
        ) {
            $result = false;
        } else {
            $result = true;
        }

        return $result;
    }

    private function invalidName()
    {
        $result = false;
        if (!preg_match("/^[a-zA-Z]*$/", $this->name)) {
            $result = false;
        } else {
            $result = true;
        }

        return $result;
    }

    private function invalidEmail()
    {
        $result = false;
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $result = false;
        } else {
            $result = true;
        }

        return $result;
    }

    private function passwordMatch()
    {
        $result = false;
        if ($this->password !== $this->confirm_password) {
            $result = false;
        } else {
            $result = true;
        }

        return $result;
    }

    private function userCheck()
    {
        $result = false;
        if (!$this->checkEditor($this->name, $this->email)) {
            $result = false;
        } else {
            $result = true;
        }

        return $result;
    }
}
