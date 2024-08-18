<?php

class AccountRepository extends Dbh{

    protected function getUser($email, $password){

        //Query to grab the password from the database
        $query = $this->connect()->prepare('SELECT * FROM Account WHERE Email = ? OR Password = ?;');

        //Checks if the query ran if not sends the user back into the login page
        if(!$query->execute(array($email, $password))){
            $query = null;
            header("location: ../../client-log-in.php?error=queryfailed");
            exit();
        }
        
        if($query->rowCount() == 0){
            $query = null;
            header("location: ../../client-log-in.php?error=usernotfound");
            exit();
        }

        //Hashes the fetched password
        $passwordHashed = $query->fetchAll(PDO::FETCH_ASSOC);
        $checkpassword = password_verify($password, $passwordHashed[0]["Password"]);

        //Checks if the inputted password is the same as the Fetched password
        if($checkpassword == false){
            $query = null;
            header("location: ../../client-log-in.php?error=wrongpassword");
            exit();
        }
        elseif($checkpassword == true){
            $query = null;
            $query = $this->connect()->prepare('SELECT * FROM Account WHERE Email = ? AND Password = ?;');
        
            if(!$query->execute(array($email, $passwordHashed[0]["Password"]))){
                $query = null;
                header("location: ../../client-log-in.php?error=queryfailed");
                exit();
            }

            if($query->rowCount() == 0){
                $query = null;
                header("location: ../../client-log-in.php?error=usernotfounds");
                exit();
            }

            $user = $query->fetchAll(PDO::FETCH_ASSOC);
            
            session_start();
            $_SESSION["userid"] = $user[0]["FirstName"];
            $_SESSION["useruid"] = $user[0]["LastName"];
        }

        $query = null;
    }

    protected function setUser($first_name, $last_name, $email, $password){

        //Query to insert the users details into the database
        $query = $this->connect()->prepare('INSERT INTO Account (FirstName, LastName, Email, Password)
                                            Values(?, ?, ?, ?);');

        //Hashes the password for security
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        //Checks if the query ran if not sends the user back into the sign up page
        if(!$query->execute(array($first_name, $last_name, $email, $hashedPassword))){
            $query = null;
            header("location: ../../client-sign-up.php?error=queryfailed");
            exit();
        }
        
        $query = null;
    }
   
    protected function checkUser($first_name, $last_name, $email){

        //Query to get columns
        $query = $this->connect()->prepare('SELECT FirstName FROM Account WHERE FirstName = ? AND 
                                                   LastName = ? OR
                                                   Email = ?;');

        //Checks if the query ran if not sends the user back into the sign up page
        if(!$query->execute(array($first_name, $last_name, $email))){
            $query = null;
            header("location: ../../client-sign-up.php?error=queryfailed");
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

    public function DeleteClient(){
        if(isset($_GET['AccountID'])){
            $AccountID = $_GET["AccountID"];
        }
        $dbh = new Dbh();
        $query = $dbh->connect()->prepare('DELETE FROM Account
                                                WHERE id =:id;');
            $data = [
                ":id" => $AccountID
            ];
            //Checks if the query ran if not sends the user back into the sign up page
            if(!$query->execute($data)){
                $query = null;
                header("location: ../account-management-client.php?error=queryfailed");
                exit();
            }
            
            $query = null;
    }
}