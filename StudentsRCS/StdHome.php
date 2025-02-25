<?php

session_start();
//Database Connection.
 $conn = mysqli_connect("localhost","root","","routecare");

if(isset($_SESSION['usn'])){
    $usn=$_SESSION['usn'];
}
else{
    header('location:../Home.php');
}
$currentDate = date('Y-m-d');
$sql="select * from stds where usn='$usn'";
$res = mysqli_query($conn,$sql);
$row=mysqli_fetch_array($res);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students</title>
    <link rel="stylesheet" href="StdStyle.css">
    <script src="StdJS.js"></script>
</head>
<body>
    <div class="sidebar">
        <h2><?php echo $row['name']; ?></h2><br><hr><br>
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
            <h2>Welcome <?php echo $row['name']; ?></h2>

            <div class="dashboard-cards">
                <div class="card">
                    <h3>The main objective of the RouteCare System is to offer an efficient solution for managing college bus routes and schedules, ensuring that students and staff can easily access transportation information and services.
The system will facilitate the creation and management of bus routes, including route planning, schedule generation, and route adjustments based on real-time data. This helps in optimizing routes to reduce travel time and increase overall efficiency.
</h3>
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
    
                            $sql="select * from morngbus where mdate='$currentDate'";
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
                            $sql="select * from evngbus where edate='$currentDate'";
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
                        </tr>
                    </thead>
                    <tbody>
                        <?php
    
                            $sql="select * from notifications";
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
                            <td><?php echo $row['ndate'] ;?></td>
                            <td><?php echo $row['ntfctn'] ;?></td>
                        </form>
                        </tr>
                        <?php
                            }
                        } ?>
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
                                $sql="select * from stds where usn='$usn'";
                                $res = mysqli_query($conn,$sql);
                                $row=mysqli_fetch_array($res);

                                $sql2="select * from reports where usn='$usn'";
                                $res2 = mysqli_query($conn,$sql2);
                                $row2=mysqli_fetch_array($res2);
                            ?>
                            <td><input type="text" name="usn" value="<?php echo $usn; ?>" readonly /></td>
                            <td><input type="text" name="brch" value="<?php echo $row['branch']; ?>" readonly /></td>
                            <td><textarea cols="35" rows="3" name="report"></textarea></td>
                            <td><textarea cols="20" rows="3" name="reply" readonly><?php echo $row2['reply']; ?></textarea></td>
                            <td><input type="submit" name="send" value="Send"/></td>
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

if(isset($_POST['send']))
{
    $usn=$_POST['usn'];
    $brch=$_POST['brch'];
    $report=$_POST['report'];
    
    $sql="insert into reports values('$usn','$brch','$report','')";
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