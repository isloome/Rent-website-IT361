<?php 
   $status = session_status();
   if($status == PHP_SESSION_NONE){
       //There is no active session
       session_start();
   }else
   if($status == PHP_SESSION_DISABLED){
       //Sessions are not available
   }
   include("php/config.php");
   if(!isset($_SESSION['valid'])){
    header("Location: index.php");
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/dropdown.css">
    <link rel="icon" href="img/icon.png">
    <title>Home</title>
</head>
<body>
    <header>
    <nav>
        <div>
            <a href="main.php"><img id="logo" src="img/logo.png" alt="website logo"></a>
        </div>
        <div class="links">
            <div class="nav-btn">
            <a href="main.php" data-lan="home">Home</a>
            <a href="about.html" data-lan="about">About</a>
            <a href="contact.html" data-lan="contact">Contact us</a>
            </div>
            <div class="langselect">
                <div class="profile-dropdown">
                    <div onclick="toggle()" class="profile-dropdown-btn">
                    <div class="profile-img">
                        <img src="img/icon.png" alt="profile img">
                    </div>
                    <div class="dropdown-username">
                    <p>
                        <?php echo $_SESSION['username']?>
                    </p>
                    </div>
                </div>
                <ul class="profile-dropdown-list">
                    <?php 
                    $id = $_SESSION['id'];
                    $query = mysqli_query($con,"SELECT*FROM users WHERE id=$id");
                    while($result = mysqli_fetch_assoc($query)){
                        $res_Uname = $result['username'];
                        $res_Email = $result['email'];
                        $res_id = $result['id'];}
                    echo "
                    <li class='profile-dropdown-list-item'>
                    <a href='edit.php?Id=$res_id'>
                    Edit Profile
                    </a>
                    </li> <hr>";  
                    echo "
                    <li class='profile-dropdown-list-item'>
                    <a href='add.php?Id=$res_id'>
                    Add Post
                    </a>
                    </li>";
                    ?>
                    <hr>
                    <li class="logout-btn">
                        <a href="php/logout.php">
                            <button class="btn">Log Out</button>
                        </a>
                    </li>
                </ul>
            </div>
            <select>
                <option value="en" data-i18n="english" selected>English</option>
                <option value="ar" data-i18n="arabic">Arabic</option>
            </select>
            </div>
        </div>
    </nav>
    </header>
    <script src="js/script.js" type="module"></script>
    <script src="js/dropdown.js"></script>
</body>
</html>