<?php
 session_start();
 include "dbconnection.php";
 $qid=$_SESSION['qid'];
 $sql="SELECT * FROM `quiz` WHERE `qid` LIKE '$qid'";
 $result=$conn->query($sql);
 $row = $result->fetch_assoc();
 $total=$row['total que'];
 $topic=$row['topic'];
 $match=0;
 $temp=0;
 $correct=0;

if(isset($_POST['check']))
{
    $match=count($_POST['check']);
    $answer=$_POST['check'];
    $i=1;

    $sql2="SELECT `answer` FROM `answers` WHERE `qid` LIKE '$qid'";
    $result2=$conn->query($sql2);
    while($row2 = $result2->fetch_assoc()) {
        $check = $row2['answer']==$answer[$i];
        $sql3="SELECT * FROM `questions` WHERE `eid` LIKE '$i'";
        $result3=$conn->query($sql3);
        $row3 = $result3->fetch_assoc();
        $marks=$row3['marks'];
        if($check){
            $result= $temp + $marks;
            $temp=$result;
            $correct++;
        }
        $i++;
    }
}
    $incorrect = $total -  $correct;
    $_SESSION['total']=$total;
    $_SESSION['match']=$match;
    $_SESSION['correct']=$correct;
    $_SESSION['incorrect']=$incorrect;
    $_SESSION['temp']=$temp;

    $email=$_SESSION['email'];
    $q="INSERT INTO `selfa`.`history` (`qid`,`topic`, `que solved`, `right que`, `wrong que`, `score`, `email`, `date`) VALUES ('$qid','$topic', '$match', '$correct', '$incorrect', '$temp', '$email', current_timestamp())";
    mysqli_query($conn, $q);
    
    $sql4="SELECT * FROM `users` WHERE `email` LIKE '$email'";
    $result4=$conn->query($sql4);
    $row4 = $result4->fetch_assoc();
    $gender=$row4['gender'];
    $name=$row4['name'];
    $clg=$row4['clg'];
    $p="INSERT INTO `selfa`.`ranking` (`name`, `topic`, `gender`, `clg`, `score`) VALUES ('$name', '$topic', '$gender', '$clg', '$temp')";
    mysqli_query($conn, $p);
    header("location:startquiz.php?a=1") ;

?>