<?php 
   session_start();
?>
<link rel="stylesheet" href="css/box.css">
            <?php
              include("php/config.php");
              if(isset($_POST['submit'])){
                $email = mysqli_real_escape_string($con,$_POST['email']);
                $password = mysqli_real_escape_string($con,$_POST['password']);
                $result = mysqli_query($con,"SELECT * FROM users WHERE email='$email' AND password='$password' ") or die("Select Error");
                $row = mysqli_fetch_assoc($result);
                if(is_array($row) && !empty($row)){
                    $_SESSION['valid'] = $row['email'];
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['id'] = $row['id'];
                }else{
                    echo "
                    <div class='container'>
                    <div class='box form-box'>
                    <div class='message'>
                      <p>Wrong Username or Password</p>
                       </div> 
                       <a href='index.html'><button class='btn'>Go Back</button>
                       <br>
                       </div>";
                }
                if(isset($_SESSION['valid'])){
                    header("Location: main.php");
                }
              }
            ?>
            