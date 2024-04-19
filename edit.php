<?php 
   session_start();
   include("php/config.php");
   if(!isset($_SESSION['valid'])){
    header("Location: index.php");
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/box.css">
    <title>Change profile</title>
</head>
<body>
    <?php include "header.php"; ?>
    <div class="container">
        <div class="box form-box">
            <?php 
               if(isset($_POST['submit'])){
                $username = $_POST['username'];
                $email = $_POST['email'];
                $id = $_SESSION['id'];
                $verify_query = mysqli_query($con,"SELECT email FROM users WHERE email='$email'");
                $session_email = mysqli_fetch_assoc($verify_query);
                if(mysqli_num_rows($verify_query) !=0 && $session_email['email'] != $_SESSION['valid']){
                    echo "<div class='message'>
                      <p>This email is used, Try another One Please</p>
                        </div> <br> " ;
                    echo "<a href='edit.php'><button class='btn'>Go Back</button></a>";
                }
                else {
                    $edit_query = mysqli_query($con,"UPDATE users SET username='$username', email='$email' WHERE id=$id ") or die("error occurred");
                if($edit_query){
                    echo "<div class='messageGreen'>
                    <p>Your profile has been Updated</p>
                </div> <br>";
              echo "<a href='main.php'><button class='btn'>Go Home</button></a>";
                }
                }
                } elseif(isset($_POST['delete'])) {
                    $username = $_POST['username'];
                    $email = $_POST['email'];
                    $id = $_SESSION['id'];
                    $delete_query = mysqli_query($con,"DELETE FROM users WHERE id=$id ") or die("error occurred");
                    echo "<div class='messageGreen'>
                            <p>Your account has been deleted</p>
                          </div> <br>";
                    echo "<a href='php/logout.php'><button class='btn'>Go Back</button></a>"; 
                }
                else{
                $id = $_SESSION['id'];
                $query = mysqli_query($con,"SELECT*FROM users WHERE id=$id ");
                while($result = mysqli_fetch_assoc($query)){
                    $res_Uname = $result['username'];
                    $res_Email = $result['email'];
                }
            ?>
            <header data-lan="changeprofile">Change Profile</header>
            <form action="" method="post">
                <div class="field input">
                    <label data-lan="username">Username</label>
                    <input type="text" name="username" id="username" value="<?php echo $res_Uname; ?>" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label data-lan="email">Email</label>
                    <input type="text" name="email" id="email" value="<?php echo $res_Email; ?>" autocomplete="off" required>
                </div>
                <div class="field">
                    <button data-lan="update" type="submit" class="btn" name="submit" required>Update</button>
                </div>
                <div class="field">
                    <button data-lan="delete" type="submit" class="btn-red" name="delete" required>Delete your account</button>
                </div>
            </form>
        </div>
        <?php } ?>
      </div>
      <?php include "footer.html"; ?>
</body>
</html>