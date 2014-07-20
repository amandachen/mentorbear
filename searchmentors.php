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
    $_SESSION['id3']=$mentor3;
    $paramsfind3 = array( 
            ':id' => $mentor3[0]['id'],
            ':id1'=> $mentor3[1]['id'],
            ':id2'=> $mentor3[2]['id']
              ); 


            
    $queryfind3 = " 
        SELECT  
        username, email, mentor
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

         $paramsprof3 = array( 
            ':id' => $mentor3[0]['id'],
            ':id1'=> $mentor3[1]['id'],
            ':id2'=> $mentor3[2]['id']
              ); 


            
        $prof3query = " 
        SELECT  
                genderpref, 
                id,
                female, 
                hschool, 
                math,
                english,
                history,
                chemistry,
                economics,
                engineering,
                physics,
                computers,
                biology,
                art,
                music,
                literature,
                extra1,
                extra2,
                extra3,
                extra4,
                extra5,
                academics,
                career,
                sociallife,
                applications,
                scholarship,
                transitioning,
                email,
                inperson,
                vchat,
                phone,
                im,
                other,
                zipcode,
                time,
                available,
                me

                FROM profiles
                WHERE 
                id IN (:id, :id1, :id2)
                "; 



        try 
        { 
            // Execute the query against the database 
            $stmtprof3 = $db->prepare($prof3query); 
            $resultprof3 = $stmtprof3->execute($paramsprof3); 
        } 
        catch(PDOException $ex) 
        { 
            // Note: On a production website, you should not output $ex->getMessage(). 
            // It may provide an attacker with helpful information about your code.  
            die("Failed to run find mentor query: " . $ex->getMessage()); 
        } 
         
        
        $prof3 = $stmtprof3->fetchALL(PDO::FETCH_ASSOC); 

        $_SESSION['prof3'] = $prof3; 

               
}

?>

