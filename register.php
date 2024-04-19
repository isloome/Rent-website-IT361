<link rel="stylesheet" href="css/box.css">
<?php  
         include("php/config.php");
         if(isset($_POST['submit'])){
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
         $verify_query = mysqli_query($con,"SELECT email FROM users WHERE email='$email'");
         if(mysqli_num_rows($verify_query) !=0 ){
            echo "<div class='container'>
                    <div class='box form-box'>
                        <div class='message'>
                            <p>This email is used, Try another One Please!</p>
                        </div>
                        <a href='register.html'><button class='btn'>Go Back</button></a>
                    </div>
                  </div> <br>";
         } else{
            mysqli_query($con,"INSERT INTO users(username,email,password) VALUES('$username','$email','$password')") or die("Erroe Occured");
            echo "<div class='container'>
            <div class='box form-box'>
                <div class='messageGreen'>
                    <p>Registration successfully</p>
                </div>
                <a href='index.html'><button class='btn'>Login Now</button></a>
            </div>
          </div> <br>";
         }
         }else{
            echo "<div class='container'>
            <div class='box form-box'>
                <div class='message'>
                    <p>Error</p>
                </div>
                <a href='register.html'><button class='btn'>Go Back</button></a>
            </div>
          </div> <br>";
         }
        ?>