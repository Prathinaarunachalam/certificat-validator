<?php
   include("config.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      $certificateno = mysqli_real_escape_string($conn, $_POST['certificateno']);
      $DOB = mysqli_real_escape_string($conn, $_POST['DOB']); 
      
      $sql = "SELECT id FROM admin WHERE certificateno = ? AND DOB = ?";
      $stmt = mysqli_prepare($conn, $sql);
      mysqli_stmt_bind_param($stmt, "ss", $certificateno, $DOB);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);
      
      $count = mysqli_stmt_num_rows($stmt);
      if($count == 1) {
         $_SESSION['login_user'] = $certificateno;
         
         header("location: welcome.php");
         exit();
      } else {
         $error = "Your Login certificate number or date of birth is invalid";
      }
      mysqli_stmt_close($stmt);
   }
?>

<html>
   <head>
      <title>Login Page</title>
      
      <style type = "text/css">
         body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
         }
         label {
            font-weight:bold;
            width:100px;
            font-size:14px;
         }
         .box {
            border:#666666 solid 1px;
         }
      </style>
   </head>
   
   <body bgcolor = "#FFFFFF">
      <div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>
            <div style = "margin:30px">
               <form action = "" method = "post">
                  <label>certificate no.:</label><input type = "text" name = "certificateno" class = "box"/><br /><br />
                  <label>date of birth:</label><input type = "date" name = "DOB" class = "box" /><br/><br />
                  <input type = "submit" value = "Submit"/><br />
               </form>
               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
            </div>
         </div>
      </div>
   </body>
</html>
