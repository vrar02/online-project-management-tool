<?php
	
	session_start();
	$memberID=$_SESSION['memberID'];
	require_once('config.php');
	$conn=mysqli_connect(HOST,DB_USERNAME,DB_PASSWORD,DB_DSN);
	
	if(mysqli_connect_errno())
	{
		die("connection failed".mysql_connect_error());
	}
	$teamName=$_POST['tname'];
	$sql="select team_leader from team where name='$teamName'";
	$res=mysqli_query($conn,$sql);
	while($row=mysqli_fetch_array($res))
	{
		$ownerID=$row['team_leader'];
	}
	mysqli_free_result($res);
	$sql1="update members set owner_id=$ownerID where member_id=$memberID";
	$res1=mysqli_query($conn,$sql1);
	 
	 header("Location:team.php");
?>