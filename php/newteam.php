<?php
	session_start();
	$memberID=$_SESSION["memberID"];
	
	require_once('config.php');
	$conn=mysqli_connect(HOST,DB_USERNAME,DB_PASSWORD,DB_DSN);
	if(mysqli_connect_errno())
	{
		die("connection failed".mysql_connect_error());
	}

	$team_name=$_POST['tname'];

	$sql="insert into team(name,team_leader) values('$team_name',$memberID)";

	$res=mysqli_query($conn,$sql);
	if(!$res)
	{	echo $sql;
		die("Query failed");

	}


	 mysqli_free_result($res);


	 $sql1="select * from team where name='$team_name'";
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
              
              $teamID=$row1['t_id'];

            }
          }

           mysqli_free_result($res1);


          $sql2="update handled set t_id='$teamID' where member_id='$memberID'";
        $res2=mysqli_query($conn,$sql2);
        if(!$res2)
        {	
        	echo "$teamID";
            echo "Query failed".mysqli_error($conn);
        }

        


          mysqli_free_result($res2);





	header("location:team.php");
?>