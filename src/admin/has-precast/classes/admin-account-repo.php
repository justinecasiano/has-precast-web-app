<?php

class AccountRepository extends Dbh{

    protected function getUser($email, $password){

        //Query to grab the password from the database
        $query = $this->connect()->prepare('SELECT * FROM Moderator WHERE email = ? OR password = ?;');

        //Checks if the query ran if not sends the user back into the login page
        if(!$query->execute(array($email, $password))){
            $query = null;
            header("location: ../../admin-log-in.php?error=queryfailed");
            exit();
        }
        
        if($query->rowCount() == 0){
            $query = null;
            header("location: ../../admin-log-in.php?error=usernotfound");
            exit();
        }

        //Hashes the fetched password
        $passwordHashed = $query->fetchAll(PDO::FETCH_ASSOC);
        $checkpassword = password_verify($password, $passwordHashed[0]["password"]);

        //Checks if the inputted password is the same as the Fetched password
        if($checkpassword == false){
            $query = null;
            header("location: ../../admin-log-in.php?error=wrongpassword");
            exit();
        }
        elseif($checkpassword == true){
            $query = null;
            $query = $this->connect()->prepare('SELECT * FROM Moderator WHERE email = ? AND password = ?;');
        
            if(!$query->execute(array($email, $passwordHashed[0]["password"]))){
                $query = null;
                header("location: ../../admin-log-in.php?error=queryfailed");
                exit();
            }

            if($query->rowCount() == 0){
                $query = null;
                header("location: ../../admin-log-in.php?error=usernotfounds");
                exit();
            }

            $user = $query->fetchAll(PDO::FETCH_ASSOC);
            
            session_start();
            $_SESSION["userid"] = $user[0]["name"];
            $_SESSION["userAccountType"] = $user[0]["type"];
        }

        $query = null;
    }

    protected function setEditor($name, $email, $password){

        //Query to insert the users details into the database
        $query = $this->connect()->prepare('INSERT INTO Moderator (name, email, password)
                                            Values(?, ?, ?);');

        //Hashes the password for security
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        //Checks if the query ran if not sends the user back into the sign up page
        if(!$query->execute(array($name, $email, $hashedPassword))){
            $query = null;
            header("location: ../../add-editor.php?error=queryfailed");
            exit();
        }
        
        $query = null;
    }
   
    protected function checkEditor($name, $email){

        //Query to get columns
        $query = $this->connect()->prepare('SELECT name FROM Moderator WHERE name = ? OR
                                                   email = ?;');

        //Checks if the query ran if not sends the user back into the sign up page
        if(!$query->execute(array($name, $email))){
            $query = null;
            header("location: ../../add-editor.php?error=queryfailed");
            exit();
        }
        
        //Checks if the query returned a data/row
        $resultCheck = false;
        if($query->rowCount() > 0){
            $resultCheck = false;
        }
        else{
            $resultCheck = true;
        }

        return $resultCheck;

    }

    private $ModeratorID = "";

    public function getEditors(){
        //Query to grab the details from the database
        $query = $this->connect()->prepare('SELECT * FROM Moderator;');

        //Checks if the query ran if not sends the user back into the login page
        if(!$query->execute(array())){
            $query = null;
            header("location: ../../account-management-editor.php?error=queryfailed");
            exit();
        }

        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getEditorUseID($ModeratorID){
        //Query to grab the details from the database
        $query = $this->connect()->prepare('SELECT * FROM moderator WHERE id =:mod_id;');
        $data = [":mod_id" => $ModeratorID];
        //Checks if the query ran if not sends the user back into the login page
        if(!$query->execute($data)){
            $query = null;
            header("location: ../../edit-editor.php?error=queryfailed");
            exit();
        }
        
        if($query->rowCount() == 0){
            $query = null;
            header("location: ../../account-management-editor.php?error=usernotfounds");
            exit();
        }

        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    protected function updateEditor($ModeratorID, $name, $email){

        //Query to insert the users details into the database
        $query = $this->connect()->prepare('UPDATE Moderator
                                            Set name =:name, 
                                            email =:email
                                            WHERE id =:id;');
        $data = [
            ":name" => $name,
            ":email" => $email,
            ":id" => $ModeratorID
        ];
        //Checks if the query ran if not sends the user back into the sign up page
        if(!$query->execute($data)){
            $query = null;
            header("location: ../../edit-editor.php?error=queryfailed");
            exit();
        }
        
        $query = null;
    }


    public function SuspendEditor(){
        if($_GET['status'] === "ACTIVE"){
            $status = "INACTIVE";
        }
        else{
            $status = "ACTIVE";
        }

        if(isset($_GET['ModeratorID'])){
            $ModeratorID = $_GET["ModeratorID"];
        }
        $query = $this->connect()->prepare('UPDATE moderator
                                                SET status = ?
                                                WHERE id = ?;');
            //Checks if the query ran if not sends the user back into the sign up page
            if(!$query->execute(array($status ,$ModeratorID))){
                $query = null;
                header("location: ../account-management-editor.php?error=queryfailed");
                exit();
            }
            
            $query = null;
    }

    private $AccountID = "";

    public function getClients(){
        //Query to grab the details from the database
        $query = $this->connect()->prepare('SELECT A.id, first_name, last_name, email, AT.type AS account_type, status, created_at, CONCAT(first_name, " ", last_name) AS name 
        FROM Account AS A
        INNER JOIN account_type AS AT ON A.type_id = AT.id;');

        //Checks if the query ran if not sends the user back into the login page
        if(!$query->execute(array())){
            $query = null;
            header("location: ../../account-management-client.php?error=queryfailed");
            exit();
        }
        

        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getClientUseID($AccountID){
        //Query to grab the details from the database
        $query = $this->connect()->prepare('SELECT * FROM Account WHERE id =:acc_id;');
        $data = [":acc_id" => $AccountID];
        //Checks if the query ran if not sends the user back into the login page
        if(!$query->execute($data)){
            $query = null;
            header("location: ../../edit-client.php?error=queryfailed");
            exit();
        }
        
        if($query->rowCount() == 0){
            $query = null;
            header("location: ../../account-management-client.php?error=usernotfounds");
            exit();
        }

        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function updateClient($AccountID, $AccountType){

        //Query to insert the users details into the database
        $query = $this->connect()->prepare('UPDATE account 
        SET type_id = ?
        WHERE id = ?');
        //Checks if the query ran if not sends the user back into the sign up page
        if(!$query->execute(array($AccountType, $AccountID))){
            $query = null;
            header("location: ../../edit-client.php?error=queryfailed");
            exit();
        }
        
        $query = null;
    }

    
}