<?php 
if(isset($_POST['name']))
{
   // making connections to the database
   include "dbconnection.php";
  // variables  
   $name=$_POST['name'];
   $gender=$_POST['gender'];
   $clg=$_POST['clg'];
   $email=$_POST['email'];
   $password=$_POST['password'];
   $cpassword=$_POST['cpassword'];
  // searching where account already exist or not    
   $sql="SELECT * FROM `users` WHERE `email` LIKE '$email' AND `password` LIKE '$password'";
   $result= mysqli_query($conn, $sql);
   $num= mysqli_num_rows($result);

   if ($password==$cpassword) {

       if ($num==0){
           //inserting info in users table 
           $sql="INSERT INTO `selfa`.`users` (`sr`, `name`, `gender`, `clg`, `email`, `password`, `datetime`) VALUES (NULL, '$name', '$gender', '$clg', '$email', '$password', current_timestamp())";

           if($conn->query($sql)==true){
               echo"<br>";
               echo "<h5>successfully inserted</h5>";
            }
            else{
               echo "ERROR: $sql <br> $conn->error";
            }
            $conn->close(); 
       }else{
           echo"<h4>Account Already Exist</h4>";
       } 

   }else{
       echo"<h4>Password Do Not match</h4>";
   }
}     
?>
<?php
  session_start();
  if(isset($_SESSION['loggedin'])){
      session_destroy();
  }
  if(isset($_SESSION['notlogin'])){
    echo "<h4> Incorrect Password or Username</h4>";
    session_destroy();
  }
  if(isset($_SESSION['noaccount'])){
    echo "<h4> Account not found. Please Create your Account</h4>";
    session_destroy();  
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SELFA | HOME</title>
    <link rel="stylesheet" href="javascript and css/main.css">
    <link rel="icon" type="image"  href="images/favicon.ico">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="javascript and css/text.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Josefin Sans' rel='stylesheet'>
    <script>
        $(document).ready(function(){
            $('#icon').click(function(){
                $('ul').toggleClass('show');
            });
        });
    </script>
    <style>
        h4{
            margin:0;
            padding: 10px 10px;
            background-color: lightsalmon;
            font-size: 16px;
        }
        h5{
            margin:0;
            padding: 10px 10px;
            background-color: limegreen;
            font-size: 16px;
        }
    </style>
</head>

<body style="background-image: url(images/bg2.jpg);">
    <!-- navigation bar -->
    <div class="navbar" style="margin: 0;">
            <nav>
                <label class="logo">Let's Get Assessed</label>
                <ul id="Menu">
                    <li><b><button class="loginbtn" onclick="display('admin-login-form')" style= "width:auto">Admin Login</button></li></b>
                    <li><b>
                        <button class="loginbtn" onclick="display('login-form')" style= "width:auto"><i class="glyphicon glyphicon-log-in"></i> Log in</button>
                    </b></li>
                    <li><b><button onclick="display('aboutus')">About Us</button> </li></b>
                </ul>
            </nav>    
    </div>

    <!-- login and register form -->
    <div id="login-form" class="login-page">
        <div class="form-box">
                <button class="cut" onclick="none('login-form')">&times;</button>
                <div class="button-box">
                    <div id="btn"></div>
                    <button type="button" onclick="login()" class="toggle-btn"> Log In</button>
                    <button type="button" onclick="register()" class="toggle-btn">Register</button>      
                </div>
    
                <form id="login" class="input-group-login" action="login.php" method="post">
                    <input type="text" name="email" class="input-field" placeholder="Enter Email ID" required><br>
                    <input type="password" name="password" class="input-field" placeholder="Enter Password" required><br>
                    <button type="submit" class="submit-btn">Log In</button>
                </form>

                <form id="register" class="input-group-register" action="index.php" method="post">
                    <input type="text" class="input-field" name="name" placeholder=" Name" required>
                    <select class="input-field" name="gender">
                        <option selected disabled> Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                    <input type="text" class="input-field" name="clg" placeholder="Collage Name" required>
                    <input type="email" class="input-field" name="email" placeholder="Email ID" required>
                    <input type="password" class="input-field" name="password" placeholder="Enter Password" required>
                    <input type="password" class="input-field" name="cpassword" placeholder="Confirm Password" required>
                    <button type="submit" class="submit-btn">Register</button>
               </form>
        </div>
    </div>

    <!-- admin login form -->
    <div id="admin-login-form" >
        <div class="login2">
            <button class="cut" onclick="document.getElementById('admin-login-form').style.display='none'">&times;</button>
            <label class="title">Admin Login</label>
            <form id="login" class="input-group-login over" action="admin.php" method="post">
                <input type="text" class="input-field" name="email" placeholder="Admin User ID" required><br>
                <input type="password" class="input-field" name="password" placeholder="Enter Password" required><br>
                <a class="formlink" href="https://forms.gle/NHgMp2uhG2nwFr257"> Request for Teachers Registration </a>
                <button type="submit" class="submit-btn">Log In</button>
            </form>
        </div>
    </div>
    <!-- About Us -->
    <div class="form" id="aboutus">
        <form class="box2">
           <div class="signin-header">About Us <button class="btn2" onclick="none('aboutus')" >&times;</button></div> 
           <div class="cont" id="selfa">
               <img class="icon" src="images/favicon.ico" alt="SELFA">
               <div class="info">
                   <ul>
                       <h1 style="font-family:cursive" >Self Assesment Quiz</h1><br>
                       <div class="selfa">
                           Self assesment plays major role in each and every field of life. Education is not one way it should have proper participation from both teachers and students side. To evaluate the understanding of students and to test the preparation of students Short quizzes comes in the picture. Test/Quiz are the like tool or technique for self assesment in education system . Due to Online Mode of Education only assesment done is the final exam so teachers cant realise how far students had understood their subject and students cant test their preparation. 
                           So to solve this problem and help students and teachers for betterment of education system we have our very own website "SELFA" Which can help students to assess themselves. 
                       </div><br>
                   </ul>
               </div>
           </div>
           <h3>Developer Team</h3>
           <div class="cont">
               <img src="images/Male_Dev.jpg" alt="Tejas Hande">
               <div class="info">
                   <ul>
                       <a href="https://www.linkedin.com/in/tejas-hande-84b73021a">Tejas Hande</a><br>
                       <li>9867556536</li><br>
                       <li><a href="mailto:tejas.hande22@vit.edu">tejas.hande22@vit.edu</a></li><br>
                       <li>Vishwakarma Institute of Technology, Pune</li><br>
                   </ul>
               </div>
           </div>
       </form>
   </div>
    <!-- script file for movement of login and register form -->
    <script>
        var x=document.getElementById('login');
        var y=document.getElementById('register');
        var z=document.getElementById('btn')
        function register(){
            x.style.left='-400px';
            y.style.left='50px';
            z.style.left='110px';
        }
        function login(){
            x.style.left='50px';
            y.style.left='450px';
            z.style.left='0px'; 
        }
    </script>

</body>
</html>