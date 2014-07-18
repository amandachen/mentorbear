<?php 

    // First we execute our common code to connection to the database and start the session 
    require("common.php"); 
     
     

    // This if statement checks to determine whether the registration form has been submitted 
    // If it has, then the registration code is run, otherwise the form is displayed 
    if(!empty($_POST)) 
    { 
        // Ensure that the user has entered a non-empty username 
        if(empty($_POST['username'])) 
        { 
            // Note that die() is generally a terrible way of handling user errors 
            // like this.  It is much better to display the error with the form 
            // and allow the user to correct their mistake.  However, that is an 
            // exercise for you to implement yourself. 
            die("Please enter a username."); 
        } 
         
        // Ensure that the user has entered a non-empty password 
        if(empty($_POST['password'])) 
        { 
            die("Please enter a password."); 
        } 
         
        // Make sure the user entered a valid E-Mail address 
        // filter_var is a useful PHP function for validating form input, see: 
        // http://us.php.net/manual/en/function.filter-var.php 
        // http://us.php.net/manual/en/filter.filters.php 
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
        { 
            die("Invalid E-Mail Address"); 
        } 
         
        // We will use this SQL query to see whether the username entered by the 
        // user is already in use.  A SELECT query is used to retrieve data from the database. 
        // :username is a special token, we will substitute a real value in its place when 
        // we execute the query. 
        $query = " 
            SELECT 
                1 
            FROM users 
            WHERE 
                username = :username 
        "; 
         
        // This contains the definitions for any special tokens that we place in 
        // our SQL query.  In this case, we are defining a value for the token 
        // :username.  It is possible to insert $_POST['username'] directly into 
        // your $query string; however doing so is very insecure and opens your 
        // code up to SQL injection exploits.  Using tokens prevents this. 
        // For more information on SQL injections, see Wikipedia: 
        // http://en.wikipedia.org/wiki/SQL_Injection 
        $query_params = array( 
            ':username' => $_POST['username'] 
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
        $row = $stmt->fetch(); 
         
        // If a row was returned, then we know a matching username was found in 
        // the database already and we should not allow the user to continue. 
        if($row) 
        { 
            die("This username is already in use"); 
        } 
         
        // Now we perform the same type of check for the email address, in order 
        // to ensure that it is unique. 
        $query = " 
            SELECT 
                1 
            FROM users 
            WHERE 
                email = :email 
        "; 
         
        $query_params = array( 
            ':email' => $_POST['email'] 
        ); 
         
        try 
        { 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex) 
        { 
            die("Failed to run query: " . $ex->getMessage()); 
        } 
         
        $row = $stmt->fetch(); 
         
        if($row) 
        { 
            die("This email address is already registered"); 
        } 
         
        if(empty($_POST['math'])) 
        { 
            $_POST['math']=0;
            
        }  
        if(empty($_POST['math'])) 
        { 
            $_POST['math']=0;
            
        }  
        if(empty($_POST['math'])) 
        { 
            $_POST['math']=0;
            
        }  
        if(empty($_POST['math'])) 
        { 
            $_POST['math']=0;
            
        }  
        if(empty($_POST['math'])) 
        { 
            $_POST['math']=0;
            
        }  
        if(empty($_POST['math'])) 
        { 
            $_POST['math']=0;
            
        }  
        
        // An INSERT query is used to add new rows to a database table. 
        // Again, we are using special tokens (technically called parameters) to 
        // protect against SQL injection attacks. 
        $query = " 
            INSERT INTO users ( 
                username, 
                password, 
                salt, 
                email,
                female, 
                hschool,
                math
            ) VALUES ( 
                :username, 
                :password, 
                :salt, 
                :email, 
                :female,
                :hschool,
                :math
            ) 
        "; 
         
        // A salt is randomly generated here to protect again brute force attacks 
        // and rainbow table attacks.  The following statement generates a hex 
        // representation of an 8 byte salt.  Representing this in hex provides 
        // no additional security, but makes it easier for humans to read. 
        // For more information: 
        // http://en.wikipedia.org/wiki/Salt_%28cryptography%29 
        // http://en.wikipedia.org/wiki/Brute-force_attack 
        // http://en.wikipedia.org/wiki/Rainbow_table 
        $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647)); 
         
        // This hashes the password with the salt so that it can be stored securely
        // in your database.  The output of this next statement is a 64 byte hex 
        // string representing the 32 byte sha256 hash of the password.  The original 
        // password cannot be recovered from the hash.  For more information: 
        // http://en.wikipedia.org/wiki/Cryptographic_hash_function 
        $password = hash('sha256', $_POST['password'] . $salt); 
         
        // Next we hash the hash value 65536 more times.  The purpose of this is to
        // protect against brute force attacks.  Now an attacker must compute the hash 65537 
        // times for each guess they make against a password, whereas if the password 
        // were hashed only once the attacker would have been able to make 65537 different  
        // guesses in the same amount of time instead of only one. 
        for($round = 0; $round < 65536; $round++) 
        { 
            $password = hash('sha256', $password . $salt); 
        } 
         
        // Here we prepare our tokens for insertion into the SQL query.  We do not 
        // store the original password; only the hashed version of it.  We do store
        // the salt (in its plaintext form; this is not a security risk). 
        $query_params = array( 
            ':username' => $_POST['username'], 
            ':password' => $password, 
            ':salt' => $salt, 
            ':email' => $_POST['email'], 
            ':female' => $_POST['female'], 
            ':hschool' => $_POST['hschool'], 
            ':math' => $_POST['math'] 
        ); 
         
         

        try 
        { 
            // Execute the query to create the user 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex) 
        { 
            // Note: On a production website, you should not output $ex->getMessage(). 
            // It may provide an attacker with helpful information about your code.  
            die("Failed to run query: " . $ex->getMessage()); 
        } 
         
        // This redirects the user back to the login page after they register 
        header("Location: login.php"); 
         
        // Calling die or exit after performing a redirect using the header function 
        // is critical.  The rest of your PHP script will continue to execute and 
        // will be sent to the user if you do not die or exit. 
        die("Redirecting to login.php"); 
    } 
    
