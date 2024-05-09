<?php
include_once('./config/ketnoi.php');


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .aA1{
            width: 200px;
            height: 200px;
            background-color: gray;
            color: white;
        }
    </style>
</head>
<body>
    <?php
    $query = mysqli_query($conn,"SELECT * FROM Products");

        while($resukt = mysqli_fetch_array($query))
        {
            ?>
    <div>
        <div class="aA1">
            <a href="asdasd.php?id=">San Pham A</a>
            <?php
                if ($resukt['status_product']==0)
                {
                    echo '<span> Con Hang </span>';
                }
                else
                {
                    echo '<span> het Hang </span>';
                }
            ?>
        </div>
    </div>
            <?php
        }
    ?>
</body>
</html>