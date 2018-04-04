<?php
        session_start();
       
        $loginID=$_SESSION["loginID"];
        $memberID=$_SESSION["memberID"];


        require_once('config.php');
        $conn=mysqli_connect(HOST,DB_USERNAME,DB_PASSWORD,DB_DSN);
        if(mysqli_connect_errno())
        {
          die("connection failed".mysql_connect_error());
        }

    $sql6="select owner_id from members where login_id=$loginID";
    $res6=mysqli_query($conn,$sql6);
     while($row6=mysqli_fetch_array($res6)) {
      $ownerID=$row6['owner_id'];
    }
    if(is_null($ownerID))
    {
  
        
          $sql2="select * from handled where member_id='$memberID'";
      }
      else
      {
          $sql2="select * from handled where member_id='$ownerID'";
      }
      
        $res2=mysqli_query($conn,$sql2);
        if(!$res2)
        {
            die("Query2 failed");
        }
        $teamID=NULL;
        $num2=mysqli_num_rows($res2);
         
            while($row2=mysqli_fetch_array($res2))
            {
              
              $teamID=$row2['t_id'];

            }
          
          mysqli_free_result($res2);


         
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

  <style>
  #panel,#panel2,#flip,#flip2 {
    padding: 5px;
    text-align: center;
    font-size: 30px;
    background-color: #e5eecc;
    border: solid 1px #c3c3c3;
}

#panel,#panel2{
    padding: 50px;
    display: none;
}

</style>

  <script> 
  $(document).ready(function(){
      $("#flip").click(function(){
          $("#panel").slideToggle("slow");
      });
  });
  $(document).ready(function(){
      $("#flip2").click(function(){
          $("#panel2").slideToggle("slow");
      });
  });
  </script>
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
      <li class="active"><a href="team.php">Team</a></li>
    </ul>

    <ul class="nav navbar-nav navbar-right">
        <li><a href="profile.php"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
    </ul>

  </div>

</nav>


       <div class="container">
        
        <?php
            if(is_null($teamID))

            {
              
              ?>
              <div class="col-sm-6">

              <h2><b><u>No Team present:</u></b></h2>
              <p style="color: red";><u>First Create Project before creating your own team</u></p>
              <div id="flip">Click to create Team</div>
              <div id="panel">
              <form action="newteam.php" method="POST">
                                                      
                   
                                  <div class="form-group">
                                    <label>Team Name:</label>
                                    <input type="text" class="form-control" name="tname" placeholder="Enter Team Name">
                                  </div>
                                                                  
                                  
                                  <input type="submit" class="btn btn-default">
                               
                               
                          </form>
                        </div>
                        </div>
                         </div>
                    <div class="container">
                <div class="col-sm-6">

              <br/>
              <p style="color: red";><u>Click here to Join Other Team</u></p>
              <div id="flip2">Click to Join Other Team</div>
              <div id="panel2">
              <form action="jointeam.php" method="POST">
                                                      
                   
                                  <div class="form-group">
                                    <label>Enter Team Name Correctly:</label>
                                    <input type="text" class="form-control" name="tname" placeholder="Enter Team Name">
                                  </div>
                                                                  
                                  
                                  <input type="submit" class="btn btn-default">
                               
                               
                          </form>
                        </div>
                        </div>

                      </div>
                <?php
                }
                else
                {
                      $sql3="select * from handled where member_id='$memberID'";
                      $res3=mysqli_query($conn,$sql3);
                      if(!$res3)
                      {
                          die("Query3 failed");
                      }
                      $num1=mysqli_num_rows($res3);
                        
                          while($row3=mysqli_fetch_array($res3))
                          {
                            
                            $teamID=$row3['t_id'];
                          }
                        
                        mysqli_free_result($res3);

                      $sql4="select * from team where t_id='$teamID'";
                      $res4=mysqli_query($conn,$sql4);
                      if(!$res4)
                      {
                          die("Query4 failed");
                      }
                      $num4=mysqli_num_rows($res4);
                        
                          while($row4=mysqli_fetch_array($res4))
                          {
                            
                            $teamName=$row4['name'];
                            ?>

                            <div class="=container">

                             <table class="table">
                                      <thead>
                                        <tr>
                                          <th style="color: #5d0e7d;font-size: 25px;"><u>Team NAME:</u><?php echo $teamName;
                                          }
                                             mysqli_free_result($res4); 

                                             ?>
                                          </th>
                                        </tr>
                                        <tr>
                                          <th><u>Team members</u></th>
                                        </tr>
                                      </thead>
                                      <tbody>

                                        <tr class="danger">
                                          <?php
                                            $sql5="select distinct m1.first_name from members m1,handled h1 where h1.t_id='$teamID' AND h1.member_id=m1.member_id";
                                          $res5=mysqli_query($conn,$sql5);
                                          if(!$res5)
                                          {
                                              die("Query5 failed");
                                          }
                                          $num4=mysqli_num_rows($res5);
                                            
                                              while($row5=mysqli_fetch_array($res5))
                                              {
                                
                                               ?>
                                          <td><?php echo "Owner :{$row5['first_name']}"; 

                                           ?></td>
                                         </tr>
                                         

                                         

                                           <?php
                                          }

                                          if(is_null($ownerID))
                                          {
                                             $sql7="select first_name from members where owner_id=$memberID";
                                            $res7=mysqli_query($conn,$sql7);
                                            while($row7=mysqli_fetch_array($res7))
                                            {
                                              ?>
                                              <tr class="danger">
                                              <td><?php echo $row7['first_name'];
                                              echo "<br/>";
                                              ?>
                                            </td>
                                          </tr>

                                            <?php
                                            }
                                          }
                                          else
                                          {
                                            $sql7="select first_name from members where owner_id=$ownerID";
                                            $res7=mysqli_query($conn,$sql7);
                                            while($row7=mysqli_fetch_array($res7))
                                            {
                                              ?>
                                              <tr class="danger">
                                              <td><?php echo $row7['first_name'];
                                               echo "<br/>";
                                              ?>
                                            </td>
                                              </tr>  
                                            <?php
                                            }
                                          }
                                         ?>
                                          
                                            
                                        </tbody>
                                    </table>
                            </div>
                            <?php
                          }
                        
                       

                
                ?>


      </div>
        
</body>

</html>
