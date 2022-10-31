<?php

   include "insert_function.php";

    $pname = $_POST['fname']." ".$_POST['lname'];
    $dob = $_POST['dob'];
    $sex = $_POST['sex'];
    $tel = $_POST['phone'];
    
    try{

        $pdo = new PDO("mysql:host=localhost;dbname=system_hospital","root","");
        $pdo->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
        $stmt = $pdo->prepare("SELECT pid FROM patient ORDER BY pid DESC LIMIT 1");
        $stmt->execute();

        if($stmt->rowCount() > 0){
            $lastPid = substr($stmt->fetch()['pid'],2);
            $pid = createPid($lastPid,$pdo);
            insertP($pdo,$pid,$pname,$dob,$sex);
            inserTel($pdo,$pid,$tel);
            insertDisease($pdo,$pid);
            header("location:insert_success.php?pid=$pid");
            
        }else{
            $pid = "HN53127201";
            insertP($pdo,$pid,$pname,$pdob,$psex);
            inserTel($pdo,$pid,$tel);
            insertDisease($pdo,$pid,$disease);
            header("location:insert_success.php?pid=$pid");
        }

        

    }
    catch(PDOException $e){
        echo "Connection Fail : ".$e->getMessage();
    }
?>