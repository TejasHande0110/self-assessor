<?php
$q=1;

if(array_key_exists('button1' , $_POST)){
    $q=1;
}
else if(array_key_exists('button2' , $_POST)){
    $q=2;
}
else if(array_key_exists('button3' , $_POST)){
    $q=3;
}
else if(array_key_exists('button4' , $_POST)){
    $q=4;
}
else if(array_key_exists('button5' , $_POST)){
    $q=5;
}
?>
<?php
    include "dbconnection.php";
    session_start();
    if(empty($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
        session_destroy();
        exit("Invalid Acess.Please Login");
        header("loacation: index.php");
    }
    $email=$_SESSION['email'];
    $password=$_SESSION['password'];
    $sql="SELECT `name` FROM `admin` WHERE `email` LIKE '$email' AND `password` LIKE '$password'";
    $result=$conn->query($sql);
    $name = $result->fetch_assoc()
    
?>
<?php 
if(isset($_POST['topic']))
{
   // making connections to the database
   include "dbconnection.php";
  // variables  
   $topic=$_POST['topic'];
   $totalque=$_POST['totalque'];
   $time=$_POST['time'];
   $marks=$_POST['marks'];
   $des=$_POST['des'];
   $qid=uniqid();
   //inserting info in quiz table 
   $sql="INSERT INTO `selfa`.`quiz` (`qid`, `topic`, `total que`, `marks`, `time limit`, `Des`) VALUES ('$qid', '$topic', '$totalque', '$marks', '$time', '$des')";
   if($conn->query($sql)==true){
       session_start();
       $_SESSION['questions']=$totalque;
       $_SESSION['qid']=$qid;
       header("location:addque.php") ;
    }else{
    echo "ERROR: $sql <br> $conn->error";
    }
 $conn->close(); 
}
?>       
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SELFA | Admin Dashboard</title>
    <link rel="stylesheet" href="javascript and css/account.css">
    <link rel="icon" type="image"  href="images/favicon.ico">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href='https://fonts.googleapis.com/css?family=Josefin Sans' rel='stylesheet'>
    <script src="text.js"></script>
</head>
<body style="background-image: url(images/bg2.jpg); background-repeat: no-repeat; background-attachment:fixed; background-size:cover;">
    <header>
        <span class="logo">Let's Get Assessed</span>
        <div class="nav">
            <span class="hello"><i class="glyphicon glyphicon-user" style="padding: 10px;"></i>Hello, <?php echo $name['name']; ?></span>
            <a href="index.php" style="color: orange; text-decoration: none;"><i class="glyphicon glyphicon-log-out" style="padding: 10px;"></i>Signout</a>
        </div>
    </header>
    <form class="dashboard" method="post">
        <ul>
            <li style="font-weight: 700;" class="title">Admin Dashboard</li>
            <li><button type="submit"defaultfocus class="btn2" name="button1" value="button1"><i class="glyphicon glyphicon-home"></i> Home</button></li>
            <li><button type="submit" class="btn2" name="button2" value="button2"><i class="glyphicon glyphicon-list-alt" data-toggle=""></i> Users</button></li>
            <li><button type="submit" class="btn2" name="button3" value="button3"><i class="glyphicon glyphicon-stats"></i> Ranking</button></li>
            <li><button type="submit" class="btn2" name="button4" value="button4"><i class="glyphicon glyphicon-envelope"></i> User Feedbacks</button></li>
            <li><button type="submit" class="btn2" name="button5" value="button5"><i class="glyphicon glyphicon-save"></i> Add quiz</button></li>
        </ul>
    </form>
    <!-- home -->
    <div class="form">
       <?php if($q==1){?>
       <div class="formbox" id="test">
           <span class='head'>Quizzes</span>
           <table>
               <tr>
                   <th>S.N.</th>
                   <th>Topic</th>
                   <th>Total Questions</th>
                   <th>Marks</th>
                   <th>Time Limit</th>
                   <th></th>
               </tr>
               <?php
               include "dbconnection.php";
               $sql="SELECT * FROM quiz";
               $result=$conn->query($sql);
               $c=0;
               if ($result->num_rows > 0) {
                // output data of each row
                   while($row = $result->fetch_assoc()) {
                    $c++;
                ?>
                   <tr>
                      <td><?php echo $c?></td>
                      <td><?php echo $row['topic']; ?></td>
                      <td><?php echo $row['total que']; ?></td>
                      <td><?php echo $row['marks']; ?></td>
                      <td><?php echo $row['time limit']; ?> Min</td>
                      <!-- <a><i class="glyphicon glyphicon-new-window" style="color:#337ab7;"></i> Start</a> -->
                      <td><a title="Remove Quiz" href="delete.php?qid=<?php echo $row['qid']?>"><i class="glyphicon glyphicon-trash"></i></a></td>
                  </tr>	
                <?php
                } }
                ?>
                <?php $conn->close(); ?>
           </table>
       </div>
       <?php } ?>
      <!-- users -->
        <?php if($q==2){?>
        <div class="formbox" id="history">
            <span class='head'>Users</span>
            <table>
                <tr>
                    <th>S.N.</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Collage</th>
                    <th>email</th>
                    <th></th>
                </tr>
                <?php
               include "dbconnection.php";
               $sql="SELECT * FROM users";
               $result=$conn->query($sql);
               $c=0;
               if ($result->num_rows > 0) {
                // output data of each row
                   while($row = $result->fetch_assoc()) {
                   $c++;    
                ?>
                   <tr>
                      <td><?php echo $c; ?></td>
                      <td><?php echo $row['name']; ?></td>
                      <td><?php echo $row['gender']; ?></td>
                      <td><?php echo $row['clg']; ?></td>
                      <td><?php echo $row['email']; ?></td>
                      <td><a title="Delete User" href="delete.php?email=<?php echo $row['email']?>"><i class="glyphicon glyphicon-trash"></i></a></td>
                  </tr>	
                <?php
                } }
                ?>
                <?php $conn->close(); ?>
            </table>
        </div>
        <?php } ?>
      <!-- ranking -->
      <?php if($q==3){?>
        <div class="formbox" id="ranking">
            <span class='head'>Rank</span>
            <table>
                <tr>
                    <th>Rank</th>
                    <th>Name</th>
                    <th>Quiz Name</th>
                    <th>Gender</th>
                    <th>Collage</th>
                    <th>Score</th>
                </tr>
                <?php
               include "dbconnection.php";
               $sql="SELECT * FROM ranking ORDER BY `score` DESC";
               $result=$conn->query($sql);
               $c=0;
               if ($result->num_rows > 0) {
                // output data of each row
                   while($row = $result->fetch_assoc()) {
                       $c++;
                ?>
                   <tr>
                      <td><?php echo $c; ?></td>
                      <td><?php echo $row['name']; ?></td>
                      <td><?php echo $row['topic']; ?></td>
                      <td><?php echo $row['gender']; ?></td>
                      <td><?php echo $row['clg']; ?></td>
                      <td><?php echo $row['score']; ?></td>
                  </tr>	
                <?php
                } }
                ?>
                <?php $conn->close(); ?> 
            </table>
        </div>
        <?php } ?>
        <!-- Feedback -->
        <?php if($q==4){?>
        <div class="formbox" id="feedback">
            <span class='head'>User Feedbacks</span>
            <table>
                <tr>
                    <th>S.N.</th>
                    <th>Subject</th>
                    <th>Email</th>
                    <th>By</th>
                    <th>Date and Time</th>
                    <th>Feedback</th>
                    <th></th>
                </tr>
                <?php
               include "dbconnection.php";
               $sql="SELECT * FROM feedback";
               $result=$conn->query($sql);
               $c=0;
               if ($result->num_rows > 0) {
                // output data of each row
                   while($row = $result->fetch_assoc()) {
                   $c++;    
                ?>
                   <tr>
                      <td><?php echo $c; ?></td>
                      <td><?php echo $row['subject']; ?></td>
                      <td><?php echo $row['email']; ?></td>
                      <td><?php echo $row['name']; ?></td>
                      <td><?php echo $row['datetime']; ?></td>
                      <td><?php echo $row['textarea']; ?></td>
                      <td><a title="Delete Feedbak" href="delete.php?datetime=<?php echo $row['datetime']?>"><i class="glyphicon glyphicon-trash"></i></a></td>
                    </tr>
                <?php
                } }
                ?>
                <?php $conn->close(); ?>
            </table>
        </div>
        <?php } ?>
        <!-- Add quiz -->
        <?php if($q==5){?>
        <div class="formbox2" id="addquiz">
            <span class='head'>Add Quiz</span><hr>
            <form action="adminpage.php" method="post">
            <div class="signin-body" style="border-bottom: none;">
                <input type="text" name="topic" class="input-box" placeholder="Enter Quiz Title" style="width: 80%;" required> 
                <input type="number" name="totalque" class="input-box" placeholder="Enter Total Number of Question" style="width: 80%;" required> 
                <input type="number" name="time" class="input-box" placeholder="Enter Time Limit of Quiz In min" style="width: 80%;" required> 
                <input type="number" name="marks" class="input-box" placeholder="Enter Total Marks" style="width: 80%;" required> 
                <textarea type="text" name="des" placeholder="write Description here..." class="text" cols="60" rows="5"></textarea>
                <div class="signin-footer">
                    <button type="submit" class="btn" style="background-image: linear-gradient(to bottom,rgba(92, 107, 189, 0.637) 0,#293a85b9 100%); color: white;">Next</button>
                </div>
            </div>
            </form>
        </div>
        <?php } ?>
     </div>
</body>
</html>