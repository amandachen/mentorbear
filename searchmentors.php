<?php

function get_mentors_3() {
    require("common.php");

    try {
        $results= $db->query("
            SELECT id, college
            FROM mentors
            LIMIT 3");

    } catch (Exception $e) {

        echo "de";
        exit;
    }

    $mentor3 = $results->fetchALL(PDO::FETCH_ASSOC);
    $_SESSION['user3']=$mentor3;
    $paramsfind3 = array( 
            ':id' => $mentor3[0]['id'],
            ':id1'=> $mentor3[1]['id'],
            ':id2'=> $mentor3[2]['id']
              ); 


            
    $queryfind3 = " 
        SELECT  
        username
        FROM userz
        WHERE 
        id IN (:id, :id1, :id2)
        "; 



        try 
        { 
            // Execute the query against the database 
            $stmtfind3 = $db->prepare($queryfind3); 
            $resultfind3 = $stmtfind3->execute($paramsfind3); 
        } 
        catch(PDOException $ex) 
        { 
            // Note: On a production website, you should not output $ex->getMessage(). 
            // It may provide an attacker with helpful information about your code.  
            die("Failed to run find mentor query: " . $ex->getMessage()); 
        } 
         
        
        $names3 = $stmtfind3->fetchALL(PDO::FETCH_ASSOC); 

        $_SESSION['names3'] = $names3; 

               
}

?>

