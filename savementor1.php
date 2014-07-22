<?php 

    // First we execute our common code to connection to the database and start the session 
    require("common.php"); 
     
    // At the top of the page we check to see whether the user is logged in or not 
    if(empty($_SESSION['user']))                                                   
                                                        
    { 
        // If they are not, we redirect them to the login page. 
        header("Location: login.php"); 
         
        // Remember that this die statement is absolutely critical.  Without it, 
        // people can view your members-only content without logging in. 
        die("Redirecting to login.php"); 
    } 

$z=0;

 $currentmentors = array( 
             ':id' => $_SESSION['user']['id']
            );

    $querymentors = " 
    SELECT * from mentees WHERE id = :id";
    try 
    { 
    $stmt = $db->prepare($querymentors); 
    $result = $stmt->execute($currentmentors); 
    } 
    catch(PDOException $ex) 
    { 
    die("Failed to run query2: " . $ex->getMessage()); 
    } 

    $mentorarray = $stmt->fetch(PDO::FETCH_NUM); 

    $mentorlength = count(array_filter($mentorarray));

    switch ($mentorlength) {
        case 1:
            $mentoradd = array( 
            ':mentorid' => $_SESSION['id3'][$z][0],
             ':id' => $_SESSION['user']['id']
            );
            $qvadd = " 
            UPDATE mentees SET mentorid1 = :mentorid WHERE id = :id";
            try 
            { 
            $stmt = $db->prepare($qvadd); 
            $result = $stmt->execute($mentoradd); 
            } 
            catch(PDOException $ex) 
            { 
            die("Failed to run mentor query2: " . $ex->getMessage()); 
            } 
             $_SESSION['mentormax']=false;
            break;
             
        case 2:
            $mentoradd = array( 
            ':mentorid' => $_SESSION['id3'][$z][0],
             ':id' => $_SESSION['user']['id']
            );
            $qvadd = " 
            UPDATE mentees SET mentorid2 = :mentorid WHERE id = :id";
            try 
            { 
            $stmt = $db->prepare($qvadd); 
            $result = $stmt->execute($mentoradd); 
            } 
            catch(PDOException $ex) 
            { 
            die("Failed to run mentor query2: " . $ex->getMessage()); 
            } 
             $_SESSION['mentormax']=false;
            break;
        case 3:
            $mentoradd = array( 
            ':mentorid' => $_SESSION['id3'][$z][0],
             ':id' => $_SESSION['user']['id']
            );
            $qvadd = " 
            UPDATE mentees SET mentorid3 = :mentorid WHERE id = :id";
            try 
            { 
            $stmt = $db->prepare($qvadd); 
            $result = $stmt->execute($mentoradd); 
            } 
            catch(PDOException $ex) 
            { 
            die("Failed to run mentor query2: " . $ex->getMessage()); 
            } 
            $_SESSION['mentormax']=true;
            break;
        case 4:
            $_SESSION['mentormax']=true;
            
            break;
            
    }       

    $query_params = array( 
                    ':id' => $_SESSION['user']['id']
                ); 


                $query = " 
                SELECT  
                mentorid1, mentorid2, mentorid3
                FROM mentees
                WHERE 
                id = :id
                "; 

                try 
                { 
                    // Execute the query against the database 
                    $stmt = $db->prepare($query); 
                    $result = $stmt->execute($query_params); 
                } 
                catch(PDOException $ex) 
                { 
                    // Note: On a production website, you should not output $ex->getMessage(). 
                    // It may provide an attacker with helpful information about your code.  
                    die("Failed to run mentor query: " . $ex->getMessage()); 
                } 

                $_SESSION['mentorids'] = $stmt->fetch(PDO::FETCH_NUM); 
            $_SESSION['savedmentor']=true;
            header("Location: mentor1.php"); 

   

    ?>