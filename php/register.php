<?php
	require_once('config.php');
	$conn=mysqli_connect(HOST,DB_USERNAME,DB_PASSWORD,DB_DSN);
	if(mysqli_connect_errno())
	{
		die("connection failed".mysql_connect_error());
	}

	$firstname=$_POST['fname'];
	$middlename=$_POST['mname'];
	$lastname=$_POST['lname'];
	$dateOfBirth=$_POST['dob'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	$state=$_POST['state'];
	$city=$_POST['city'];
	$pincode=$_POST['pincode'];
	
	$pno=$_POST['pno'];
	$apno=$_POST['apno'];
	
	$sql1="insert into login(email,password) values('$email','$password')";
	$res1=mysqli_query($conn,$sql1);
	if(!$res1)
	{	
		die("Query failed".mysqli_query($conn));

	}

	$sql2="select * from login where email='$email' and password='$password'";
        $res2=mysqli_query($conn,$sql2);
        if(!$res2)
        {
            die("Query2 failed");
        }
        $num2=mysqli_num_rows($res2);
          if($num2==1)
          {
            while($row2=mysqli_fetch_array($res2))
            {
              
              $loginID=$row2['login_id'];

            }
          }
          mysqli_free_result($res2);


	$sql="insert into members(first_name,middle_name,last_name,Dob,state,city,pincode,login_id) values('$firstname','$middlename','$lastname','$dateOfBirth','$state','$city',$pincode,$loginID)";
	
	$res=mysqli_query($conn,$sql);
	if(!$res)
	{	
		die("Query failed".mysqli_query($conn));

	}
	header("Location:../index.html");
	
?>