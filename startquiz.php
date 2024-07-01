<?php
if(isset($_GET['qid']))
{
  $qid=$_GET['qid'];
  session_start();
  $_SESSION['qid']=$qid;
  include "dbconnection.php";
  $s="SELECT * FROM `quiz` WHERE `qid` LIKE '$qid'";
  $r=$conn->query($s);
  $w = $r->fetch_assoc();
  $time=$w['time limit'];  
  $conn->close(); 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SELFA | Quiz</title>
    <link rel="icon" type="image"  href="images/favicon.ico">
    <link href='https://fonts.googleapis.com/css?family=Josefin Sans' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
</head>
<style>
*{
    margin: 0;
    border: 0;
    font: 18px 'Josefin Sans';
}
header{
    background-color: rgba(15, 15, 15, 0.781);
    height:65px;
    width: 100%;
    padding-bottom: 20px;
}
.logo{
    display: inline-block;
    margin-top: 20px;
    font-family:'typo';
    font-size:35px;
    color:rgb(243,13,13);
    margin:15px; 
}
.box{
    display: inline-block;
    margin:30px 10% 30px 6%;
    background: transparent;
    float: right;
}
.box2{
    margin:30px 20% 30px 20%;
    background: transparent;
}
.topic{
    font-size: 32px;
    margin: 10px 10px;
    font-weight: bold;
}
.des{
  font-size: 18px;
  color: rgb(156, 153, 153);

}
.title{
    margin-bottom: 5%;
    background-color: white;
    color: darkblue;
    padding: 20px 10px 10px 10px;
    border-radius: 4px;
    text-align: center;
}
.queans{
    width: 820px;
    background-color: white;
    padding: 10px;
    border-radius: 4px;
    margin: 4% 0px;
}
input{
    margin: 10px;
}
.que{
    font-size: 20px;
    margin: 10px 40px 10px 10px;
}
.footer{
    text-align: center;
}
button{
  cursor: pointer;
  border-radius: 4px;
  padding: 5px;
  height: 35px;
  width: 100px;
}
table{
    font: 16px 'Josefin Sans';
    width: 100%;
    border: none;
    text-align: left;
}
tr{
    height: 40px;
    background-color: #f9f9f9;
}
th, td {
    background: transparent;
    padding: 10px;
    border-left:0px;
    border-right:0px;
    border-top: 1px solid rgb(221, 218, 218);
    border-bottom: 1px solid rgb(221, 218, 218);
}
.timer{
    color:white;
    position:fixed;
    display: inline-block;
    background: darkblue;
    font-weight: 100; 
    text-align: center;
    margin-top: 30px;
    padding: 10px;
    margin-left: 30px;
    border-radius:4px;
}
h3{ 
    color: white; 
    font-weight: 100; 
    font-size: 20px; 
} 
#clockdiv{ 
  margin-bottom: 10px;
  font-family: sans-serif; 
  color: #fff; 
  display: inline-block; 
  font-weight: 100; 
  text-align: center; 
  font-size: 30px; 
} 
#clockdiv > div{ 
  padding: 10px; 
  border-radius: 3px; 
  background: #00BF96; 
  display: inline-block; 
} 
#clockdiv div > span{ 
  padding: 15px; 
  border-radius: 3px; 
  background: #00816A; 
  display: inline-block; 
} 
.smalltext{ 
  padding-top: 5px; 
  font-size: 16px; 
} 
</style>
<body style="background-color:gainsboro;">
    <header>
        <span class="logo">Let's Get Assessed</span>
    </header>
    <?php
    if(isset($_GET['qid']))
    {
?>
<script>
    // Set the date we're counting down to
    var countDownDate = new Date();
    countDownDate.setMinutes(countDownDate.getMinutes() +  <?php echo $time ?> );
    
    // Update the count down every 1 second
    var x = setInterval(function() {

    // Get today's date and time
      var now = new Date().getTime();

      // Find the distance between now and the count down date
      var distance = countDownDate - now;
    
      // Time calculations for days, hours, minutes and seconds
      var days = Math.floor(distance / (1000 * 60 * 60 * 24));
      var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
      // Display the result in the element 
      document.getElementById("hour").innerHTML =hours; 
      document.getElementById("minute").innerHTML = minutes;  
      document.getElementById("second").innerHTML =seconds;
      
      // If the count down is finished, write some text
      if (distance < 1) {
        clearInterval(x);
        document.getElementById("demo").innerHTML = "TIME UP"; 
        document.getElementById("hour").innerHTML ='0'; 
        document.getElementById("minute").innerHTML ='0' ;  
        document.getElementById("second").innerHTML = '0';
        $(document).ready(function(){
          document.getElementById("model").click();
        });
      }
    }, 1000);
</script>

<script>
    // resize  window Ditector
    var i=0;
    var f = function(){
       var eventHandler = function(event){
        function notify() {
           i++;
           var a= 4-i;
           alert("Alert!!! \n Changing window/tab is Not Allowed \n If you do this "+ a +" more times, Exam will Close Automatically");
        }
        if(i<4){
            notify();
        }
        if(i==4){
        document.getElementById("model").click();
       }
    };
    window.addEventListener('resize',eventHandler,false);                                                                                                                                 
    };
    document.addEventListener('DOMContentLoaded',f,false);

    // window Visibility Detector
    document.addEventListener('visibilitychange',function(){
    if(document.visibilityState !== "visible"){
        if(i<4){
            notify();
        }
    }
    function notify(){
        i++;
        var a= 4-i;
        alert("Alert!!! \n Changing window/tab is Not Allowed \n If you do this "+ a +" more times, Exam will Close Automatically");
    }

    if(i==4){
        document.getElementById("model").click();
    }
    });
    
</script>
<div class="timer" id="timer">
 <h3>Timer</h3> 

 <div id="clockdiv"> 

  <div> 
    <span class="hours" id="hour"></span> 
    <div class="smalltext">Hours</div> 
  </div>

  <div> 
    <span class="minutes" id="minute"></span> 
    <div class="smalltext">Minutes</div> 
  </div>

  <div> 
    <span class="seconds" id="second"></span>
    <div class="smalltext">Seconds</div> 
  </div> 

 </div> 
 <p id="demo"></p>
</div>
<div class="box" id="box">
    <?php
               include "dbconnection.php";
               $sql="SELECT * FROM `quiz` WHERE `qid` LIKE '$qid'";
               $result=$conn->query($sql);
               if ($result->num_rows > 0) {
                // output data of each row
                   while($row = $result->fetch_assoc()) {
                    $total=$row['total que'];   
    ?>
        <div class="title">
            <span class="topic"><?php echo $row['topic']; ?></span><br><br>
            <p class="des"><?php echo $row['Des']; ?></p>
        </div>
    <?php
       } }
    ?>
    <?php $conn->close(); ?>    
    <form action="check.php" method="post">
    <?php
               include "dbconnection.php";
               for($i=1;$i<=$total;$i++){
               $sql="SELECT * FROM `questions` WHERE `eid` LIKE '$i' AND `qid` LIKE '$qid'";
               $result=$conn->query($sql);
               $c=0;
               if ($result->num_rows > 0) {
                // output data of each row
                   while($row = $result->fetch_assoc()) { 
    ?>
        <div class="queans">
            <p style="float: right; color: rgb(156, 153, 153);"><?php echo $row['marks']; ?></p>
            <p class="que"><?php echo $row['eid']; ?>. <?php echo $row['question']; ?></p><br>
            <?php
            $sql2="SELECT * FROM `options` WHERE `eid` LIKE '$i' AND `qid` LIKE '$qid'";
               $result2=$conn->query($sql2);
               if ($result2->num_rows > 0) {
                // output data of each row
                   while($row = $result2->fetch_assoc()) { 
            ?> 
            <input type="radio" id="optionA" name="check[<?php echo $row['eid']; ?>]" value="Option A">
            <label for="optionA"><?php echo $row['option a']; ?></label><br>
            <input type="radio" id="optionB" name="check[<?php echo $row['eid']; ?>]" value="Option B">
            <label for="optionB"><?php echo $row['option b']; ?></label><br>
            <input type="radio" id="optionC" name="check[<?php echo $row['eid']; ?>]" value="Option C">
            <label for="optionC"><?php echo $row['option c']; ?></label><br>
            <input type="radio" id="optionD" name="check[<?php echo $row['eid']; ?>]" value="Option D">
            <label for="optionD"><?php echo $row['option d']; ?></label><br>
        <?php
        } } 
        ?>
        </div>
    <?php
       } } }
    ?>
    <?php $conn->close(); ?> 
        <div class="footer">
          <button id="model" type="submit" style="background-image: linear-gradient(to bottom,rgba(92, 107, 189, 0.637) 0,#293a85b9 100%); color: white;">End Test</button>
        </div>
    </form>
</div> 

    <?php 
    } 
   ?>
   <!-- result -->
   <?php
   if(isset($_GET['a']))
   {
       session_start();
       $total=$_SESSION['total'];
       $match=$_SESSION['match'];
       $incorrect=$_SESSION['incorrect'];
       $correct=$_SESSION['correct'];
       $temp=$_SESSION['temp'];
    ?>
<div class="box2">
       <div class="title">
          <span class="topic">Result</span><br><br>
          <table>
           <tr>
               <td>Total Question</td>
               <td><?php echo $total; ?></td>
           </tr>
           <tr>
               <td>Solved Question</td>
               <td><?php echo $match; ?></td>
           </tr>
           <tr>
               <td>Correct Answers</td>
               <td><?php echo $correct; ?></td>
           </tr>
           <tr>
               <td>Incorrect Answers</td>
               <td><?php echo $incorrect; ?></td>
           </tr>
           <tr>
               <td>Score</td>
               <td><?php echo $temp; ?></td>
           </tr>

          </table>
          <a href="account.php"><button style="background-image: linear-gradient(to bottom,rgba(92, 107, 189, 0.637) 0,#293a85b9 100%); color: white; margin-top:20px;">Close</button></a>
       </div>
</div>
   <?php 
    } 
   ?>
</body>
</html>

