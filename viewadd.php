 <?php

    $newvcount=$goview+1; 
    $paramviewadd = array( 
            ':newvcount' => $newvcount,
             ':id' => $_SESSION['user']['id']
            );

    $queryviewadd = " 
    UPDATE `Views` SET `vcount` = :newvcount WHERE `Views`.`id` = :id";
    try 
    { 
    $stmt = $db->prepare($queryviewadd); 
    $result = $stmt->execute($paramviewadd); 
    } 
    catch(PDOException $ex) 
    { 
    die("Failed to run mentor query2: " . $ex->getMessage()); 
    } 
    $goview2 = $stmt->fetchALL(PDO::FETCH_NUM); 

?>