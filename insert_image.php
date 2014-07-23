<?php 
require("common.php"); 
     
        $query = " 
            UPDATE profiles SET photo = 
            :photo WHERE id = :userid

            
        "; 
         
        // This contains the definitions for any special tokens that we place in 
        // our SQL query.  In this case, we are defining a value for the token 
        // :username.  It is possible to insert $_POST['username'] directly into 
        // your $query string; however doing so is very insecure and opens your 
        // code up to SQL injection exploits.  Using tokens prevents this. 
        // For more information on SQL injections, see Wikipedia: 
        // http://en.wikipedia.org/wiki/SQL_Injection 
        $query_params = array( 
            ':photo' => $_POST['image'], 
            'userid' => $_SESSION['user']['id']
        ); 
         
        try 
        { 
            // These two statements run the query against your database table. 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex) 
        { 
            // Note: On a production website, you should not output $ex->getMessage(). 
            // It may provide an attacker with helpful information about your code.  
            die("Failed to run query: " . $ex->getMessage()); 
        } 
         
        // The fetch() method returns an array representing the "next" row from 
        // the selected results, or false if there are no more rows to fetch. 
       
       $query_paramsprof = array( 
                ':id' => $_SESSION['user']['id']
                ); 


            $queryprof = " 
            SELECT  
                photo

                FROM profiles
                WHERE 
                id = :id
                "; 

                try 
                { 
                    // Execute the query against the database 
                    $stmtprof = $db->prepare($queryprof); 
                    $resultprof = $stmtprof->execute($query_paramsprof); 
                } 
                catch(PDOException $ex) 
                { 
                    // Note: On a production website, you should not output $ex->getMessage(). 
                    // It may provide an attacker with helpful information about your code.  
                    die("Failed to run profile query: " . $ex->getMessage()); 
                } 
                 
                // Retrieve the user data from the database.  If $row is false, then the username 
                // they entered is not registered. 
                $result=$stmtprof->fetch(); 

                $_SESSION['userprof']['photo'] = $result['photo'];

header("location: private.php");
?>

