<?php
    $pdo = new PDO("mysql:host=localhost;dbname=system_hospital","root","");
    $pdo->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
    $patient = $pdo->prepare("SELECT * FROM patient");
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
    <table>
        <tr>
            <th>Patient ID</th>
            <th>Name</th>
            <th>Date Of Birth</th>
            <th>Age</th>
            <th>Sex</th>
            <th>History</th>
        </tr>
        <?php while($row = $patient->fetch()) : ?>
            <tr>
                <td><a href="patient_info.php?pid=<?=$row['pid']?>"><?=$row['pid']?></a></td>
                <td><?=$row['pfnamelname']?></td>
                <td><?=$row['pdob']?></td>
                <td><?=$row['page']?></td>
                <td><?=$row['psex']?></td>
                <td><a href="patient_history.php?pid=<?=$row['pid']?>">History</a></td>
            </tr>
        <?php endwhile ?>
    </table>
</body>
</html>