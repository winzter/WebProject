<?php
    $pid = $_GET['pid'];
    try{
        $pdo = new PDO("mysql:host=localhost;dbname=system_hospital","root","");
        $pdo->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
        $pInfo = $pdo->prepare("SELECT * FROM patient WHERE pid = ?");
        $pInfo->bindParam(1,$pid);
        $pInfo->execute();

        $pTel = $pdo->prepare("SELECT * FROM ptel WHERE pid = ?");
        $pTel->bindParam(1,$pid);
        $pTel->execute();

        $pDisease = $pdo->prepare("SELECT * FROM disease WHERE pid = ?");
        $pDisease->bindParam(1,$pid);
        $pDisease->execute();
    }
    catch(PDOException $e){
        echo "Connection Fail : ".$e;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <?php while($row=$pInfo->fetch()) : ?>
            <p>Patient ID : <?=$row['pid']?></p>
            <p>Firstname Lastname : <?=$row['pfnamelname']?></p>
            <p>Date Of Birth : <?=$row['pdob']?></p>
            <p>Age : <?=$row['page']?></p>
            <p>Sex : <?=$row['psex']?></p>
        <?php endwhile ?>
            <p>Tel : 
        <?php while($row=$pTel->fetch()) : ?>
                <?=$row['pnumber']?>
        <?php endwhile ?>
            </p>
            <p>Disease : 
        <?php while($row=$pDisease->fetch()) : ?>
                <?=$row['pdisease']?>
        <?php endwhile ?>
            </p>
            <a href="../Select/patient.php">รายชื่อคนไข้</a>
    </div>
</body>
</html>