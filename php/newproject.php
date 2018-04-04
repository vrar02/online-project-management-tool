<?php
	session_start();
	$memberID=$_SESSION['memberID'];
	require_once('config.php');
	$conn=mysqli_connect(HOST,DB_USERNAME,DB_PASSWORD,DB_DSN);
	if(mysqli_connect_errno())
	{
		die("connection failed".mysql_connect_error());
	}

	$projectName=$_POST['p_name'];
	$begin=$_POST['start_date'];
	$end=$_POST['end_date'];
	$resources=$_POST['reference'];

	$sql="insert into project(p_name,start_date,end_date,reference) values('$projectName','$begin','$end','$resources')";
	
	$res=mysqli_query($conn,$sql);
	if(!$res)
	{	echo $sql;
		die("Query failed".mysqli_query($conn));

	}

	$sql1="select * from project where p_name='$projectName' and start_date='$begin' and end_date='$end' and reference='$resources'";
        $res1=mysqli_query($conn,$sql1);
        if(!$res1)
        {
            die("Query1 failed");
        }
        $num1=mysqli_num_rows($res1);
          
            while($row1=mysqli_fetch_array($res1))
            {
              
              $projectID=$row1['p_id'];

            }
          

	$sql2="select * from handled where member_id='$memberID'";
        $res2=mysqli_query($conn,$sql2);
        if(!$res2)
        {
            die("Query2 failed");
        }
        
        $num2=mysqli_num_rows($res2);
          
            while($row2=mysqli_fetch_array($res2))
            {
              
              $teamID=$row2['t_id'];

            }
          
          mysqli_free_result($res2);


         if(is_null($teamID))
         {

			$sql3="insert into handled(p_id,t_id,member_id) values($projectID,NULL,$memberID)";
			
			$res3=mysqli_query($conn,$sql3);
			if(!$res3)
			{	echo $sql3;
				die("Query failed".mysqli_query($conn));

			}
		}
		else
			{
				$sql4="insert into handled(p_id,t_id,member_id) values($projectID,$teamID,$memberID)";
			
					$res4=mysqli_query($conn,$sql4);
					if(!$res4)
					{	echo $sql4;
						die("Query failed".mysqli_query($conn));

					}

			}




	header("location:home.php");

?>