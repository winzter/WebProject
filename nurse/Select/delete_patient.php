<?php

    $pid = $_GET['pid'];
    
    $pdo = new PDO("mysql:host=localhost;dbname=system_hospital","root","");
    $pdo->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
    if(isset($_GET['tel'])){
        $value = $_GET['tel'];
        $deletTel = $pdo->prepare("DELETE FROM ptel WHERE pid = ? AND pnumber = ?");
        $deletTel->bindParam(1,$pid);
        $deletTel->bindParam(2,$value);
        $deletTel->execute();
    }
    if(isset($_GET['dis'])){
        $value = $_GET['dis'];
        $deletTel = $pdo->prepare("DELETE FROM disease WHERE pid = ? AND pdisease = ?");
        $deletTel->bindParam(1,$pid);
        $deletTel->bindParam(2,$value);
        $deletTel->execute();
    }
    
?>