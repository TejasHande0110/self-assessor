<?php
    session_start();
    if(empty($_SESSION['questions']) || $_SESSION['qid']!=true){
        session_destroy();
        header("loacation: adminpage.php");
    }
    $questions= $_SESSION['questions'];
    $qid= $_SESSION['qid'];
?> 
<?php
if(isset($_POST['que'])){
    // making connections to the database
    include "dbconnection.php";
    // variables
    $que=$_POST['que'];
    $optionA=$_POST['optionA'];
    $optionB=$_POST['optionB'];
    $optionC=$_POST['optionC'];
    $optionD=$_POST['optionD'];
    $ans=$_POST['ans'];
    $marks=$_POST['marks'];
    $qid= $_SESSION['qid'];
    $eid=$_POST['queno'];;
    //inserting info in question table 
    $sql="INSERT INTO `selfa`.`questions` (`qid`, `eid`, `question`, `marks`) VALUES ('$qid', '$eid', '$que', '$marks')";
    $sql2="INSERT INTO `selfa`.`answers` (`qid`,`eid`, `answer`) VALUES ('$qid','$eid', '$ans')";
    $sql3="INSERT INTO `selfa`.`options` (`qid`,`eid`, `option a`, `option b`, `option c`, `option d`) VALUES ('$qid','$eid', '$optionA', '$optionB', '$optionC', '$optionD')";
    $conn->query($sql);
    $conn->query($sql2);
    $conn->query($sql3);
    $conn->close();
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SELFA | Add Quiz</title>
    <link rel="icon" type="image"  href="images/favicon.ico">
    <link href='https://fonts.googleapis.com/css?family=Josefin Sans' rel='stylesheet'>
</head>
<style>
    body{
        background: rgb(238, 238, 238);
        font: 16px 'Josefin Sans';
    }
    h1{
        text-align: center;
    }
    .box{
        margin: 40px 30%;
        text-align: center;
    }
    span{
        font-size: 20px;
    }
    .area{
        margin: 20px 10px 0px 20px;
    }
    textarea, .inputbox{
        font: 18px 'Josefin Sans'; 
        margin: 10px 10px ;
        line-height: 1.42857143;
        border-radius: 5px;
        width: 100%;
    }
    button{
        margin-top:10px;
        padding: 5px;
        font-size: 16px;
        margin-left:10px;
        border-radius: 4px;
        cursor: pointer;
    }
    .footer{
        text-align:center;
    }
    a{
        text-decoration:none;
    }
    .note{
        font-size:14px;
    }
    .queno{
        padding: 2px;
        padding-left:15px;
        font: 20px 'Josefin Sans';
        width:100px;
    }
    label{
        font: 18px 'Josefin Sans';
    }
</style>
<body>
    <h1>Enter Questions Detail (One By One)</h1>
    <div class="box">
        <div class="area">
        <form action="addque.php" id="quedetail" method="post"> 
            <label for="queno">Question No. :</label>
            <input type="number" id="queno" class="queno" name="queno" required> 
            <textarea name="que" placeholder="Write Question here.." id="" cols="30" rows="3" class="inputbox" required></textarea>
            <input type="text" name="optionA" placeholder="Enter Option A" class="inputbox" required>
            <input type="text" name="optionB" placeholder="Enter Option B" class="inputbox" required>
            <input type="text" name="optionC" placeholder="Enter Option C" class="inputbox" required>
            <input type="text" name="optionD" placeholder="Enter Option D" class="inputbox" required>
            <span>Correct Answer:</span><br>
             <select name="ans" id="" class="inputbox" required style="height: 31px;">
               <option selected disabled>Select Answer For Question</option>
               <option value="Option A">Option A</option>
               <option value="Option B">Option B</option>
               <option value="Option C">Option C</option>
               <option value="Option D">Option D</option>
           </select>
            <input type="number" name="marks" class="inputbox" placeholder="Enter Marks of Question" required>
        </div>
        <div class="footer">
            <span class="note">***Note: If You Want to Stop Then Click Close Button***</span><br>
            <button class="btn"><a href="adminpage.php">Close</a></button>
            <button type="submit" class="btn" style="background-image: linear-gradient(to bottom,rgba(92, 107, 189, 0.637) 0,#293a85b9 100%); color: white;">Save & Next</button>
        </div>
        </form>
    </div>
</body>
</html>

