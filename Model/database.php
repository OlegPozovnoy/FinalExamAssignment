<?php

class MyException extends Exception{
    
}


class Database{
    
    private $username = 'azure';
    private $password = '6#vWHD_$';
    private $host = "127.0.0.1:51073";
    private $dbname = 'book_store';
    private $timeToVerify = 10;

    private $db;
 //user_name	password	email	isVerified	registratoinDate	userId	verificationCode
   
    public $conn;
    
    function __construct()
    {
        
        try{
            
            $this->db = new PDO('mysql:host='.$this->host.';dbname='.$this->dbname,$this->username,$this->password);
            
            if (is_null($this->db))
            {
                echo "Connection failed, check connection parameters";
            }
        }
        catch(PDOException $e){
            echo '<br/> Consstructor failed';
            echo $e->getMessage();         
        }
    }
    
    function __destruct(){
        $this->username = null;
        $this->password = null;
        $this->host = null;
        $this->db = null;
    }
    
    function signUp($user_name, $password, $email, $verificationCode){
        
        echo "<br/> DB Email:".$email;

        try{
        //echo '1'.$user_name.$password.$email.$verificationCode;
        $this->maintain();
        
        $stmt = $this->db->prepare("SELECT * FROM ".$this->dbname.".users WHERE user_name = :user_name");
        $stmt->bindParam(":user_name", $user_name);
        $stmt->execute();
        
        if ($stmt->rowCount()>=1)
            {
            throw new MyException ("Sorry, the username ".$user_name. " is already registered");
            }
        $stmt->closeCursor();
            
        //echo '2';
        $stmt = $this->db->prepare("SELECT * FROM ".$this->dbname.".users WHERE email = :email");
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        if ($stmt->rowCount()>=1)
            {
            throw new MyException ( "Sorry, the email ".$email. " is already in use");
            }       
        $stmt->closeCursor();
         
        echo '3';    
            
        $stmt = $this->db->prepare("insert into ".$this->dbname.".users (user_name,password,email,isVerified,registratoinDate,verificationCode) VALUES (:user_name,:password,:email,TRUE,NOW(),:verificationCode)");
        $stmt->bindParam(":user_name", $user_name);
        $stmt->bindParam(":password", $password);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":verificationCode", $verificationCode);
        $stmt->execute();
        
        if ($stmt->rowCount() == 0)
            {
            throw new MyError( "Sorry, the record cannot be inserted. Please, contact someone ASAP.");
            }  
        else
            {
            return true;
            }
        $stmt->closeCursor(); 
        } 
        catch(PDOException $e)
        {
            throw new MyError ($e->getMessage());
        }
        
    }
    
    private function maintain()
    {
      //  echo "<br/>DELETE FROM ".$this->dbname.".users WHERE NOW() > (registratoinDate + INTERVAL ".$this->timeToVerify." MINUTE) and isVerified=FALSE";
        $stmt = $this->db->prepare("DELETE FROM ".$this->dbname.".users WHERE NOW() > (registratoinDate + INTERVAL ".$this->timeToVerify." MINUTE) and isVerified=FALSE");
        $stmt->execute();        
    }
    
    
    function signIn($user_name, $password){
        
        echo "<br/> Starting signin with".$user_name." ".$password; 

        $this->maintain();

        $stmt = $this->getUser($user_name); 
        $row = $stmt->fetch();
       
        if (password_verify($password,$row['password']) == true)
        {
            //echo "password verified";
            return true;
        }
        else
        {

            //echo "password not verified";
            //throw new Exception ("<br/> Password:".$password."Hash:".$row['password']);
            throw new Exception ("<br/>Sorry, the password you entered is incorrect");
        }   

    }    
    
    function sign_verify($user_name, $password, $email, $verificationCode){
        
        $this->maintain();
 
        try {
            $stmt = $this->getUserEmail($user_name, $email); 
            $row = $stmt->fetch();
        } catch (MyException $e)
        {
            return $e->getMessage();           
        }

            echo "VerCode: ".$row['verificationCode'].$verificationCode;
            
            
            
            if ($row['isVerified'] == TRUE)
            {
                return "The account is already have been verified";
                
            } 
            
            
            if ($row['verificationCode'] == $verificationCode)
            {
                $stmt->closeCursor();  
                $stmt = $this->db->prepare("UPDATE ".$this->dbname.".users SET isVerified = TRUE WHERE user_name = :user_name and  email = :email");                  
                $stmt->bindParam(":user_name", $user_name);
                $stmt->bindParam(":email", $email);        
                $stmt->execute();      
                return '';
            }
            else
            {
                return "Sorry, user record ".$user_name." cannot be verified, wrong verification code";            
            }
         
        }
         
    
    private function getUserEmail($user_name, $email){
        $this->maintain();
        
        $stmt = $this->db->prepare("SELECT * FROM ".$this->dbname.".users WHERE user_name = :user_name and  email = :email");
        $stmt->bindParam(":user_name", $user_name);
        $stmt->bindParam(":email", $email);        
        $stmt->execute();
        if ($stmt->rowCount()==0)
            {
            $stmt->closeCursor();
            throw new MyException ("Pair ".$user_name." ".$email. " cannot be found in the database" );
            }
        else if ($stmt->rowCount()>=2)
        {
            $stmt->closeCursor();
            throw new MyException ("Pair ".$user_name." ".$email. " returns more than one record" );
        }
         else {
             return $stmt;
         }
    }

    public function getUser($user_name){
        $this->maintain();
        
        $stmt = $this->db->prepare("SELECT * FROM ".$this->dbname.".users WHERE user_name = :user_name");
        $stmt->bindParam(":user_name", $user_name);
        $stmt->execute();
        if ($stmt->rowCount()==0)
            {
            $stmt->closeCursor();
            throw new MyException ("Pair ".$user_name." cannot be found in the database" );
            }
        else if ($stmt->rowCount()>=2)
        {
            $stmt->closeCursor();
            throw new MyException ("Pair ".$user_name." returns more than one record" );
        }
         else {
             return $stmt;
         }
    }    


}

?>