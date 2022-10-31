<?php
    $pid = $_GET['pid'];
    $pdo = new PDO("mysql:host=localhost;dbname=system_hospital","root","");
    $pdo->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
    $patient = $pdo->prepare("SELECT * FROM followorder WHERE followorder.dosid IN
    (SELECT seeadoctor.dosid FROM seeadoctor WHERE seeadoctor.pid IN
     (SELECT patient.pid FROM patient WHERE patient.pid = ?))");
    $patient->bindParam(1,$pid);
    $patient->execute();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        th,tr,td,table{
            border: 1px solid black;
        }
    </style>
</head>
<body>
    <?php if($patient->rowCount() > 0){?>
        <table>
            <tr>
                <th>Nurse ID</th>
                <th>Doctor's order sheet ID</th>
                <th>Follow Date</th>
                <th>Follow Time</th>
                <th>Order Date</th>
                <th>Order Time</th>
                <th>Detail</th>
            </tr>
            <?php while($row = $patient->fetch()) : ?>
                <tr>
                    <td><?=$row['nid']?></td>
                    <td><?=$row['dosid']?></td>
                    <td><?=$row['followdate']?></td>
                    <td><?=$row['followtime']?></td>
                    <td><?=$row['orderdate']?></td>
                    <td><?=$row['ordertime']?></td>
                    <td><?=$row['detail']?></td>
                </tr>
            <?php endwhile ?>
        </table>
    <?php } 
    else{
        echo "Patient's history not found.<br>";
    } ?>
    

    <a href="patient.php">back to previous page</a>
</body>
</html>