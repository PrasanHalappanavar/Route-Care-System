<?php

session_start();
//Database Connection.
 $conn = mysqli_connect("localhost","root","","routecare");

if(isset($_SESSION['did'])){
    $did=$_SESSION['did'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driver Main Page</title>
    <link rel="stylesheet" href="DriverStyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
    <div class="section" id="home">
        <div class="profile">
            <img src="profile.jpg" width="100px" height="100px">
            <h1>Profile</h1>
            <p>Name: Prakash Patil</p>
            <p>Driver ID: <?php echo $did; ?></p>
            <p>Phone: +91 9000990909</p>

            <div class="menus">
            <nav>
                <ul>
                    <li><a href="#home">Home</a></li>
                    <li><a href="../Home.php">Logout</a></li>
                </ul>
            </nav>
        </div>
        
        </div>
    </div>
        <fieldset class="border rounded-3 p-3">
            <legend class="float-none w-auto px-3">Morning Section</legend>
            <form method="POST" enctype="multipart/form-data" name="myForm" autocomplete="off">
            <div class="addroute">
            <select name="mbuses">
                <option value="">Select Bus</option>
                <option value="B1">B1</option>
                <option value="B2">B2</option>
                <option value="B3">B3</option>
                <option value="B4">B4</option>
                <option value="B5">B5</option>
            </select>
            <select name="mfrom">
                <option value="">From</option>
                <option value="College">College</option>
                <option value="Sankeshwar">Sankeshwar</option>
                <option value="Shiraguppi">Shiraguppi</option>
                <option value="Sadalaga">Sadalaga</option>
                <option value="Bedakihal">Bedakihal</option>
            </select>
            <select name="mto">
                <option value="">To</option>
                <option value="College">College</option>
                <option value="Sankeshwar">Sankeshwar</option>
                <option value="Shiraguppi">Shiraguppi</option>
                <option value="Sadalaga">Sadalaga</option>
                <option value="Bedakihal">Bedakihal</option>
            </select>
            <button type="submit" name="morning">Submit</button>
        </div>
        </form>
        </fieldset>
        
        <fieldset class="border rounded-3 p-3">
            <legend class="float-none w-auto px-3">Evening Section</legend>
            <form method="POST" enctype="multipart/form-data" name="myForm" autocomplete="off">
            <div class="addroute">
            <select name="ebuses">
                <option>Select Bus</option>
                <option value="B1" name="B1">B1</option>
                <option value="B2" name="B2">B2</option>
                <option value="B3" name="B3">B3</option>
                <option value="B4" name="B4">B4</option>
                <option value="B5" name="B5">B5</option>
            </select>
            <select name="efrom">
                <option>From</option>
                <option value="College" name="College">College</option>
                <option value="Sankeshwar" name="Sankeshwar">Sankeshwar</option>
                <option value="Shiraguppi" name="Shiraguppi">Shiraguppi</option>
                <option value="Sadalaga" name="Sadalaga">Sadalaga</option>
                <option value="Bedakihal" name="Bedakihal">Bedakihal</option>
            </select>
            <select name="eto">
                <option>To</option>
                <option value="College" name="College">College</option>
                <option value="Sankeshwar" name="Sankeshwar">Sankeshwar</option>
                <option value="Shiraguppi" name="Shiraguppi">Shiraguppi</option>
                <option value="Sadalaga" name="Sadalaga">Sadalaga</option>
                <option value="Bedakihal" name="Bedakihal">Bedakihal</option>
            </select>
            <button type="submit" name="evening">Submit</button>
        </div>
        </fieldset>
</body>
</html>


<?php
}
else{
    header('location:../Home.php');
}
$currentDate = date('Y-m-d');
if(isset($_POST['morning']))
{
    $mbuses=$_POST['mbuses'];
    $mfrom=$_POST['mfrom'];
    $mto=$_POST['mto'];
    
    $sql="insert into morngbus values('$did','$mbuses','$mfrom','$mto','$currentDate')";
    $res=mysqli_query($conn, $sql);
    if($res)
    { 
        echo "<script>
            alert('successfully Send');
        </script>";
    }else{
        echo "<script>
            alert('Opps something went wrong!!!');
        </script>";
    }
       
}

if(isset($_POST['evening']))
{
    $ebuses=$_POST['ebuses'];
    $efrom=$_POST['efrom'];
    $eto=$_POST['eto'];
    
    $sql="insert into evngbus values('$did','$ebuses','$efrom', '$eto','$currentDate')";
    $res=mysqli_query($conn, $sql);
    if($res)
    { 
        echo "<script>
            alert('successfully Send');
        </script>";
    }else{
        echo "<script>
            alert('Opps something went wrong!!!');
        </script>";
    }
       
}

?>