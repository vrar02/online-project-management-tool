
<?php
        session_start();
        if($_SESSION["loginID"]==true)

       {
        $loginID=$_SESSION["loginID"];


        require_once('config.php');
        $conn=mysqli_connect(HOST,DB_USERNAME,DB_PASSWORD,DB_DSN);
        if(mysqli_connect_errno())
        {
          die("connection failed".mysql_connect_error());
        }

        $sql1="select * from members where login_id='$loginID'";
        $res1=mysqli_query($conn,$sql1);
        if(!$res1)
        {
            die("Query1 failed");
        }
        $num1=mysqli_num_rows($res1);
          if($num1==1)
          {
            while($row1=mysqli_fetch_array($res1))
            {
              
              $memberID=$row1['member_id'];
              $name=$row1['first_name'];

            }
          }
          mysqli_free_result($res1);

          $_SESSION["memberID"]=$memberID;

       /* $sql2="select * from handled where member_id='$memberID'";
        $res2=mysqli_query($conn,$sql2);
        if(!$res2)
        {
            die("Query2 failed");
        }
        $projectID=0;
        $num2=mysqli_num_rows($res2);
          if($num2==1)
          {
            while($row2=mysqli_fetch_array($res2))
            {
              
              $projectID=$row2['p_id'];

            }
          }
          mysqli_free_result($res2);
      */


        

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
    $(function(){
       $('newproject').on('submit', function(e){
            e.preventDefault();
            $.ajax({
                url: "newproject.php",
                type: "POST",
                data: $("newproject.php").serialize(),
                success: function(data){
                    alert("Successfully submitted.")
                }
            });
       }); 
    });
</script>

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
      <li class="active"><a href="home.php">Project</a></li>
      <li><a href="task.php">Task</a></li>
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
    ?>
        <h2><b><u>Start your new Project:</u></b></h2>
  <!-- Trigger the modal with a button -->
          <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Click here</button>

                <!-- Modal -->
                  <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog modal-md">
                      <div class="modal-content">
                        

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title"><?php echo "Owner:";?></h4>
                        </div>
                        
                        <div class="modal-body">
                          
                          <form id="newproject" action="newproject.php" method="POST">
                                  
                                 
                                  <div class="form-group">
                                    <label>Project Title:</label>
                                    <input type="text" class="form-control" name="p_name" placeholder="Enter Project title">
                                  </div>
                                                                  
                                  <div class="row">
                                       <div class="col-sm-6 form-group">
                                          <label>Start Date</label>
                                          <input type="text" name="start_date" placeholder="Start date" class="form-control">
                                      </div>  

                                      <div class="col-sm-6 form-group">
                                        <label>End Date</label>
                                        <input type="text" name="end_date" placeholder="End date" class="form-control">
                                      </div>  
                                  </div>

                                  <div class="form-group">
                                    <label>References:</label>
                                    <input type="text" class="form-control" name="reference" placeholder="References">
                                  </div>
                                  <input type="submit" class="btn btn-default">
                               
                          </form>
                        </div>
                        
                        <div class="modal-footer">
                           
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                      
               </div>
           </div>
        </div>
        <?php
      }
      ?>
      </div>

      <hr/>



       <div class="container">
        <?php
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

                  while($row=mysqli_fetch_array($res)) {
                  ?>
                      <div class="row">
                      <div class="col-lg-8">
                      <div class="panel panel-primary">
                         
                          <div class="panel-heading slide">

                              <?php echo "{$row['p_name']}"; ?>
                            
                          </div>
                         
                          <div class="panel-body con">
                              <?php
                                          echo "Start Date:{$row['start_date']}";
                                          echo "<br/>";  
                                          echo "End Date:{$row['end_date']}";
                                          echo "<br/>";  
                                          echo "References:{$row['reference']}";
                                                    
                               ?>
                          </div>
                          
                    </div>
                  </div>

                </div>
                   
                 

                  <?php 
                  } 
                }
                  
                                            
                
                mysqli_free_result($res);

            }
            else
              header("Location:../index.html");
          ?>

          
                     
      </div>
      <hr>


</body>
</html>