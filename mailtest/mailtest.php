<html>
<head>
<title>Sending HTML email using PHP</title>
</head>
<body>
<?php
   $to = "adriansblack@gmail.com";
   $subject = "Open Please";
   $message = "<b>Hello Adrian</b>";
   $message .= "<h1>We got news!</h1>";
   $header = "From:adriancorp@adrian.com \r\n";
   $header .= "MIME-Version: 1.0\r\n";
   $header .= "Content-type: text/html\r\n";
   $retval = mail ($to,$subject,$message,$header);
   if( $retval == true )
   {
      echo "Message sent successfully...";
   }
   else
   {
      echo "Message could not be sent...";
   }
?>
</body>
</html>