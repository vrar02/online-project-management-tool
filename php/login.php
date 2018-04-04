
<?php
	
	
	require_once('config.php');
	$conn=mysqli_connect(HOST,DB_USERNAME,DB_PASSWORD,DB_DSN);
	
	if(mysqli_connect_errno())
	{
		die("connection failed".mysql_connect_error());
	}

	$current_email=$_POST['email'];
	$current_pwd=$_POST['password'];
	echo $current_pwd;
	$sql="select * from login where email='$current_email' AND password='$current_pwd'";
	$res=mysqli_query($conn,$sql);
	$count=0;		

			if(!$res)
			{
				die("Query failed");
			}
			
			$num=mysqli_num_rows($res);
			if($num==1)
			{
				while($row=mysqli_fetch_array($res))
				{
					
					$loginID=$row['login_id'];

				}
				session_start();
				$_SESSION["loginID"]=$loginID;
				$count=1;
				header("Location:home.php");
			}

		
			if($count==0)
			{
				echo "please sign up";
			}

			mysqli_free_result($res);


?>