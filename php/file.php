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
      <li><a href="task.php">Task</a></li>
      <li class="active"><a href="file.php">File</a></li>
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
                            
                                
                                         <div class="col-sm-8">

                                    
                                    <div id="flip">Upload File</div>
                                    
                                   <div class="form-group">
                                    
                                   <form action="upload.php" method="post" enctype="multipart/form-data">
                                          <br/>
                                          <input type="file" name="fileToUpload" id="fileToUpload">
                                          <input type="text" name="pName" value="<?php echo $pName;?>" style="display: none;">
                                          <br/>
                                           <input type="submit" name="submit">
                                      </form>                                 
                                     
                                        </div>
                                                      
                   
                       
                        </div>
                                
                            </div>
                            <br/>
                            <div class="row">
                              <div class="col-sm-8">

                                    
                                    <div id="flip2"><b>Uploaded Files:</b></div>
                                    <?php
                                      $dir = "$pName/";

                                      // Open a directory, and read its contents
                                      if (is_dir($dir)){
                                        if ($dh = opendir($dir)){
                                          while (($file = readdir($dh)) !== false){
                                            echo $file . "<br>";
                                          }
                                          closedir($dh);
                                        }
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