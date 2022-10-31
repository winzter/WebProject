<?php
    function inserTel($pdo,$pid,$tels){
        foreach($tels as $value){
            $insertTel = $pdo->prepare("INSERT INTO ptel VALUES(?,?)");
            $insertTel->bindParam(1,$pid);
            $insertTel->bindParam(2,$value);
            $insertTel->execute();
        }
    }

    function updateTel($pdo,$pid,$tels){
        foreach($tels as $value){
            $updateTel = $pdo->prepare("UPDATE ptel SET pnumber = ? WHERE pid = ?");
            $updateTel->bindParam(1,$pid);
            $updateTel->bindParam(2,$value);
            $updateTel->execute();
        }
    }

    function insertDisease($pdo,$pid){
        if(isset($_POST['d'])){
            foreach($_POST['d'] as $d){
                $insertD = $pdo->prepare("INSERT INTO disease VALUES(?,?)");
                $insertD->bindParam(1,$pid);
                $insertD->bindParam(2,$d);
                $insertD->execute();
            }
        }
    }

    function createPid($pid) {
        
        settype($pid, "integer");
        $pid += 1;
        settype($pid,"string");
        $newPid = "HN".$pid;
        return $newPid;
    }

    function insertP($pdo,$pid,$pname,$dob,$sex){
        $insertP = $pdo->prepare("INSERT INTO patient(pid , pfnamelname , pdob , psex) VALUES(?,?,?,?)");
        $insertP->bindParam(1,$pid);
        $insertP->bindParam(2,$pname);
        $insertP->bindParam(3,$dob);
        $insertP->bindParam(4,$sex);
        $insertP->execute();
    }

    
?>