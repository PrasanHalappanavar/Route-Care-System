<?php
 session_start();
 $conn = mysqli_connect("localhost","root","","routecare");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Bus Coordination Management System</title>
    <link rel="stylesheet" href="RCS_Style.css">
    <script type="text/javascript" src="RCS_JS.js"></script>
    <script>window.history.forward();
</script>
</head>
<body>
    <header>
        <img src="RCSLogo1.jpeg" height="85px" width="85px">
        <h1>KLECET Route Bus Management System</h1>
    </header>
    
    <nav>
        <ul>
            <li><a href="#home">Home</a></li>
            <li><a href="#contact">Contact-us</a></li>
            
            <div class="dropdown">
            <a class="mydrop">Login</a>
            <div class="dropdown-content">
                <a onclick="ShowLogin(), RemoveLogin2(), RemoveLogin3()" href="#">Coordinator</a>
                <a onclick="ShowLogin2(), RemoveLogin(), RemoveLogin3()" href="#">Driver</a>
                <a onclick="ShowLogin3(), RemoveLogin(), RemoveLogin2()" href="#">Student</a>
            </div>
        </div>
        </ul>
    </nav>


    <div class="login-container">
       <a style="cursor: pointer;" onclick="RemoveLogin()"><span style="float: right; " >X</span></a> <h2>Coordinator Login</h2>
        <form method="POST" enctype="multipart/form-data" name="myForm" autocomplete="off">
            <input type="text" placeholder="Enter your ID" name="cid" required>
            <input type="password" placeholder="Password" name="cpassd" required>
            <button type="submit" name="clogin">Login</button><br><br>
        </form>
    </div>

    <div class="login-container2">
       <a style="cursor: pointer;" onclick="RemoveLogin2()"><span style="float: right; " >X</span></a> <h2>Driver Login</h2>
        <form method="POST" enctype="multipart/form-data" name="myForm2" autocomplete="off">
            <input type="text" placeholder="Enter your ID" name="did" required>
            <input type="password" placeholder="Password" name="dpassd" required>
            <button type="submit" name="dlogin">Login</button><br><br>
        </form>
    </div>

    <div class="login-container3">
       <a style="cursor: pointer;" onclick="RemoveLogin3()"><span style="float: right; " >X</span></a> <h2>Student Login</h2>
        <form method="POST" enctype="multipart/form-data" name="myForm3" autocomplete="off">
            <input type="text" placeholder="Enter Your USN" name="usn" required>
            <input type="password" placeholder="Password" name="spassd" required>
            <button type="submit" name="slogin">Login</button><br><br>
             <a onclick="ShowSignup(), RemoveLogin3()"  href="#" style="float: right;">Sign Up</a>
        </form>
    </div>

    <div class="mysignup">
        <a style="cursor: pointer;" onclick="RemoveSignup()"><span style="float: right; " >X</span></a> <h2>Student Login</h2>
        <form method="POST" class="signup-form">
            <label for="full-name">Full Name</label>
            <input type="text" name="name" required>

            <label for="usn">USN</label>
            <input type="text" name="usn" required>

            <label for="branch">Branch</label>
            <input type="text" name="branch" required>

            <label for="password">Password</label>
            <input type="password" name="passwd" required>

            <input type="submit" class="submit-btn" name="register">Sign Up</button>
        </form>
    </div>
 




   <h1 style="color: lightgray; font-size: 40px; background-color: black; opacity: .8; height: 65px; padding-top: 20px;margin-top: -0px;"> <marquee behavior="alternate">Wellcome to KLECET RouteCare Software</marquee></h1>
    
    <footer>
        <p>&copy; 2024 KLECET Route Bus Management System</p>
    </footer>
</body>
</html>

<?php

    if(isset($_POST['clogin']))
    {
        $cid=$_POST['cid'];
        $cpassd=$_POST['cpassd'];
        
        $sql="select *from coordinator where cid='$cid' and passwd='$cpassd'";
        $result=mysqli_query($conn, $sql);
        $rows=mysqli_num_rows($result);
        
        if($rows==1)
        {
            $_SESSION['cid']=$cid;
            header('location:AdminRCS/AdminHome.php');
            exit;
        }
        else{
            echo "<script>
                    alert('Invalid ID OR Password')
                    </script>";
        }
    }
    

    if(isset($_POST['dlogin']))
    {
        $did=$_POST['did'];
        $dpassd=$_POST['dpassd'];
        
        $sql="select *from driver where did='$did' and passwd='$dpassd'";
        $result=mysqli_query($conn, $sql);
        $rows=mysqli_num_rows($result);
        
        if($rows==1)
        {
            $_SESSION['did']=$did;
            header('location:DriverRCS/DriverHome.php');
            exit;
        }
        else{
            echo "<script>
                    alert('Invalid ID OR Password')
                    </script>";
        }
    }


    if(isset($_POST['slogin']))
    {
        $usn=$_POST['usn'];
        $spassd=$_POST['spassd'];
        
        $sql="select *from stds where usn='$usn' and passwd='$spassd'";
        $result=mysqli_query($conn, $sql);
        $rows=mysqli_num_rows($result);
        
        if($rows==1)
        {
            $_SESSION['usn']=$usn;
            header('location:StudentsRCS/StdHome.php');
            exit;
        }
        else{
            echo "<script>
                    alert('Invalid ID OR Password')
                    </script>";
        }
    }


  if(isset($_POST['register']))
  {
      $name = $_POST['name'];
      $usn = $_POST['usn'];
      $brch = $_POST['branch'];
      $password = $_POST['passwd'];
      
      $sql="insert into stds values('$name','$usn','$brch','$password')";
      $result=mysqli_query($conn, $sql);
     
    if($result)
    {
        echo "<script>
                alert('ThankYou','Your openion will be received.','success');
                </script>";
        
    }
    else
    {
        echo "<script>
                alert('Sorry!!!','Something went wrong','wrong');
                </script>";
    }
      
  }
 

?>
