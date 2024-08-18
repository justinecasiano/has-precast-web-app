<?php
if(isset($_POST["submit"])){

    // Grabs Data
    $ModeratorID = $_GET["ModeratorID"];    
    $name = $_POST["name"];
    $email = $_POST["email"];
    
    if(
        empty($name) ||
        empty($email) 
    ){
        $message = urlencode('Complete the Form Field to Edit the Editor!');
        header("location: ../../../has-precast/account-management-editor.php?message={$message}&top=10&type=error");
        exit();
    }

    // Run Controller Class
    include ("../../classes/dbh.classes.php");
    include ("../../classes/admin-account-repo.php");
    include ("../../classes/edit-editor-ctrl-classes.php");


    $edit = new EditEditorCtrl($ModeratorID, $name, $email);
    
    
    // Handles errors and User Signup
    $edit->editEditor();

    // Goes back to Signup Form
    $message = urlencode('Editor &#34;'. $name .'&#34; has been Updated Successfully!');
    header("location: ../../../has-precast/account-management-editor.php?message={$message}&top=10&type=success");
    exit();
}

else{
    header("location: ../../account-management-editor.php");
}