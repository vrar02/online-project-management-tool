<?php
require_once('config.php');
        $conn=mysqli_connect(HOST,DB_USERNAME,DB_PASSWORD,DB_DSN);
        if(mysqli_connect_errno())
        {
          die("connection failed".mysql_connect_error());
        }
        session_start();
        $loginID=$_SESSION["loginID"];
        $memberID=$_SESSION["memberID"];


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

  <script>
  $(document).ready(function() {
    $(".slide").click(function(event) {
      event.preventDefault();
      event.stopPropagation();
      
      $(this).next('.con').slideToggle("slow");
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
      <li class="active"><a href="task.php">Task</a></li>
      <li><a href="file.php">File</a></li>
      <li><a href="team.php">Team</a></li>
    </ul>

    <ul class="nav navbar-nav navbar-right">
        <li><a href="profile.php"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
    </ul>

  </div>

</nav>
   <div class="container">
    <?php
    $sql3="select owner_id from members where login_id=$loginID";
    $res3=mysqli_query($conn,$sql3);
     while($row3=mysqli_fetch_array($res3)) {
      $ownerID=$row3['owner_id'];
    }
        
        if(is_null($ownerID))
        {
        $sql="select * from project p,handled h where h.member_id='$memberID' and h.p_id=p.p_id";

        $res=mysqli_query($conn,$sql);
        $count=0;   


            if(!$res)
            {
              die("Query3 failed");
            }
        }
        
        else
        {
          $sql="select * from project p,handled h where h.member_id='$ownerID' and h.p_id=p.p_id";

        $res=mysqli_query($conn,$sql);
        $count=0;   


            if(!$res)
            {
              die("Query3 failed");
            }
        }
        ?>
        <h2><b><u>Current Projects:</u></b></h2>

          
                
                
                 <?php
                 $num=mysqli_num_rows($res);
                 if($num==0)
                  {
                    echo "No current projects";
                   
                  }
                  ?>

                  <?php
                 for($i=1;$i<=$num; $i++) {

                  while($row=mysqli_fetch_array($res)) 
                  {
                  
                  ?>
                      <div class="row">
                      <div class="col-lg-8">
                      <div class="panel panel-primary">
                         
                          <div class="panel-heading slide">

                              <?php echo "{$row['p_name']}"; 
                              $pName=$row['p_name'];
                             
                             ?>
                            
                          </div>
                         
                          <div class="panel-body con">
                            <div class="row">
                            <?php
                               if(is_null($ownerID))
                              {
                                ?>
                                         <div class="col-sm-8">

                                    
                                    <div id="flip">Add Task</div>
                                    
                                    <form action="newtask.php" method="POST">
                                                      
                   
                                  <div class="form-group">
                                    
                                    <label>Start Date</label>
                                          <input type="text" name="start_date" placeholder="Start date" class="form-control">
                                    <label>End Date</label>
                                          <input type="text" name="end_date" placeholder="End date" class="form-control">
                                    <label>Description:</label>
                                    <input type="text" class="form-control" name="description" placeholder="Enter description of the task">
                                    <input type="text" class="form-control" style="display: none;" name="pname" value="<?php echo $row['p_name']; ?>">
                                    <label>Select member</label>

                                    <select class="form-control" id="sel1" name="mName">
                                      <?php
                                        $sql7="select first_name from members where owner_id=$memberID";
                                            $res7=mysqli_query($conn,$sql7);
                                            

                                            while($row7=mysqli_fetch_array($res7))
                                            {
                                              ?>
                                              <option  value="<?php echo $row7['first_name'];?>" ><?php echo $row7['first_name']; ?></option>
                                              
                                            

                                            <?php
                                          }
                                      ?>
                                    </select>

                                        
                                        </div>
                                                                  
                                  
                                  <input type="submit" class="btn btn-default">
                               
                               
                          </form>
                    
                        </div>
                                <?php
                             }
                             ?>
                            </div>
                            <br/>
                            <div class="row">
                              <div class="col-sm-8">

                                    <?php
                                    if(is_null($ownerID))
                                    {
                                    ?>
                                    <div id="flip2"><b> Assigned Tasks To:</b></div>
                                    
                             <?php
                            $sql7="select first_name,member_id from members where owner_id=$memberID";
                                            $res7=mysqli_query($conn,$sql7);
                                            $flag=0;
                                            while($row7=mysqli_fetch_array($res7))
                                            {
                                              $flag=1;
                                              ?>
                                              <td><u><?php echo "<br/>"; echo $row7['first_name'];?></u></td>
                                              <?php $temp_memberID=$row7['member_id'];

                                                $sql8="select t1.start_date,t1.end_date,t1.description from task t1,assignedto a1,project p1 where a1.member_id='$temp_memberID' AND t1.task_id=a1.task_id AND p1.p_name='$pName' AND p1.p_id=t1.p_id";
                                                $res8=mysqli_query($conn,$sql8);
                                                $count=0;
                                                while($row8=mysqli_fetch_array($res8))
                                                { 
                                                  $count++;
                                                  echo "<br/>";
                                                  echo "Task $count:";
                                                  echo "<br/>";
                                                  echo "Start Date:{$row8['start_date']}";
                                                  echo "<br/>";  
                                                  echo "End Date:{$row8['end_date']}";
                                                  echo "<br/>";  
                                                  echo "Description:{$row8['description']}";
                                                     echo "<br/>";      
                                                }
                                                if($count==0)
                                                  echo "No tasks assigned";
                                              ?>
                                            <?php
                                            }
                                            if($flag==0)
                                            {
                                              echo "No tasks assigned......add members";
                                            }
                             ?>
                          
                           <?php
                         }
                         else
                         {
                            ?>
                            <u><b><?php echo "Tasks asigned for You:";?></b></u>
                            <?php

                           $sql9="select t1.start_date,t1.end_date,t1.description from task t1,assignedto a1,project p1 where a1.member_id='$memberID' AND t1.task_id=a1.task_id AND p1.p_name='$pName' AND t1.p_id=p1.p_id";
                                                $res9=mysqli_query($conn,$sql9);
                                                $count=0;
                                                while($row9=mysqli_fetch_array($res9))
                                                { 
                                                  $count++;
                                                  echo "<br/>";
                                                  echo "Task $count:";
                                                  echo "<br/>";
                                                  echo "Start Date:{$row9['start_date']}";
                                                  echo "<br/>";  
                                                  echo "End Date:{$row9['end_date']}";
                                                  echo "<br/>";  
                                                  echo "Description:{$row9['description']}";
                                                     echo "<br/>";      
                                                }
                                                if($count==0)
                                                  echo "No tasks assigned at present";
                         }

                         ?>
                          </div>
                        </div>

                          
                    </div>
                  </div>

                </div>
                   
                 

                 
</div>
     
 <?php 
              }
            }
              ?>
      

</body>
</html>