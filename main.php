<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>title</title>
</head>
<body>
    <?php 
    include "header.php";
    include "php/config.php"
     ?>
    <?php
    $begin=0;
    $rp_page=5;
    $record = $con->query("SELECT * FROM posts ");
    $numr = $record->num_rows;
    $pages = ceil($numr / $rp_page);
    if(isset($_GET["page-num"])){
        $page = $_GET["page-num"] - 1;
        $begin = $page*$rp_page;}
        $result = $con->query("SELECT * FROM posts LIMIT $begin,$rp_page");
        ?>
    <div class="content">
    <table>
                <tr>
                    <th data-lan="image">Image</th>
                    <th data-lan="title">Title</th>
                    <th data-lan="model">Model</th>
                    <th data-lan="description">Description</th>
                </tr>
        <?php while($rows = $result->fetch_assoc()){ ?>
                <tr class="posts">
                    <td class="image" width="290"><img width="290" height="150" src="<?php echo $rows["img_src"] ?>" alt=""></td>
                    <td class="title"><?php echo $rows["title"];?></td>
                    <td class="model" width="80"><?php echo $rows["model"];?></td>
                    <td class="description"><?php echo $rows["description"]?></td>
                </tr>
            <?php
        }
        ?>
        </table>
        </div>
        <?php ?>
        <div >
            <!----------------------Info field--------------------------->
            <div class="paging-info">
                <?php 
                if(!isset($_GET["page-num"])){
                    $page = 1;
                }
                else{
                    $page = $_GET["page-num"];
                }
                ?>
            <p data-lan="show">Showing</p> <p><?php echo $page?></p> <p data-lan="to">to</p> <p><?php echo $pages?></p> <p data-lan="pages">pages</p>
            </div>
            <div class="paging">
            <!----------------------First button--------------------------->
            <a href="?page-num=1" data-lan="first">First</a>
            <!----------------------Previous button--------------------------->
            <?php
            if(isset($_GET["page-num"]) && ($_GET["page-num"])>1){
                ?>
                <a href="?page-num=<?php echo $_GET["page-num"]-1?>" data-lan="previous">Previous</a>
                <?php } 
            else{ ?>
                    <P class="btn-disable" data-lan="previous">Previous</P>
                    <?php 
                }?>
            <!----------------------number button--------------------------->
                <?php 
                for($count=1;$count<=$pages;$count++){
                ?>
                <?php if($count==$page){
                ?> 
                <p><?php echo $count?></p>
                <?php 
                } else {?>
                <a href="?page-num=<?php echo $count?>"><?php echo $count?></a>
                <?php } }?>          
            <!----------------------Next button--------------------------->   
            <?php
            if(!isset($_GET["page-num"]))
            { 
                ?>
                <a href="?page-num=2" data-lan="next">Next</a>
                <?php
                } 
            else{
                if($_GET["page-num"] >= $pages)
                { 
                    ?>
                    <p class="btn-disable" data-lan="next">Next</p>
                    <?php 
                    } 
                else{ 
                    ?>
                    <a href="?page-num=<?php echo $_GET["page-num"] + 1 ?>"  data-lan="next">Next</a>
                    <?php 
                    }
                }?>
                <!----------------------Last button--------------------------->
            <a href="?page-num=<?php echo $pages?>" data-lan="last" data-lan="last">Last</a>
            </div>
        </div>
        <?php include "footer.html";?>
</body>
</html>
