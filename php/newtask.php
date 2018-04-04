<?php
	
	
	require_once('config.php');
	$conn=mysqli_connect(HOST,DB_USERNAME,DB_PASSWORD,DB_DSN);
	
	if(mysqli_connect_errno())
	{
		die("connection failed".mysql_connect_error());
	}

	$startDate=$_POST['start_date'];
	$endDate=$_POST['end_date'];
	$description=$_POST['description'];
	$mName=$_POST['mName'];
	$pname=$_POST['pname'];

	


	$sql1="select p_id from project where p_name='$pname'";
	$res1=mysqli_query($conn,$sql1);
	while($row1=mysqli_fetch_array($res1))
	{
		$pid=$row1['p_id'];
	}
	mysqli_free_result($res1);
	$sql="insert into task(start_date,end_date,p_id,description) values('$startDate','$endDate',$pid,'$description')";
	$res=mysqli_query($conn,$sql);
	if(!$res)
	{	echo $sql;
		die("Query failed".mysqli_query($conn));

	}

	$sql3="select task_id from task where start_date='$startDate' AND end_date='$endDate' AND description='$description' AND p_id='$pid'";
	$res3=mysqli_query($conn,$sql3);
	while($row3=mysqli_fetch_array($res3))
	{
		$taskID=$row3['task_id'];
	}
	echo $taskID;


	$sql5="select member_id from members where first_name='$mName'";
	$res5=mysqli_query($conn,$sql5);
	while($row5=mysqli_fetch_array($res5))
	{
		$taskMemberID=$row5['member_id'];
	}
	

	$sql4="insert into assignedto(task_id,member_id) values('$taskID','$taskMemberID')";
	$res4=mysqli_query($conn,$sql4);
	if(!$res)
	{	echo $sql4;
		die("Query failed".mysqli_query($conn));

	}
	header("Location:task.php");
?>