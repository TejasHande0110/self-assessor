<?php
if(isset($_GET['email'])){
    
    include "dbconnection.php";
    $email=$_GET['email'];
    $del=mysqli_query($conn,"DELETE FROM `users` WHERE `email` LIKE '$email'");
    if($del){
        mysqli_close($conn);
        header("location:adminpage.php?");
        exit;
    }else{
        echo "Error in Deleting record";
    }
}
if(isset($_GET['datetime'])){
    
    include "dbconnection.php";
    $dt=$_GET['datetime'];
    $del=mysqli_query($conn,"DELETE FROM `feedback` WHERE `datetime` LIKE '$dt'");
    if($del){
        mysqli_close($conn);
        header("location:adminpage.php?");
        exit;
    }else{
        echo "Error in Deleting record";
    }
}
if(isset($_GET['qid']))
{
    include "dbconnection.php";
    $qid=$_GET['qid'];
    $del=mysqli_query($conn,"DELETE FROM `quiz` WHERE `qid` LIKE '$qid'");
    $del2=mysqli_query($conn,"DELETE FROM `questions` WHERE `qid` LIKE '$qid'");
    $del3=mysqli_query($conn,"DELETE FROM `options` WHERE `qid` LIKE '$qid'");
    $del4=mysqli_query($conn,"DELETE FROM `answers` WHERE `qid` LIKE '$qid'");
    if($del4){
        mysqli_close($conn);
        header("location:adminpage.php");
        exit;
    }else{
        echo "Error in Deleting record";
    }
}
?>