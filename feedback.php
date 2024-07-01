<?php 
if(isset($_POST['name']))
{
   // making connections to the database
   include "dbconnection.php";
  //inserting info in feedback table 
   $name=$_POST['name'];
   $subject=$_POST['subject'];
   $email=$_POST['email'];
   $textarea=$_POST['textarea'];
   $sql="INSERT INTO `selfa`.`feedback` (`sr`, `name`, `subject`, `email`, `textarea`, `datetime`) VALUES (NULL, '$name', '$subject', '$email', '$textarea', current_timestamp())";

    if($conn->query($sql)==true){
        echo"<br>";
        header("location:account.php") ;
    }
    else{
        echo "ERROR: $sql <br> $conn->error";
    }
   $conn->close(); 
}     
?>