?> 



<html>

<head>

  <meta charset="UTF-8">

  <title>MentorBear - Register</title>

  <link rel="stylesheet" href="css/reset.css">

    <link rel="stylesheet" href="css/formstyle.css" media="screen" type="text/css" />

</head>

<body>


 <!-- multistep form -->
<form action="register.php" method="post" id="msform"> 
   <!-- progressbar -->
    <ul id="progressbar">
        <li class="active">Welcome</li>
        <li>About Me</li>
        <li>Academics</li>
        <li>My Interests</li> 
        <li>Mentoring</li> 
        <li>Mentoring</li> 
    </ul>
    <!-- fieldsets -->
    <fieldset>
        <h2 class="fs-title">Create your account</h2>
        <h3 class="fs-subtitle">Welcome to MentorBear!</h3>
        <input type="text" name="username" placeholder="name" />
        <input type="text" name="email" placeholder="Email" />
        <input type="password" name="password" placeholder="Password" />
        <input type="password" name="cpass" placeholder="Confirm Password" />
        <input type="button" name="next" class="next action-button" value="Next" />
    </fieldset>
    <fieldset>
        <h2 class="fs-title">About Me</h2>
        <h3 class="fs-subtitle">Let us get to know you!</h3>
        <div class="squaredOne" id="square1">
             <input type="radio" value="1" id="squaredOne" name="female" />
            <label for="squaredOne">Female</label>
        </div>
        <div class="squaredOne" id="square2">
             <input type="radio" value="0" id="squaredOne2" name="female"/>
            <label for="squaredOne2">Male</label>
        </div>

        <h3 class="fs-subtitle"> Year in School</h3>
                <div class="squaredOne" id="square3">
             <input type="radio" value="1" id="squaredOne3" name="hschool"/>
            <label for="squaredOne3">High School</label>
        </div>
        <div class="squaredOne" id="square4">
             <input type="radio" value="0" id="squaredOne4" name="hschool"/>
            <label for="squaredOne4">College</label>
        </div>

        <h3 class="fs-subtitle"> Interested in becoming a...</h3>
         <div class="squaredOne" id="square5">
             <input type="checkbox" value="" id="mentee" />
            <label for="mentee">Mentee</label>
        </div>
        <div class="squaredOne" id="square6">
             <input type="checkbox" value="" id="mentor" />
             <label for="mentor">Mentor</label>
        </div>
        <input type="button" name="previous" class="previous action-button" value="Previous" />
        <input type="button" name="next" class="next action-button" value="Next" />
    </fieldset>
    <fieldset>
        <h2 class="fs-title">Academic Interests</h2>
        <h3 class="fs-subtitle">So what do you like?</h3>
