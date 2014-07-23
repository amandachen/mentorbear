<?php 

    // First we execute our common code to connection to the database and start the session 
    require("common.php"); 
     

    // This if statement checks to determine whether the registration form has been submitted 
    // If it has, then the registration code is run, otherwise the form is displayed 
    if(!empty($_POST)) 
    { 
        if(empty($_POST['time']) or empty($_POST['me'])) 
        {      

             die("Please complete the sign-up form."); 

        }
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
       
         
        // The fetch() method returns an array representing the "next" row from 
        // the selected results, or false if there are no more rows to fetch. 
       
         
        // Now we perform the same type of check for the email address, in order 
        // to ensure that it is unique. 
        $query = " 
            SELECT 
                1 
            FROM userz
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
        if(empty($_POST['english'])) 
        { 
            $_POST['english']=0;
            
        }  
        if(empty($_POST['art'])) 
        { 
            $_POST['art']=0;
            
        }  
        if(empty($_POST['physics'])) 
        { 
            $_POST['physics']=0;
            
        }  
        if(empty($_POST['biology'])) 
        { 
            $_POST['biology']=0;
            
        }  
        if(empty($_POST['history'])) 
        { 
            $_POST['history']=0;
            
        }  
        if(empty($_POST['chemistry'])) 
        { 
            $_POST['chemistry']=0;
            
        }
        if(empty($_POST['economics'])) 
        { 
            $_POST['economics']=0;
            
        }
         if(empty($_POST['literature'])) 
        { 
            $_POST['literature']=0;
            
        }
         if(empty($_POST['inperson'])) 
        { 
            $_POST['inperson']=0;
            
        }
         if(empty($_POST['email2'])) 
        { 
            $_POST['email2']=0;
            
        }
         if(empty($_POST['vchat'])) 
        { 
            $_POST['vchat']=0;
            
        }
         if(empty($_POST['im'])) 
        { 
            $_POST['im']=0;
            
        }
         if(empty($_POST['phone'])) 
        { 
            $_POST['phone']=0;
            
        }
         if(empty($_POST['other'])) 
        { 
            $_POST['other']=0;
            
        }
         if(empty($_POST['academics'])) 
        { 
            $_POST['academics']=0;
            
        } 

        if(empty($_POST['careers'])) 
        { 
            $_POST['careers']=0;
            
        }
         if(empty($_POST['sociallife'])) 
        { 
            $_POST['sociallife']=0;
            
        } 

        if(empty($_POST['applications'])) 
        { 
            $_POST['applications']=0;
            
        }

         if(empty($_POST['scholarships'])) 
        { 
            $_POST['scholarships']=0;
            
        }
        if(empty($_POST['transitioning'])) 
        { 
            $_POST['transitioning']=0;
            
        }
        if(empty($_POST['weekdays'])) 
        { 
            $_POST['weekdays']=0;
            
        }
        if(empty($_POST['saturdays'])) 
        { 
            $_POST['saturdays']=0;
            
        }
        if(empty($_POST['sundays'])) 
        { 
            $_POST['sundays']=0;
            
        }
          if(empty($_POST['genderpref'])) 
        { 
            $_POST['genderpref']=0;
            
        }



        
        // An INSERT query is used to add new rows to a database table. 
        // Again, we are using special tokens (technically called parameters) to 
        // protect against SQL injection attacks. 
        $query = " 
            INSERT INTO userz ( 
                username, 
                password, 
                salt, 
                email,
                mentor
            ) VALUES ( 
                :username, 
                :password, 
                :salt, 
                :email, 
                :mentor
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
            ':mentor' => $_POST['mentor']

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

            $query_params = array( 

            ':email' => $_POST['email']

            );

    $query = " 
            SELECT  
                id

                FROM userz
                WHERE 
                email = :email
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
            
                $id = $stmt->fetch(PDO::FETCH_NUM); 

                $_SESSION['id'] = $id[0];
         
$query = "

            INSERT INTO profiles (
                female,
                hschool,
                mentor,
                math,
                english,
                art,
                physics,
                biology,
                history,
                chemistry,
                economics,
                literature,
                genderpref,
                inperson,
                email2,
                vchat,
                im,
                id,
                phone,
                other,
                academics,
                careers,
                sociallife,
                applications,
                scholarships,
                transitioning,
                time,
                weekdays,
                saturdays,
                sundays,
                extra1,
                extra2,
                extra3,
                extra4,
                extra5,
                photo,
                state,
                me

            ) VALUES (
                :female,
                :hschool,
                :mentor,
                :math,
                :english,
                :art,
                :physics,
                :biology,
                :history,
                :chemistry,
                :economics,
                :literature,
                :genderpref,
                :inperson,
                :email2,
                :vchat,
                :im,
                :id,
                :phone,
                :other,
                :academics,
                :careers,
                :sociallife,
                :applications,
                :scholarships,
                :transitioning,
                :time,
                :weekdays,
                :saturdays,
                :sundays,
                :extra1,
                :extra2,
                :extra3,
                :extra4,
                :extra5,
                :photo,
                :state,
                :me

            )
        
            ";

             $query_params = array( 

            ':female' => $_POST['female'],
            ':hschool' => $_POST['hschool'],
            ':mentor' => $_POST['mentor'],
            ':math' => $_POST['math'],
            ':english' => $_POST['english'],
            ':art' => $_POST['art'],
            ':physics' => $_POST['physics'],
            ':biology' => $_POST['biology'],
            ':history' => $_POST['history'],
            ':chemistry' => $_POST['chemistry'],
            ':economics' => $_POST['economics'],
            ':literature' => $_POST['literature'],
            ':genderpref' => $_POST['genderpref'],
            ':inperson' => $_POST['inperson'],
            ':email2' => $_POST['email2'],
            ':vchat' => $_POST['vchat'],
            ':im' => $_POST['im'],
            ':phone' => $_POST['phone'],
            ':other' => $_POST['other'],
            ':academics' => $_POST['academics'],
            ':careers' => $_POST['careers'],
            ':sociallife' => $_POST['sociallife'],
            ':applications' => $_POST['applications'],
            ':scholarships' => $_POST['scholarships'],
            ':transitioning' => $_POST['transitioning'],
            ':time' => $_POST['time'],
            ':weekdays' => $_POST['weekdays'],
            ':saturdays' => $_POST['saturdays'],
            ':sundays' => $_POST['sundays'],   
            ':extra1' => $_POST['extra1'],
            ':extra2' => $_POST['extra2'],
            ':extra3' => $_POST['extra3'],
            ':extra4' => $_POST['extra4'],
            ':extra5' => $_POST['extra5'],
            ':photo' => 'http://placehold.it/348x456',
            ':state' => $_POST['state'],
            ':me' => $_POST['me'],   
            ':id' =>$id[0]  
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
         
 





            if($_POST['mentor']==1)

                { 

            $query= "

                INSERT INTO mentors (id,college,major)
                VALUES (
                    :id,
                    :college,
                    :major

                    )";

            $query_params = array( 

            ':id' => $id[0],
            ':college' => $_POST['college'],
            ':major' => $_POST['major']

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
                    die("Failed to run mentor query: " . $ex->getMessage()); 
                } 

                }

                else {

            $query= "

                    INSERT INTO mentees (id,mentorid1,mentorid2,mentorid3)
                    VALUES (
                    :id,
                    0,
                    0,
                    0

                    )";

            $query_params = array( 

            ':id' => $id[0]

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
                    die("Failed to run mentor query: " . $ex->getMessage()); 
                } 

                 $query= "

                    INSERT INTO views (id,vcount)
                    VALUES (
                    :id,
                    0
                    

                    )";

            $query_params = array( 

            ':id' => $id[0]

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
                    die("Failed to run mentor query: " . $ex->getMessage()); 
                } 

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
        <li>Interests</li> 
        <li>Gender Prefs</li> 
        <li>Connect</li>  
        <li>Mentoring</li> 
        <li>Time</li> 
        <li>Availability</li>  
        <li>Profile</li>
        <li>Mentors Only</li>  
    </ul>
    <!-- fieldsets -->
    <fieldset>
        <h2 class="fs-title">Create your account</h2>
        <h3 class="fs-subtitle">Welcome to MentorBear!</h3>
        <input type="text" name="username" placeholder="First Name" />
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
             <input type="radio" value="0" id="mentee" name="mentor"/>
            <label for="mentee">Mentee</label>
        </div>
        <div class="squaredOne" id="square6">
             <input type="radio" value="1" id="mentor" name="mentor" />
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
    <th>  <div class="  squaredOne" id="art">
             <input type="checkbox" value="1" id="art1" name="art"/>
            <label for="art1">Art</label></div></th>

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
    <th> <div class="squaredOne" id="literature">
             <input type="checkbox" value="1" id="literaturel" name="literature"/>
            <label for="literaturel">Literature</label>
        </div></th>
  </tr>


</table>


        <input type="button" name="previous" class="previous action-button" value="Previous" />
       <input type="button" name="next" class="next action-button" value="Next" />
    </fieldset>
    <fieldset>
        <h2 class="fs-title">Interests</h2>
        <h3 class="fs-subtitle">Share your 5 favorite hobbies/extracurriculars</h3>
        <input type="text" name="extra1" placeholder="" />
        <input type="text" name="extra2" placeholder="" />
        <input type="text" name="extra3" placeholder="" />
        <input type="text" name="extra4" placeholder="" />
        <input type="text" name="extra5" placeholder="" />
        <input type="button" name="previous" class="previous action-button" value="Previous" />
        <input type="button" name="next" class="next action-button" value="Next" />
    </fieldset>


    <fieldset>
        <h2 class="fs-title">Do you have a gender preference for your mentor/mentee?</h2>
         <h3 class="fs-subtitle">Please choose only one option...</h3>
       <div class="squaredOne" id="femaleonly">
             <input type="checkbox" value="1" id="female1" name="genderpref" />
            <label for="female1">Female only</label>
        </div>
        <div class="squaredOne" id="maleonly">
             <input type="checkbox" value="2" id="male1" name="genderpref"/>
            <label for="male1">Male only</label>
        </div>
        <div class="squaredOne" id="dontmind">
             <input type="checkbox" value="3" id="dm" name="genderpref"/>
            <label for="dm">I don't mind</label>
        </div>
         <input type="button" name="previous" class="previous action-button" value="Previous" />
        <input type="button" name="next" class="next action-button" value="Next" />
    </fieldset>


        <fieldset>
        <h2 class="fs-title">How would you prefer to connect with your mentor/mentee</h2>
        <h3 class="fs-subtitle">Choose as many as you'd like</h3>

       <div class="squaredOne" id="inperson">
            <input type="checkbox" value="1" id="inperson1" name="inperson" />
            <label for="inperson1">In-Person</label>
        </div>
        <div class="squaredOne" id="email2">
             <input type="checkbox" value="1" id="email1" name="email2"/>
            <label for="email1">E-mail</label>
        </div>
         <div class="squaredOne" id="vchat">
            <input type="checkbox" value="1" id="vchat1" name="vchat" />
            <label for="vchat1">Video Chat</label>
        </div>
        <div class="squaredOne" id="im">
             <input type="checkbox" value="1" id="im1" name="im"/>
            <label for="im1">Instant Message</label>
        </div>
         <div class="squaredOne" id="phone">
            <input type="checkbox" value="1" id="phone1" name="phone" />
            <label for="phone1">Phone</label>
        </div>
        <div class="squaredOne" id="other">
             <input type="checkbox" value="1" id="other1" name="other"/>
            <label for="other1">Other</label>
        </div>

         <input type="button" name="previous" class="previous action-button" value="Previous" />
        <input type="button" name="next" class="next action-button" value="Next" />
    </fieldset>



            <fieldset>
        <h2 class="fs-title">In which areas would you most value a mentor?</h2>
        <h3 class="fs-subtitle">Choose as many as you'd like</h3>
       <div class="squaredOne" id="Academics">
             <input type="checkbox" value="1" id="academics1" name="academics" />
            <label for="academics1">Academics</label>
        </div>
        <div class="squaredOne" id="Careers">
             <input type="checkbox" value="1" id="careers1" name="careers"/>
            <label for="careers1">Careers</label>
        </div>
        <div class="squaredOne" id="sociallife">
             <input type="checkbox" value="1" id="sociallife1" name="sociallife"/>
            <label for="sociallife1">Social Life</label>
        </div>
        <div class="squaredOne" id="applications">
             <input type="checkbox" value="1" id="applications1" name="applications"/>
            <label for="applications1">Applications</label>
        </div>
         <div class="squaredOne" id="scholarships">
             <input type="checkbox" value="1" id="scholarships1" name="scholarships"/>
            <label for="scholarships1">Scholarships</label>
        </div>
        <div class="squaredOne" id="transitioning">
             <input type="checkbox" value="1" id="transitioning1" name="transitioning"/>
             <label for="transitioning1">Transition to College</label>
        </div>
         <input type="button" name="previous" class="previous action-button" value="Previous" />
        <input type="button" name="next" class="next action-button" value="Next" />


    </fieldset>

        </fieldset>
        <fieldset>
        <h2 class="fs-title">How much time (per week) would you like to spend with your mentor/mentee?</h2>
        <h3 class="fs-subtitle">Please check one</h3>

       <div class="squaredOne" id="time1">
            <input type="checkbox" value="1" id="t1" name="time" />
            <label for="t1">15-30 minutes</label>
        </div>
        <div class="squaredOne" id="time2">
             <input type="checkbox" value="2" id="t2" name="time"/>
            <label for="t2">30-45 minutes</label>
        </div>
         <div class="squaredOne" id="time3">
            <input type="checkbox" value="3" id="t3" name="time" />
            <label for="t3">45-60 minutes</label>
        </div>
        <div class="squaredOne" id="time4">
             <input type="checkbox" value="4" id="t4" name="time"/>
            <label for="t4">1-1.5 hours</label>
        </div>
         <div class="squaredOne" id="time5">
            <input type="checkbox" value="5" id="t5" name="time" />
            <label for="t5">1.5-3 hours</label>
        </div>
        <div class="squaredOne" id="time6">
             <input type="checkbox" value="6" id="t6" name="time"/>
            <label for="t6">3+ hours</label>
        </div>

        <input type="button" name="previous" class="previous action-button" value="Previous" />
        <input type="button" name="next" class="next action-button" value="Next" />

    </fieldset>

    <fieldset>
        <h2 class="fs-title">When would you be most available?</h2>
        <h3 class="fs-subtitle">Feel free to select more than one</h3>

       <div class="squaredOne" id="weekdays">
            <input type="checkbox" value="1" id="weekdayz" name="weekdays" />
            <label for="weekdayz">Weekdays</label>
        </div>
        <div class="squaredOne" id="saturdays">
             <input type="checkbox" value="1" id="saturdayz" name="saturdays"/>
            <label for="saturdayz">Saturdays</label>
        </div>
         <div class="squaredOne" id="sundays">
            <input type="checkbox" value="1" id="sundayz" name="sundays" />
            <label for="sundayz">Sundays</label>
        </div>

        <input type="button" name="previous" class="previous action-button" value="Previous" />
        <input type="button" name="next" class="next action-button" value="Next" />
    </fieldset>

    <fieldset>
        <h2 class="fs-title">Profile</h2>
        <h3 class="fs-subtitle">You're almost done!</h3>

        <textarea name="me" id="bio" placeholder="Write a few sentences about yourself for your profile."></textarea>

        <input type="text" name="state" id="city" placeholder="What state do you live in?" />

        <input type="button" name="previous" class="previous action-button" value="Previous" />
        <input type="button" name="next" class="next action-button" value="Next" />
        
    </fieldset>
    <fieldset>
        <h2 class="fs-title">Mentors Only</h2>
        <h3 class="fs-subtitle">Please only answer if you are a college student. Otherwise, just click register!</h3>

        <input type="text" name="college" id="city" placeholder="What college do you attend?" />

        <input type="text" name="major" id="city" placeholder="What is your college major?" />

        <input type="button" name="previous" class="previous action-button" value="Previous" />

        <input type="submit" value="Register" />
    </fieldset>

</form>

<!-- jQuery -->
<script src="http://thecodeplayer.com/uploads/js/jquery-1.9.1.min.js" type="text/javascript"></script>
<!-- jQuery easing plugin -->
<script src="http://thecodeplayer.com/uploads/js/jquery.easing.min.js" type="text/javascript"></script>

 <script src="js/form.js"></script>

</body>

</html>