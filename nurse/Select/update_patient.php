<?php
    $pid = $_GET['pid'];
    $pname = $_GET['fname']." ".$_GET['lname'];
    $dob = $_GET['dob'];
    $sex = $_GET['sex'];
    $date = $_GET['date'];

    if($date == ""){
        $date = null;
    }
    
    try{
        $pdo = new PDO("mysql:host=localhost;dbname=system_hospital","root","");
        $pdo->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION); 

        $pInfo = $pdo->prepare("UPDATE patient SET pfnamelname = ? , pdob = ? , psex = ? WHERE pid = ?");
        $pInfo->bindParam(4,$pid);
        $pInfo->bindParam(1,$pname);
        $pInfo->bindParam(2,$dob);
        $pInfo->bindParam(3,$sex);
        $pInfo->execute();
        
        $leavedate = $pdo->prepare("UPDATE seeadoctor SET leavedate = ? WHERE pid = ?");
        $leavedate->bindParam(1,$date);
        $leavedate->bindParam(2,$pid);
        $leavedate->execute();
       

        if(isset($_GET['phone'])){
            $phone = $_GET['phone'];
            $Oldnum = $pdo->prepare("SELECT pnumber FROM ptel WHERE pid = ?");
            $Oldnum->bindParam(1,$pid);
            $Oldnum->execute();
            $telArr = array();
            while($row = $Oldnum->fetch()){
                array_push($telArr,$row['pnumber']);
            }
            $indexT = 0;
            while($indexT < sizeof($telArr)){
                $updateTel = $pdo->prepare("UPDATE ptel SET pnumber = ? WHERE pid = ? AND pnumber = ?");
                $updateTel->bindParam(2,$pid);
                $updateTel->bindParam(1,$phone[$indexT]);
                $updateTel->bindParam(3,$telArr[$indexT]);
                $updateTel->execute();
                $indexT++;
            }
        }
        
        if(isset($_GET['d'])){
            $disease = $_GET['d'];
            $Olddisease= $pdo->prepare("SELECT pdisease FROM disease WHERE pid = ?");
            $Olddisease->bindParam(1,$pid);
            $Olddisease->execute();
            $diseaseArr = array();
            while($row = $Olddisease->fetch()){
                array_push($diseaseArr,$row['pdisease']);
            }

            $indexD = 0;
            while($indexD < sizeof($diseaseArr)){
                $updateTel = $pdo->prepare("UPDATE disease SET pdisease = ? WHERE pid = ? AND pdisease = ?");
                $updateTel->bindParam(2,$pid);
                $updateTel->bindParam(1,$disease[$indexD]);
                $updateTel->bindParam(3,$diseaseArr[$indexD]);
                $updateTel->execute();
                $indexD++;
            }
        }
        header("location: ../Select/patient.php");
    }
    catch(PDOException $e){
        echo "Connection Fail : ".$e;
    }
?>