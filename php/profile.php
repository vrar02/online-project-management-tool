<?php
        session_start();
        
          $memberID=$_SESSION['memberID'];

       
        $loginID=$_SESSION["loginID"];


        require_once('config.php');
        $conn=mysqli_connect(HOST,DB_USERNAME,DB_PASSWORD,DB_DSN);
        if(mysqli_connect_errno())
        {
          die("connection failed".mysql_connect_error());
        }

?>


<!DOCTYPE html>

<html lang="en">
<head>
  <title>Project Management Tool</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/custom.css">
  <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Online Project Management</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="home.php">Project</a></li>
      <li><a href="task.php">Task</a></li>
      <li><a href="file.php">File</a></li>
      <li><a href="team.php">Team</a></li>
    </ul>

    <ul class="nav navbar-nav navbar-right">
        <li class="active"><a href="profile.php"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
    </ul>

  </div>

</nav>
  <div class="container">

    <?php
    $sql="select * from members where member_id=$memberID";
    $res=mysqli_query($conn,$sql);
     while($row=mysqli_fetch_array($res)) {
                  
                      ?>
                                         <h1 style="color:#5d0e7d"><?php echo "Full Name: {$row['first_name']} "."{$row['middle_name']} ".$row['last_name'];
                                         

                                          echo "<br/>";  
                                          ?></h1>
                                          <div style="font-size: 35px;color: #5d0e7d">
                                                <?php
                                                  echo "State:{$row['state']}";
                                                  echo "<br/>";

                                                 echo "city:{$row['city']}";
                                                  echo "<br/>";

                                                  echo "pincode:{$row['pincode']}";
                                                  echo "<br/>";  
                                                  echo "Date Of Birth:{$row['Dob']}";
                                                  echo "<br/>";
                                                  ?>
                                               </div>

                                               <?php     
                              
                          }


    ?>

      </div>
  

</body>
</html>