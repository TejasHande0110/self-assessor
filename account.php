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
    $sql="SELECT `name` FROM `users` WHERE `email` LIKE '$email' AND `password` LIKE '$password'";
    $result=$conn->query($sql);
    $name = $result->fetch_assoc()
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SELFA | User Dashboard</title>
    <link rel="stylesheet" href="javascript and css/account.css">
    <link rel="icon" type="image"  href="images/favicon.ico">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="javascript and css/text.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Josefin Sans' rel='stylesheet'>
</head>
<body style="background-image: url(images/bg2.jpg); background-repeat: no-repeat; background-attachment:fixed; background-size:cover;">
    <header>
        <span class="logo">Let's Get Assessed</span>
        <div class="nav">
            <span class="hello"><i class="glyphicon glyphicon-user" style="padding: 10px;"></i>Hello, <?php echo $name['name']; ?></span>
            <a href="index.php" style="color: orange; text-decoration: none;" class="sign"><i class="glyphicon glyphicon-log-out" style="padding: 10px;"></i>Signout</a>
        </div>
    </header>

    <form class="dashboard" method="post">
        <ul>
            <label style="font-weight: 700;" class="title">User Dashboard</label>
            <li><button type="submit"defaultfocus class="btn2" name="button1" value="button1"><i class="glyphicon glyphicon-home"></i> Home</button></li>
            <li><button type="submit" class="btn2" name="button2" value="button2"><i class="glyphicon glyphicon-list-alt" data-toggle=""></i> History</button></li>
            <li><button type="submit" class="btn2" name="button3" value="button3"><i class="glyphicon glyphicon-stats"></i> Ranking</button></li>
            <li><button class="btn2" name="button4" value="button4"><i class="glyphicon glyphicon-envelope"></i> Feedback</button></li>
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
                       $qid=$row['qid'];
                       $sql2="SELECT * FROM history WHERE `email` LIKE '$email' AND `qid` LIKE '$qid'";
                       $result2=$conn->query($sql2);
                ?>
                   <tr>
                      <td><?php echo $c; ?></td>
                      <td><?php echo $row['topic']; ?></td>
                      <td><?php echo $row['total que']; ?></td>
                      <td><?php echo $row['marks']; ?></td>
                      <td><?php echo $row['time limit']; ?></td>
                      <?php 
                      if ($result2->num_rows == 0){
                        ?>
                      <td><a title="Start Quiz" href="startquiz.php?qid=<?php echo $row['qid']?>"><i class="glyphicon glyphicon-new-window" style="color:#337ab7;"></i> Start</a></td>
                     <?php 
                     }else{
                     ?>
                      <td style="color:green;"><i class="glyphicon glyphicon-ok" style="color:green;"></i> Completed</td>
                      <?php } ?>
                    </tr>	
                <?php
                } }
                ?>
                <?php $conn->close(); ?>
           </table>
       </div>
       <?php } ?>
      <!-- history -->
        <?php if($q==2){?>
        <div class="formbox" id="history">
            <span class='head'>History</span>
            <table>
                <tr>
                    <th>S.N.</th>
                    <th>Quiz</th>
                    <th>Questions Solved</th>
                    <th>Right</th>
                    <th>Wrong</th>
                    <th>Score</th>
                </tr>
                <?php
               include "dbconnection.php";
               $sql="SELECT * FROM history WHERE `email` LIKE '$email' ORDER BY `date` ASC";
               $result=$conn->query($sql);
               $c=0;
               if ($result->num_rows > 0) {
                // output data of each row
                   while($row = $result->fetch_assoc()) {
                   $c++;    
                ?>
                   <tr>
                      <td><?php echo $c; ?></td>
                      <td><?php echo $row['topic']; ?></td>
                      <td><?php echo $row['que solved']; ?></td>
                      <td><?php echo $row['right que']; ?></td>
                      <td><?php echo $row['wrong que']; ?></td>
                      <td><?php echo $row['score'];?></td>
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
        <!-- feedback form -->
        <?php if($q==4){?>
       <div class="form2" id="feedback">
        <form class="box" action="feedback.php" method="post" style="background: url(images/bg3.png); background-repeat: no-repeat; background-size:730px 540px; background-attachment: scroll;">
            <button class="close" onclick="none('feedback')" style="font-size: 35px;">&times;</button>
            <h1 style="font-family: 'toyo'; color: #000066; margin: 20px 10px 0px 10px;">FEEDBACK / REPORT A PROBLEM</h1>
            <span>You can send your feedback through E-Mail using Following E-Mail id:</span><br>
            <a href="mailto:teamselfaa@gmail.com">teamselfaa@gmail.com</a><br>
            <span style="margin-bottom: 10px;">or you can directly submit your feedback using this form.</span>
            <div class="signin-body" style="border-bottom: none;">
                <label for="name">Name  :</label>
                <input type="text" id="name" name="name" class="input-box" placeholder="Enter Your Name" required><br>
                <label for="subject">Subject:</label>
                <input type="text" id="subject" name="subject" class="input-box" placeholder="Enter Your Subject" required><br>
                <label for="email">E-mail :</label>
                <input type="email" id="email" name="email" class="input-box" placeholder="Enter Your Email" required><br>
                <textarea name="textarea" id="textarea" class="text" cols="75" rows="8" placeholder="Write Your Feedback" required></textarea>
                <div class="signin-footer">
                    <button type="button"class="btn" onclick="none('feedback')">Close</button>
                    <button type="submit" class="btn" style="background-image: linear-gradient(to bottom,rgba(92, 107, 189, 0.637) 0,#293a85b9 100%); color: white;">Submit</button>
                 </div>
            </div>
        </form>
       </div>
       <?php } ?>
    </div> 
</body>
</html>