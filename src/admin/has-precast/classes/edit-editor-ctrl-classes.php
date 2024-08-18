<?php

class EditEditorCtrl extends AccountRepository
{

    private $ModeratorID;
    private $name;
    private $email;

    public function __construct($ModeratorID, $name, $email)
    {
        $this->ModeratorID = $ModeratorID;
        $this->name = $name;
        $this->email = $email;
    }

    //Checks for error if errors aren't found signs up the user
    public function editEditor()
    {
        if ($this->emptyInput() == false) {
            $message = urlencode('Complete the Form Field to Edit the Editor!');
            header("location: ../../edit-editor.php?message={$message}&top=10&type=error");
            exit();
        }
        if ($this->invalidName() == false) {
            $message = urlencode('Name is not valid!');
            header("location: ../../edit-editor.php?message={$message}&top=10&type=error");
            exit();
        }
        if ($this->invalidEmail() == false) {
            $message = urlencode('Email format is not correct!');
            header("location: ../../edit-editor.php?message={$message}&top=10&type=error");
            exit();
        }
        $this->updateEditor($this->ModeratorID, $this->name, $this->email);
    }

    private function emptyInput()
    {
        $result = false;

        if (
            empty($this->name) ||
            empty($this->email)
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
}
