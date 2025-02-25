<?php

session_start();
//Database Connection.
 $conn = mysqli_connect("localhost","root","","routecare");

if(isset($_SESSION['cid'])){
    $cid=$_SESSION['cid'];
}
else{
    header('location:../Home.php');
}

$ssql="select count(*) as stds from stds";
$res1 = mysqli_query($conn,$ssql);
$std=mysqli_fetch_array($res1); 

$ssql1="select count(*) as drvr from driver";
$res2 = mysqli_query($conn,$ssql1);
$drvr=mysqli_fetch_array($res2); 

$ssql2="select count(*) as rprt from reports";
$res3 = mysqli_query($conn,$ssql2);
$rprt=mysqli_fetch_array($res3); 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Coordinator Dashboard</title>
    <link rel="stylesheet" href="AdminStyle.css">
    <script src="AdminJS.js"></script>
</head>
<body>
    <div class="sidebar">
        <h2>Coordinator</h2><br><hr><br>
        <ul>
            <li><a href="#" onclick="showSection('overview')">Overview</a></li>
            <li><a href="#" onclick="showSection('routes')">Bus Routes</a></li>
            <li><a href="#" onclick="showSection('drivers')">Drivers</a></li>
            <li><a href="#" onclick="showSection('notification')">Notifications</a></li>
            <li><a href="#" onclick="showSection('reports')">Reports</a></li>
            <li><a href="../Home.php">Logout</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div id="overview" class="content-section">
            <h2>Overview</h2>
            <p>Welcome to the Bus Coordinator Dashboard.</p>

            <div class="dashboard-cards">
                <div class="card">
                    <h3>Total Students</h3>
                    <p><?php echo $std['stds']; ?></p>
                </div>
                <div class="card">
                    <h3>Total Drivers</h3>
                    <p><?php echo $drvr['drvr']; ?></p>
                </div>
                <div class="card">
                    <h3>Total Reports</h3>
                    <p><?php echo $rprt['rprt']; ?></p>
                </div>
            </div>

        </div>
        <div id="routes" class="content-section">
            <h2>Bus Routes</h2>
            <p>Morning Schedules</p>
            <p style=" position: absolute; left: 950px; top: 75px;">Evening Schedules</p>
            <div class="bus-routes">
                <table style="width: 47%;">
                    <thead>
                        <tr>
                            <th>Driver ID</th>
                            <th>Bus ID</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
    
                            $sql="select * from morngbus";
                            $res = mysqli_query($conn,$sql);
                            $rows= mysqli_num_rows($res);
                            if($rows<1)
                            {
                                echo "<script>
                                        alert('Something went wrong !');
                                        </script>";

                            }
                            else
                            {
                                while($row=mysqli_fetch_array($res))
                                {                        
                        
                        ?>


                        <tr>
                        <form method="post">
                            <td><?php echo $row['did'] ;?></td>
                            <td><?php echo $row['bus'] ;?></td>
                            <td><?php echo $row['mfrom'];?></td>
                            <td><?php echo $row['mto'] ;?></td>
                            <td><?php echo $row['mdate'] ;?></td>
                        </form>
                        </tr>
                        <?php
                            }
                        } ?>
                    </tbody>
                </table>

                <table style="width: 47%;">
                    <thead>
                        <tr>
                            <th>Driver Name</th>
                            <th>Bus Number</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql="select * from evngbus";
                            $res = mysqli_query($conn,$sql);
                            $rows= mysqli_num_rows($res);
                            if($rows<1)
                            {
                                echo "<script>
                                        alert('Something went wrong !');
                                        </script>";

                            }
                            else
                            {
                                while($row=mysqli_fetch_array($res))
                                {
                        
                        
                        ?>


                        <tr>
                        <form method="post">
                            <td><?php echo $row['did'] ;?></td>
                            <td><?php echo $row['bus'] ;?></td>
                            <td><?php echo $row['efrom'];?></td>
                            <td><?php echo $row['eto'] ;?></td>
                            <td><?php echo $row['edate'] ;?></td>
                        </form>
                        </tr>
                        <?php
                            }
                        } ?>
                    </tbody>
                </table>
            </div>

        </div>

        <div id="drivers" class="content-section">
            <h2>Drivers</h2>
            <p>Manage driver information here.</p>

            <div class="drivers-list">
                <table>
                    <thead>
                        <tr>
                            <th>Driver ID</th>
                            <th>Driver Name</th>
                            <th>Contact Number</th>
                            <th>Route</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
    
                            $sql="select * from driver";
                            $res = mysqli_query($conn,$sql);
                            $rows= mysqli_num_rows($res);
                            if($rows<1)
                            {
                                echo "<script>
                                        alert('Something went wrong !');
                                        </script>";

                            }
                            else
                            {
                                while($row=mysqli_fetch_array($res))
                                {
                        
                        
                        ?>


                        <tr>
                        <form method="post">
                            <td><?php echo $row['did'] ;?></td>
                            <td><?php echo $row['name'] ;?></td>
                            <td><?php echo $row['phno'] ;?></td>
                            <td><?php echo $row['route'] ;?></td>
                        </form>
                        </tr>
                        <?php
                            }
                        } ?>
                    </tbody>
                </table>
            </div>

        </div>

        <div id="notification" class="content-section">
            <h2>Notifications</h2>
            <p>Add notifications.</p>
            <form method="POST" enctype="multipart/form-data" name="myForm" autocomplete="off">
            <div class="ntfcn-list">
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Notification</th>
                            <th>Send</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="date" name="date"></td>
                            <td> <textarea cols="35" rows="3" name="ntfcn"></textarea> </td>
                            <td><input type="submit" name="sendntfcn" value="Send"/></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            </form>
        </div>

        <div id="reports" class="content-section">
            <h2>Reports</h2>
            <p>View reports here.</p>

            <div class="reports-list">
                <table>
                    <thead>
                        <tr>
                            <th>Student USN</th>
                            <th>Branch</th>
                            <th>Report</th>
                            <th>Reply</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form method="POST" enctype="multipart/form-data" name="myForm" autocomplete="off">
                        <tr>
                            <?php 
                                $sql="select * from reports";
                                $res = mysqli_query($conn,$sql);
                                $rows= mysqli_num_rows($res);
                                if($rows<1)
                                {
                                    echo "<script>
                                            alert('Something went wrong !');
                                            </script>";

                                }
                                else
                                {
                                    while($row=mysqli_fetch_array($res))
                                    {
                            
                            
                            ?>
                            <tr>
                            <form method="post">
                                <td><input type="text" name="usn" value="<?php echo $row['usn'] ;?>" readonly></td>
                                <td><input type="text" name="brch" value="<?php echo $row['branch'] ;?>" readonly></td>
                                <td><textarea rows="3" cols="25" name="report" readonly><?php echo $row['report']; ?></textarea></td>
                                <td><textarea rows="3" cols="25" name="rep"></textarea></td>
                                <td><input type="submit" name="reply" value="Reply"></td>
                            </form>
                            </tr>
                            <?php
                                }
                            } ?>
                        </tr>
                        </form>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>


<?php

if(isset($_POST['sendntfcn']))
{
    $date=$_POST['date'];
    $ntfcn=$_POST['ntfcn'];
    
    $sql="insert into notifications values('$date', '$ntfcn')";
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

if(isset($_POST['reply']))
{
    $usn=$_POST['usn'];
    $rep=$_POST['rep'];

    $sql="update reports set reply='$rep' where usn='$usn'";
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