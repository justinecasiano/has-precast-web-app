<?php

// This file will change things in the database

class Dbh {

    //Connects with the database
    protected function connect(){
        try{
            $db_username = "has_admin";
            $db_password = "wc8KTRfrJrTpe8";
            $dbh = new PDO('mysql:host=localhost;dbname=has_precast;', $db_username, $db_password);
            return $dbh;
        }
        catch(PDOException $e){
            print "Error!: " . $e->getMessage() . "<br>";
        }
    }

}