<table>
  <tr>
    <th> <div class="squaredOne" id="math">
             <input type="checkbox" value="1" id="mathl" name="math">
            <label for="mathl">Math</label></div></th>
    <th> <div class="squaredOne" id="english">
             <input type="checkbox" value="1" id="englishl" name="english"/>
            <label for="englishl">English</label></div></th>
    <th>  <div class="squaredOne" id="art">
             <input type="checkbox" value="1" id="artl" name="art"/>
            <label for="artl">Art</label></div></th>

  </tr>
    <tr>
    <th> <div class="squaredOne" id="physics">
             <input type="checkbox" value="1" id="physicsl" name="physics"/>
            <label for="physicsl">Physics</label>
        </div></th>
    <th> <div class="squaredOne" id="biology">
             <input type="checkbox" value="1" id="biologyl" name="biology"/>
            <label for="biologyl">Biology</label>
        </div></th>
    <th><div class="squaredOne" id="history">
             <input type="checkbox" value="1" id="historyl" name="history"/>
            <label for="historyl">History</label>
        </div></th>
  </tr>
  <tr>
    <th><div class="squaredOne" id="chemistry">
             <input type="checkbox" value="1" id="chemistryl" name="chemistry"/>
            <label for="chemistryl">Chemistry</label>
        </div></th>
    <th> <div class="squaredOne" id="economics">
             <input type="checkbox" value="1" id="economicsl" name="economics"/>
            <label for="economicsl">Economics</label>
        </div></th>
    <th><div class="squaredOne" id="history">
             <input type="checkbox" value="1" id="historyl" name="history"/>
            <label for="historyl">History</label>
        </div></th>
  </tr>


</table>


        <input type="button" name="previous" class="previous action-button" value="Previous" />
       <input type="button" name="next" class="next action-button" value="Next" />
    </fieldset>
    <fieldset>
        <h2 class="fs-title">Interests</h2>
        <h3 class="fs-subtitle">Share your 5 favorite hobbies/extracurriculars</h3>
        <input type="text" name="interestone" placeholder="" />
        <input type="text" name="interesttwo" placeholder="" />
        <input type="text" name="interestthree" placeholder="" />
        <input type="text" name="interestfour" placeholder="" />
        <input type="text" name="interestfive" placeholder="" />
        <input type="button" name="previous" class="previous action-button" value="Previous" />
        <input type="button" name="next" class="next action-button" value="Next" />
    </fieldset>
    <fieldset>
        <h2 class="fs-title">In which areas would you most value a mentor?</h2>
        <h3 class="fs-subtitle">Choose as many as you'd like</h3>
       <div class="squaredOne" id="square1">
             <input type="radio" value="1" id="squaredOne" name="female" />
            <label for="squaredOne">Academics</label>
        </div>
        <div class="squaredOne" id="square2">
             <input type="radio" value="0" id="squaredOne2" name="female"/>
            <label for="squaredOne2">Careers</label>
        </div>
        <div class="squaredOne" id="square3">
             <input type="radio" value="1" id="squaredOne3" name="hschool"/>
            <label for="squaredOne3">Social Life</label>
        </div>
        <div class="squaredOne" id="square4">
             <input type="radio" value="0" id="squaredOne4" name="hschool"/>
            <label for="squaredOne4">Applications</label>
        </div>
         <div class="squaredOne" id="square5">
             <input type="checkbox" value="" id="mentee" />
            <label for="mentee">Scholarships</label>
        </div>
        <div class="squaredOne" id="square6">
             <input type="checkbox" value="" id="mentor" />
             <label for="mentor">Transitioning to College</label>
        </div>
         <input type="button" name="previous" class="previous action-button" value="Previous" />
        <input type="button" name="next" class="next action-button" value="Next" />
    </fieldset>
        <fieldset>
        <h2 class="fs-title">How would you prefer to connect with your mentor/mentee</h2>
        <h3 class="fs-subtitle">Choose as many as you'd like</h3>
       <div class="squaredOne" id="square1">
            <input type="radio" value="1" id="squaredOne" name="female" />
            <label for="squaredOne">Female</label>
        </div>
        <div class="squaredOne" id="square2">
             <input type="radio" value="0" id="squaredOne2" name="female"/>
            <label for="squaredOne2">Male</label>
        </div>

        <h3 class="fs-subtitle"> Year in School</h3>
                <div class="squaredOne" id="square3">
             <input type="radio" value="1" id="squaredOne3" name="hschool"/>
            <label for="squaredOne3">High School</label>
        </div>
        <div class="squaredOne" id="square4">
             <input type="radio" value="0" id="squaredOne4" name="hschool"/>
            <label for="squaredOne4">College</label>
        </div>

        <h3 class="fs-subtitle"> Interested in becoming a...</h3>
         <div class="squaredOne" id="square5">
             <input type="checkbox" value="" id="mentee" />
            <label for="mentee">Mentee</label>
        </div>
        <div class="squaredOne" id="square6">
             <input type="checkbox" value="" id="mentor" />
             <label for="mentor">Mentor</label>
        </div>
        <input type="submit" value="Register" />
        <input type="button" name="previous" class="previous action-button" value="Previous" />
        <input type="button" name="next" class="next action-button" value="Next" />
    </fieldset>
</form>

<!-- jQuery -->
<script src="http://thecodeplayer.com/uploads/js/jquery-1.9.1.min.js" type="text/javascript"></script>
<!-- jQuery easing plugin -->
<script src="http://thecodeplayer.com/uploads/js/jquery.easing.min.js" type="text/javascript"></script>

 <script src="js/form.js"></script>

</body>

</html>