<?php 
if(isset($_POST['email']))
{
    $_SESSION['notlogin']=false;
   // making connections to the database
   include "dbconnection.php";
  //serching info in users table 
   $email=$_POST['email'];
   $password=$_POST['password'];
   $sql="SELECT * FROM `users` WHERE `email` LIKE '$email'";
   $result= mysqli_query($conn, $sql);
   $num= mysqli_num_rows($result);
   
    if($num == 1){
        $sql2="SELECT * FROM `users` WHERE `password` LIKE '$password'";
        $result2= mysqli_query($conn, $sql2);
        $num2= mysqli_num_rows($result2);
        if ($num2 == 1){
            session_start();
            $_SESSION['email']=$email;
            $_SESSION['password']=$password;
            $_SESSION['loggedin']=true;
            header("location:account.php") ;
        }else{
            session_start();
            $_SESSION['notlogin']=true;
            header("location:index.php");
        }
    }else{
            session_start();
            $_SESSION['noaccount']=true;
            header("location:index.php");
    }
   $conn->close(); 
}     
?>