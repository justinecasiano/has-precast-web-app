<?php
    
if(isset($_POST["submit"])){


    // Grabs Data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    if(
        empty($name) ||
        empty($email) ||
        empty($password) ||
        empty($confirm_password) 
    ){
        $message = urlencode('Complete the Form Field to Add New Editors!');
        header("location: ../../../has-precast/account-management-editor.php?message={$message}&top=10&type=error");
        exit();
    }

    // Run Controller Class
    include ("../../classes/dbh.classes.php");
    include ("../../classes/admin-account-repo.php");
    include ("../../classes/add-editor-ctrl-classes.php");

    $add = new AddEditorCtrl($name, $email, $password, $confirm_password);

    
    // Handles errors and User Signup
    $add->addEditor();


    // Goes back to Signup Form
    $message = urlencode('New Editor &#34;'. $name .'&#34; has been Added!');
    header("location: ../../../has-precast/account-management-editor.php?message={$message}&top=10&type=success");
    exit();

}

else{
    header("location: ../../account-management-editor.php");
}