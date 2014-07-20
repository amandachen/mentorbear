<?php 

    // First we execute our common code to connection to the database and start the session 
    require("common.php"); 
     
    // This variable will be used to re-display the user's username to them in the 
    // login form if they fail to enter the correct password.  It is initialized here 
    // to an empty value, which will be shown if the user has not submitted the form. 
    $submitted_username = ''; 
     
    // This if statement checks to determine whether the login form has been submitted 
    // If it has, then the login code is run, otherwise the form is displayed 
    if(!empty($_POST)) 
    { 
        // This query retreives the user's information from the database using 
        // their username. 
        $query = " 
            SELECT 
                id, 
                username, 
                password, 
                salt, 
                email,
                mentor,
                mentee 
            FROM userz
            WHERE 
                username = :username 
        "; 
         

        // The parameter values 
        $query_params = array( 
            ':username' => $_POST['username'] 
        ); 
         
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
            die("Failed to run query: " . $ex->getMessage()); 
        } 
         
        // This variable tells us whether the user has successfully logged in or not. 
        // We initialize it to false, assuming they have not. 
        // If we determine that they have entered the right details, then we switch it to true. 
        $login_ok = false; 
         
        // Retrieve the user data from the database.  If $row is false, then the username 
        // they entered is not registered. 
        $row = $stmt->fetch(); 
        if($row) 
        { 
            // Using the password submitted by the user and the salt stored in the database, 
            // we now check to see whether the passwords match by hashing the submitted password 
            // and comparing it to the hashed version already stored in the database. 
            $check_password = hash('sha256', $_POST['password'] . $row['salt']); 
            for($round = 0; $round < 65536; $round++) 
            { 
                $check_password = hash('sha256', $check_password . $row['salt']); 
            } 
             
            if($check_password === $row['password']) 
            { 
                // If they do, then we flip this to true 
                $login_ok = true; 
            } 
        } 
         
        // If the user logged in successfully, then we send them to the private members-only page 
        // Otherwise, we display a login failed message and show the login form again 
        if($login_ok) 
        { 
            // Here I am preparing to store the $row array into the $_SESSION by 
            // removing the salt and password values from it.  Although $_SESSION is 
            // stored on the server-side, there is no reason to store sensitive values 
            // in it unless you have to.  Thus, it is best practice to remove these
            // sensitive values first. 
            unset($row['salt']); 
            unset($row['password']); 
             
            // This stores the user's data into the session at the index 'user'. 
            // We will check this index on the private members-only page to determine whether 
            // or not the user is logged in.  We can also use it to retrieve 
            // the user's details. 
            $_SESSION['user'] = $row; 

            $query_paramsprof = array( 
                ':id' => $row['id']
                ); 


            $queryprof = " 
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
                me,
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
                $rowprof = $stmtprof->fetch(); 

                $_SESSION['userprof'] = $rowprof; 

                if($_SESSION['user']['mentor']==1)
                { 

            $query_paramsor = array( 
                ':id' => $_SESSION['user']['id']
                ); 


            $queryor = " 
            SELECT  
                college

                FROM mentors
                WHERE 
                id = :id
                "; 

                try 
                { 
                    // Execute the query against the database 
                    $stmtor = $db->prepare($queryor); 
                    $resultor = $stmtor->execute($query_paramsor); 
                } 
                catch(PDOException $ex) 
                { 
                    // Note: On a production website, you should not output $ex->getMessage(). 
                    // It may provide an attacker with helpful information about your code.  
                    die("Failed to run mentor query: " . $ex->getMessage()); 
                } 
            
                $rowor = $stmtor->fetch(); 

                $_SESSION['useror'] = $rowor; 
            }

                else {
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

                }


                 
                // Retrieve the user data from the database.  If $row is false, then the username 
                // they entered is not registered. 
                
                

            
                

            // Redirect the user to the private members-only page. 
            header("Location: private.php"); 
            die("Redirecting to: private.php"); 
        } 

        else 
        { 
            // Tell the user they failed 
            print("Login Failed."); 
             
            // Show them their username again so all they have to do is enter a new
            // password.  The use of htmlentities prevents XSS attacks.  You should
            // always use htmlentities on user submitted values before displaying them 
            // to any users (including the user that submitted them).  For more information: 
            // http://en.wikipedia.org/wiki/XSS_attack 
            $submitted_username = htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8'); 
        } 
    } 
     
?> 
<html>

<head>

  <meta charset="UTF-8">

  <title>MentorBear | Login</title>

  <link rel="stylesheet" href="css/reset.css">

    <link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />

</head>

<body>

  <div class="wrap">
		<div class="avatar">
      <img src="http://mentorbear.com/img/bear.png">
		</div>
		<form action="login.php" method="post"> 
		<input type="text" placeholder="username" name="username" value="<?php echo $submitted_username; ?>" required>
		<div class="bar">
			<i></i>
		</div>
		<input type="password" name="password" placeholder="password" value ="" required>
		<a href="register.php" class="forgot_link">Forgot</a>
       <button id="register2" type="Submit" value="Login">Login</button>
		<div class="bar2">
			<i></i>
		</div>	
		</form> 
		<a href="register.php"><button id="register2" type="Register" value="Register">Register
        </div>
	</button></a>

  <script src='http://codepen.io/assets/libs/fullpage/none.js'></script>

  <script src="js/index.js"></script>

</body>

</html>

