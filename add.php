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
    <title>Test</title>
</head>
<body>
    <?php include "header.php";?>
    <div class="container">
        <div class="box form-box">
            <?php 
               if(isset($_POST['submit'])){
                $carname = $_POST['carname'];
                $model = $_POST['model'];
                $description = $_POST['description'];
                $id = $_SESSION['id'];
                $dir = "data/";
                $file = $dir . basename($_FILES["image"]["name"]);
                $counter = 1;
                $uploadStat = 1;
                $imageType = strtolower(pathinfo($file,PATHINFO_EXTENSION));   
                $check = getimagesize($_FILES["image"]["tmp_name"]);
                if($check !== false) {
                  $uploadStat = 1;
                } else {
                  $uploadStat = 0;
                }
                  // Check if file already exists change name
                while (file_exists($file)) {
                  $counter++;
                  $file = $dir . $counter . basename($_FILES["image"]["name"]);
                }
                  // Check image type certain file formats
                if($imageType != "jpg" && $imageType != "png" && $imageType != "jpeg") {
                  echo "<div class='message'>
                    <p>Sorry, Only JPG, JPEG & PNG images are allowed</p>
                    </div> <br>";
                  echo "<a href='add.php'><button class='btn'>Go Back</button></a>";
                  $uploadStat = 0;
                }
                else{
                  // Check if $uploadOk is set to 0 by an error
                if ($uploadStat == 0) {
                  echo "<div class='message'>
                    <p>Sorry, your image was not uploaded</p>
                    </div> <br>";
                    echo "<a href='add.php'><button class='btn'>Go Back</button></a>";
                  // if everything is ok, try to upload file
                } else {
                  if (move_uploaded_file($_FILES["image"]["tmp_name"], $file)) {
                    $add_query = mysqli_query($con,"INSERT INTO posts(title,model,description,img_src,user_id) VALUES('$carname','$model','$description','$file','$id')") or die("error occurred");

                  if($add_query && $uploadStat = 1){
                    echo "<div class='messageGreen'>
                    <p>Your post has been posted</p>
                    </div> <br>";
                    echo "<a href='main.php'><button class='btn'>Go Home</button></a>";
                    }
                  } else {
                    echo "<div class='message'>
                    <p>Sorry, there was an error uploading your image</p>
                    </div> <br>";
                    echo "<a href='add.php'><button class='btn'>Go Back</button></a>";
                  }
                }
              }
                } 
                else{
                $id = $_SESSION['id'];
                $query = mysqli_query($con,"SELECT*FROM users WHERE id=$id ");
                while($result = mysqli_fetch_assoc($query)){
                    $res_Uname = $result['username'];
                    $res_Email = $result['email'];
                }
            ?>
            <header data-lan="addpost">Add Post</header>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="field input">
                    <label data-lan="carname">Car name</label>
                    <input type="text" name="carname" id="carname"  autocomplete="off" required>
                </div>
                <div class="field input">
                    <label data-lan="model">Model</label>
                    <input type="tel" name="model" id="model" maxlength="4" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label data-lan="description">Description</label>
                    
                    <textarea name="description" id="description" cols="30" rows="5"></textarea>
                </div>
                <div class="field ">
                    <label data-lan="addimage">Add image</label>
                    <input type="file" name="image" id="image" required>
                </div>
                <div class="field">
                    <button data-lan="add" type="submit" class="btn" name="submit" required>Add</button>
                </div>
            </form>
        </div>
        <?php } ?>
      </div>
      <?php include "footer.html"; ?>
</body>
</html>